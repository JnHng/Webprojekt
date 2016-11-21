
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registrieren</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>


<form class="register" method="POST" action="register2.php?submit=1">
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
    $id = $_POST["id"];
    $username = $_POST["username"];
    $passwort1 = $_POST["passwort1"];
    $passwort2 = $_POST["passwort2"];
    $hash = md5($passwort1);
    $error = false;


    if (isset($username)) {
        echo 'Geben sie einen Namen ein!<br>';
        $error = true;
    }

    if (isset($passwort1)) {
        echo 'Geben sie ein Passwort ein!<br>';
        $error = true;
    }

    if (isset($passwort2)) {
        echo 'Geben sie ein Passwort ein!<br>';
        $error = true;
    }


    if (!empty($username) && !empty($passwort1) && !empty($passwort2)&& (!$error))  {
        $statement = $db->prepare("SELECT * FROM user WHERE username = :username");
        $result = $statement->execute(array('username' => $username));
        $user = $statement->fetch();
    }


    if (!empty($username) && !empty($passwort1) && !empty($passwort2)&& (!$error) &&($passwort1 == $passwort2)) {
        $passwort_hash = password_hash($passwort1, PASSWORD_DEFAULT);

        $statement = $db->prepare("INSERT INTO user (username, passwort) VALUES (:username, :passwort1)");
        $result = $statement->execute(array('username' => $username, 'passwort1' => $passwort_hash));

        if ($result) {
            echo 'Herzlichen Glückwunsch! Sie haben sich soeben registriert! <a href="index.php">Zur Anmeldung</a>';
        } else {
            echo 'Ein Fehler ist aufgetreten!<br>';
        }

    }
}
?>