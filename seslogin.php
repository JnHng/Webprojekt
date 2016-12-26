<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<form class="login" method="POST" action="seslogin.php?submit=1">
    <b>Login</b><br>
    <br>
    <input name="loginname" placeholder="Name"><br>
    <input name="loginpasswort" placeholder="Passwort" type=password><br>
    <br>
    <input type=submit name=submit value="Einloggen">
</form>
</body>
</html>


<?php

if(isset($_GET["submit"])) {

    session_start();
    include "conn.php";
    $login = $_POST["loginname"];
    $passwort = $_POST["loginpasswort"];
    $hash = md5($passwort);
    $pwhash = password_hash($passwort, PASSWORD_DEFAULT);
    $code= password_verify ($password , $hash);


    if (!empty($login) && !empty($passwort)) {

        $sql = "SELECT * FROM nutzer WHERE username ='$login' AND passwort ='$hash'
                 AND profil='$_SESSION[profil]' AND profilbild = '$_SESSION[profilbild]'";
        echo $sql;
        $query = $db->query($sql);
        if ($query == false) {
            die(var_export($db->errorinfo(), TRUE));
        }


        if ($zeile = $query->fetch(PDO::FETCH_OBJ)) {
            /*  echo "query";*/
            if ($zeile->passwort == $hash && $zeile->username == $login &&
                $zeile->profil == $_SESSION['profil'] && $zeile->profilbild == $_SESSION['profilbild']) {
                $_SESSION["loginname"] = $zeile->username;
                $_SESSION["profil"] = $zeile->profil;
                $_SESSION["profilbild"] = $zeile->profilbild;
                echo $_SESSION["loginname"], $_SESSION["profilbild"]  ;
                header('Location: erfolg.php');
            }

        } else {
            echo "Nutzer nicht gefunden! ";
        }

        echo "Gib einen anderen Nutzer ein!";

    } else {
        echo "Bitte alle Felder ausf?llen!";
    }
}

?><?php
/**
 * Created by PhpStorm.
 * User: Illia
 * Date: 21.12.2016
 * Time: 16:37
 */