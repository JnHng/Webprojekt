<?php
session_start();

$_logindaten = ARRAY("name"=>"admin", "passwort"=>"12345");

if (isset($_POST["loginname"]) && isset($_POST["loginpasswort"]))
{
    if ($_logindaten["name"] == $_POST["loginname"] &&
        $_logindaten["passwort"] == $_POST["loginpasswort"])
    {
        # Userdaten korrekt - User ist eingeloggt
        # Login merken !
        $_SESSION["login"] = 1;
    }
}

if ($_SESSION["login"] != 1)
{
    include("login-form.html");
    exit;
}

# User ist eingeloggt
?>

/**
 * Created by PhpStorm.
 * User: Nick
 * Date: 07.11.16
 * Time: 17:51
 */