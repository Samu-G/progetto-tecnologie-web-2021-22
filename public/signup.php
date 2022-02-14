<?php
require_once("../risorse/config.php");

$response = array(
    "message" => "C'è stato qualche errore!"
);


if (isset($_POST["email"]) && isset($_POST["password"])) {

    $newEmail = $_POST["email"];

    $newPassword = $_POST["password"];

    $role = "Utente";

    $idUtente = null;

    $connection = connection::connect();

    //CHECK

    // Check se l'utente non è registrato misteriosamente non funzionante
    //
    $sql = "SELECT * FROM utenti WHERE username = " . $newEmail;

    $query = $connection->query($sql)->fetch();

    $alreadyRegistered = false;

    if ($query->num_rows > 0) {
        $alreadyRegistered = true;
    }

    //INS

    if (!$alreadyRegistered) {
        $sql = "INSERT INTO `utenti` (`id_utente`, `username`, `password`, `role`) VALUES(
                    :id_utente,
                    :username,
                    :password,
                    :role)";

        $stmt = $connection->prepare($sql);

        $stmt->bindParam(":id_utente", $idUtente);
        $stmt->bindParam(":username", $newEmail);
        $stmt->bindParam(":password", $newPassword);
        $stmt->bindParam(":role", $role);

        if ($stmt->execute()) {
            $response["message"] = "Registrazione AVVENUTA CON SUCCESSO";
        } else {
            $response["message"] = "Registrazione FALLITA";
        }
    }

}

echo json_encode($response);