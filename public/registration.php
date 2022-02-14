<?php require_once("../risorse/config.php"); ?>

<?php include(FRONT_END . "/header.php"); ?>

<script type="text/javascript">
    function ValidateEmail(email) {
        var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        if (email.match(mailformat)) {
            return true;
        } else {
            return false;
        }
    }

    function formValidation() {
        if (document.getElementById("newEmail").value !== "") {
            if (ValidateEmail(document.getElementById("newEmail").value)) {

                var newEmail = document.getElementById("newEmail").value;
                var newPassword = document.getElementById("newPassword").value;

                $.ajax({
                    type: "post",
                    url: "signup.php",
                    data: {
                        email: newEmail,
                        password: newPassword
                    },
                    dataType: "json",
                    success: function (response) {
                        document.getElementById("return-message").innerHTML = response.message;
                        // Non funziona come mai? adotto approccio server Side ...
                        <?php creaAvviso("Registrazione avvenuta con successo"); ?>
                    }
                });

            } else {
                // $(".form-message").css("display", "block");
                // document.getElementById("return-message").innerHTML = "Formato indirizzo email non corretto";
                // Non funziona come mai? adotto approccio server Side ...
                <?php creaAvviso("Formato indirizzo email non corretto"); ?>
            }
        } else {
            // $(".form-message").css("display", "block");
            // Edocument.getElementById("return-message").innerHTML = "Non hai inserito l'indirizzo email";
            // Non funziona come mai? adotto approccio server Side ...
            <?php creaAvviso("Non hai inserito l'indirizzo email"); ?>
        }
    }
</script>


<div class="container my-5">


    <h3 class="display-4">Registrati qui </h3> <br>

    <h4 class="bg-warning text-center" id="return-message">
        <?php mostraAvviso(); ?></h4>

    <div class="main-login main-center">

        <form class="form-horizontal" role="form" method="post">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <h2>Inserisci qui i tuoi dati</h2>
                    <br>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="sr-only" for="email">Nome utente </label>
                        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                            <div class="input-group-addon" style="width: 2.6rem"><i class="material-icons">email</i>
                            </div>
                            <input type="text" class="form-control" name="newEmail" id="newEmail"
                                   placeholder="Scrivi qui l'indirizzo email"/>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="sr-only" for="password">Password</label>
                        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                            <div class="input-group-addon" style="width: 2.6rem"><i
                                        class="material-icons">verified_user</i></div>
                            <input type="password" class="form-control" name="newPassword" id="newPassword"
                                   placeholder="Scrivi qui la tua password"/>
                        </div>
                    </div>
                </div>
            </div>

            <br>

            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <button type="submit" class="btn btn-outline-info btn-block"
                            onclick="formValidation()" > Registrati!
                    </button>
                </div>
            </div>


        </form>
    </div>

