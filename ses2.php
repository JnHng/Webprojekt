<?php

session_start();
/* include "conn.php"; */

$user = $_SESSION['loginname'];

if(isset($_SESSION['loginname'])) {
    echo("Hallo $user");

}
elseif (!isset($_SESSION['loginname'])) {

    echo 'Bitte erst <a href="login-form.html">einloggen!</a>';

}

?>