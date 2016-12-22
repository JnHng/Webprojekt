<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<form class="login" method="POST" action="login.php?submit=1">
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

        $sql = "SELECT * FROM nutzer WHERE username='$login' AND passwort='$hash'";
        echo $sql;
        $query = $db->query($sql);
        if ($query == false) {
            die(var_export($db->errorinfo(), TRUE));
        }


        if ($zeile = $query->fetch(PDO::FETCH_OBJ)) {
          /*  echo "query";*/
            if ($zeile->passwort == $hash && $zeile->username == $login) {
                $_SESSION["loginname"] = $zeile->username;
                echo $_SESSION["loginname"];
                header('Location: profilvorlage.php');
            }

        } else {
            echo "Nutzer nicht gefunden! ";
        }

        echo "Gib einen anderen Nutzer ein!";

    } else {
        echo "Bitte alle Felder ausf�llen!";
    }
}

?>