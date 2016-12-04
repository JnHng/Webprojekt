<?php

session_start();
/* include "conn.php"; */

if(!isset($_SESSION['loginname'])) {
    die('Bitte erst <a href="login-form.html">einloggen!</a>');

}
else {
    $user = $_SESSION['loginname'];

    echo "Willkommen $user <br />
<a href=\"dateien.php\">Weiter zur Hauptseite!</a><br />";
}

?>
