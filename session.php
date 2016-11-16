<?php

session_start();
include ("/home/nl035/public_html/includes/connection.php");

if(!isset($_SESSION['username'])) {
    echo('Bitte erst in <a href="https://mars.iuk.hdm-stuttgart.de/~nl035/login-form.html">einloggen!</a>');
}
else {
    $user = $_SESSION['username'];

    echo "Willkommen $user <br />
<a href=\"dateien.php\">Weiter zur Hauptseite!</a><br />";
}

?>