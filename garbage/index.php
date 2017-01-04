<?php
/**
 * Created by PhpStorm.
 * User: Jan
 * Date: 08.11.2016
 */

    session_start();
    include "conn.php";
    $login = $_POST["loginname"];
    $passwort = $_POST["loginpasswort"];
    $hash = md5($passwort);


    if (!empty($login) && !empty($passwort)) {

        $sql = "SELECT * FROM nutzer WHERE username='$login' AND passwort='$passwort'";
        /* echo $sql; */
        $query = $db->query($sql);
        if ($query == false) {
            die(var_export($db->errorinfo(), TRUE));
        }


        if ($zeile = $query->fetch(PDO::FETCH_OBJ)) {
            echo "query";
            if ($zeile->passwort == $passwort) {
                $_SESSION["loginname"] = $zeile->username;
                echo $_SESSION["loginname"];
                header('Location: erfolg.php');
            }

        } else {
            echo "Nutzer nicht gefunden! ";
        }

        echo ">Zurück zum Login!</a>";

    } else {
        echo "Bitte alle Felder ausfüllen!";

}