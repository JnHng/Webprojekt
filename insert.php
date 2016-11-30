<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registrieren</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>


<form class="register" method="POST" action="insert.php?submit=1">
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
include "conn.php";

if(isset($_POST["username"])) {
    $username = $_POST["username"];
    $passwort1 = $_POST["passwort1"];
    $passwort2 = $_POST["passwort2"];
    $hash = md5($passwort1);
    $error = false;



    if (!empty($username) && !empty($passwort1) && !empty($passwort2) && (!$error) && ($passwort1 == $passwort2)) {

        try {

            $stmt = "SELECT * FROM nutzer";
            $result = $db->query($abfrage);
            if($ergebnis->rowCount() > 0) {
            foreach($ergebnis as $item) {

            echo($item["username"]."has this passwort:".$item["passwort1"]);
            }
            }

        }
        catch(PDOException $e) {
            echo $e->getMessage();
            die();
        }

        /*$passwort_hash = password_hash($passwort1, PASSWORD_DEFAULT);*/

        try {

            $stmt = ("INSERT INTO nutzer (username, passwort)
VALUES(:username,:passwort1)");
            $abfrage = $db->prepare($stmt);
            $ergebnis = $abfrage->execute(array(":username" => $username, ":passwort1" => $passwort1));

        }
        catch(PDOException $e) {
            echo $e->getMessage();
            die();
        }



        if ($result) {
            echo 'Herzlichen Glückwunsch! Sie haben sich soeben registriert! <a href="login-form.html">Zur Anmeldung</a>';
        } else {
            echo 'Ein Fehler ist aufgetreten!<br>';
        }



    }else {
        echo "Bitte alle Felder wie angegeben ausfüllen!";
    }
}

?>