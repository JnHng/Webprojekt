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

        $query = $db->query($sql);
        if ($query == false) {
            die(var_export($db->errorinfo(), TRUE));
        }


        if ($zeile = $query->fetch(PDO::FETCH_OBJ)) {

            if ($zeile->passwort == $hash && $zeile->username == $login) {
                $_SESSION["loginname"] = $zeile->username;
                $_SESSION["profilbild"] = $zeile->profilbild;
                $_SESSION["text"] = $zeile->text;
                $_SESSION["email"] = $zeile->email;
                echo $_SESSION["loginname"];

                header('Location: dashboard.php');

            }

        } else {
            echo "Nutzer nicht gefunden! Geben sie einen anderen Nutzernamen ein!";
        }


    } else {
        echo "Bitte alle Felder ausf�llen!";
    }
}

?>
