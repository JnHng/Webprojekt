<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registrieren</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>


<form class="register" method="POST" action="">
    <b>Registrieren:</b><br>
    <br>
    <input name="username" placeholder="Username" type=text><br>
    <input name="passwort1" placeholder="Passwort" type=password><br>
    <input name="passwort2" placeholder="Passwort wiederholen" type=password><br>
    <input name="email" placeholder="E-Mail" type=email><br>
    <br>
    <input type=submit name=submit value="Registrieren">
</form>
</body>
</html>

<?php
session_start();
include "conn.php";

if(isset($_POST["submit"])) {
    $username = $_POST["username"];
    $passwort1 = $_POST["passwort1"];
    $passwort2 = $_POST["passwort2"];
    $email = $_POST["email"];
    $hash = md5($passwort1);



    if (!empty($username) && !empty($passwort1) && !empty($passwort2) && !empty($email) && ($passwort1 == $passwort2)) {



        $register = $db->prepare("SELECT * FROM nutzer WHERE username = :username");
        $register->bindParam(':username', $username, PDO::PARAM_STR);
        $register->execute();
        $new = $register->fetch(PDO::FETCH_ASSOC);

        if($new == true) {
            echo 'Dieser Username ist bereits vergeben. Geben Sie einen anderen Namen ein.<br>';
            exit();
        }

        $sender = $db->prepare("SELECT * FROM nutzer WHERE email = :email");
        $sender->bindParam(':email', $email, PDO::PARAM_STR);
        $sender->execute();
        $neu = $sender->fetch(PDO::FETCH_ASSOC);

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo 'Keine g�ltige E-Mail-Adresse<br>';
            exit();}

        if($neu == true) {
            echo 'Diese Mail ist bereits vergeben. Geben Sie einen anderen Namen ein.<br>';
            exit();
        }

        //new user


        /*$passwort_hash = password_hash($passwort1, PASSWORD_DEFAULT);*/

        try {

            $register = $db->prepare("INSERT INTO nutzer (username, passwort, email)
VALUES(:username,:hash, :email)");
            $register->bindParam(':username', $username, PDO::PARAM_STR);
            $register->bindParam(':hash', $hash, PDO::PARAM_STR);
            $register->bindParam(':email', $email, PDO::PARAM_STR);
            $register->execute();
            // unset($register);

        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }


        if ($register !== false) {
            echo 'Herzlichen Gl�ckwunsch! Sie haben sich soeben registriert! <a href="../login.php">Zur Anmeldung</a>';
        } else {
            echo "Ein Fehler ist aufgetreten!<br>";
        }



    }
    else {
        echo "Bitte alle Felder wie angegeben ausf?llen!";
    }
}

?>