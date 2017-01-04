<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registrieren</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>


<form class="register" method="POST" action="regmatch.php?submit=1">
    <b>Registrieren:</b><br>
    <br>
    <input name="username" placeholder="Username" type=text><br>
    <input name="passwort1" placeholder="Passwort" type=password><br>
    <input name="passwort2" placeholder="Passwort wiederholen" type=password><br>
    <br>
    <input type=submit name=submit value="Registrieren">
</form>
</body>
</html>

<?php
session_start();
include "conn.php";

if(isset($_GET["submit"])) {
    $username = $_POST["username"];
    $passwort1 = $_POST["passwort1"];
    $passwort2 = $_POST["passwort2"];
    $hash = md5($passwort1);
    $error = false;



    if (!empty($username) && !empty($passwort1) && !empty($passwort2) && (!$error) && ($passwort1 == $passwort2)) {

        try {

            $reg = $db->prepare("SELECT username FROM nutzer WHERE username = :username");
            $result = $reg->execute(array('username' => $username));
            /* $user = $reg->fetchAll();
            $anzahl_user = $reg->rowCount(); */
            $nutzer = $reg->fetch(PDO::FETCH_ASSOC);

            if($nutzer !== false) {
                echo 'Dieser Username ist bereits vergeben. Geben Sie einen anderen Namen ein.<br>';
                $error = true;
                exit();
            }

        }
        catch(PDOException $e) {
            echo $e->getMessage();
            die();
        }

            //new user


            /*$passwort_hash = password_hash($passwort1, PASSWORD_DEFAULT);*/

            try {

                $reg = $db->prepare("INSERT INTO nutzer (username, passwort)
VALUES(:username,:hash)");
                $reg->bindParam(':username', $username, PDO::PARAM_STR);
                $reg->bindParam(':hash', $hash, PDO::PARAM_STR);
                $reg->execute();
                unset($reg);

            } catch (PDOException $e) {
                echo $e->getMessage();
                die();
            }


            if ($result) {
                echo 'Herzlichen Glückwunsch! Sie haben sich soeben registriert! <a href="login.php">Zur Anmeldung</a>';
            } else {
                echo 'Ein Fehler ist aufgetreten!<br>';
            }



    }
    else {
        echo "Bitte alle Felder wie angegeben ausf�llen!";
    }
}

?>