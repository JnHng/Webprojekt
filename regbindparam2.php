
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registrieren</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>


<form class="register" method="POST" action="regbindparam.php">
    <b>Registrieren:</b><br>
    <br>
    <input name="username" placeholder="Ihr Username:" type=text><br>
    <input name="passwort1" placeholder="Ihr Passwort:" type=password><br>
    <input name="passwort2" placeholder="Passwort wiederholt:" type=password><br>
    <br>
    <input type=submit name=submit value="Registrieren">
</form>
</body>
</html>


<?php

session_start();
include "connection.php";


if(isset($_GET["submit"])) {
    $username = $_POST["username"];
    $passwort1 = $_POST["passwort1"];
    $passwort2 = $_POST["passwort2"];
    $hash = md5($passwort1);
    $error=false;

    if ($username == 0) {
        echo 'Geben sie einen Namen ein!<br>';
        $error=true;
    }

    if ($passwort1 == 0) {
        echo 'Geben sie ein Passwort ein!<br>';
        $error=true;
    }

    if ($passwort2 == 0) {
        echo 'Geben sie ein Passwort ein!<br>';
        $error=true;
    }

    if ($passwort1 != $passwort2) {
        echo 'Die Passwörter stimmen nicht überein!';
        $error=true;
    }

    if(!empty($username) && !empty($passwort1) && !empty($passwort2)&& (!$error)) {
        $stmt = $db->prepare("SELECT * FROM user WHERE username = :username");
        if ($stmt->execute(array($_GET['username']))) {
            while ($row = $stmt->fetch()) {
                print_r($row);
            }
        }

    }

    if(!empty($username) && !empty($passwort1) && !empty($passwort2) && (!$error)) {
        $stmt = $db->prepare("INSERT INTO user (user, passwort) VALUES (:user, :hash)");
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':hash', $hash, PDO::PARAM_STR);
        $stmt->execute();
        echo 'Herzlichen Glückwunsch! Sie haben sich soeben registriert! <a href="index.php">Zur Anmeldung</a>';
    }

}
ii

?>