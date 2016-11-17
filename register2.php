
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
    <input name="loginname" placeholder="Ihr Username:" type=text><br>
    <input name="loginpasswort" placeholder="Ihr Passwort:" type=password><br>
    <input name="loginpasswort2" placeholder="Passwort wiederholt:" type=password><br>
    <br>
    <input type=submit name=submit value="Registrieren">
</form>
</body>
</html>

<?php
session_start();
include "connection.php";

$id=$_POST["id"];
$username=$_POST["username"];
$passwort1=$_POST["passwort1"];
$passwort2=$_POST["passwort2"];
$hash=md5($passwort1);

if($username == 0) {
    echo 'Geben sie ein Passwort ein!<br>';
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
    $statement = $db->prepare("SELECT * FROM user WHERE username = :username");
    $result = $statement->execute(array('username' => $username));
    $user = $statement->fetch();
}

//Keine Fehler, wir können den Nutzer registrieren
if($passwort1==$passwort2) {
    $passwort_hash = password_hash($passwort1, PASSWORD_DEFAULT);

    $statement = $db->prepare("INSERT INTO user (username, passwort) VALUES (:username, :passwort1)");
    $result = $statement->execute(array('username' => $username, 'passwort1' => $passwort_hash));

    if($result) {
        echo 'Herzlichen Glückwunsch! Sie haben sich soeben registriert! <a href="index.php">Zur Anmeldung</a>';
    } else {
        echo 'Ein Fehler ist aufgetreten!<br>';
    }

}
?>