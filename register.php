
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registrieren</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>


<form class="register" method="POST" action="register.php">
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

$username=$_POST["username"];
$passwort1=$_POST["passwort1"];
$passwort2=$_POST["passwort2"];
$hash=md5($passwort1);

if($username == 0) {
    echo 'Geben sie einen Namen ein!<br>';
}

if($passwort1 == 0) {
    echo 'Geben sie ein Passwort ein!<br>';
}

if($passwort2 == 0) {
    echo 'Geben sie ein Passwort ein!<br>';
}

if($passwort1 != $passwort2) {
    echo 'Die Passwörter stimmen nicht überein!';
}

if(!empty($username) && !empty($passwort1) && !empty($psswort2)) {
    try {
        $stmt = $db->prepare("SELECT username FROM user WHERE user = :user");
        $stmt->bindParam(':user', $user, PDO::PARAM_STR);
        $stmt->execute();

        $erg = $stmt->fetch();
    }
    catch(PDOException $e){
        echo $e->getMessage();
    }
}

    if ($passwort1 == $passwort2) {
        try {
            $stmt = $db->prepare("INSERT INTO user (user, passwort) VALUES (:user, :hash)");
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->bindParam(':hash', $hash, PDO::PARAM_STR);
            $stmt->execute();
            unset ($stmt);
            echo 'Herzlichen Glückwunsch! Sie haben sich soeben registriert! <a href="index.php">Zur Anmeldung</a>';

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

?>