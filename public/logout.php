<?php

unset($_SESSION["login"]);
unset($_SESSION["username"]);
session_start();
session_destroy();

header("Location: index.php");
