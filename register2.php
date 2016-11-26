
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


    if (!empty($username) && !empty($passwort1) && !empty($passwort2) && (!$error) && ($passwort1 == $passwort2)) {
        $statement = $db->prepare("SELECT username FROM user WHERE username = :username");
        $result = $statement->execute(array('username' => $username));
        $user = $statement->fetch();



            /*$passwort_hash = password_hash($passwort1, PASSWORD_DEFAULT);*/

        $stmt = $db ->prepare("INSERT INTO user (id, username, passwort, email, profilbild)
VALUES('', :username,:passwort1 , '', '')");
        $stmt ->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt ->bindParam(':passwort1', $passwort1, PDO::PARAM_STR);
        $stmt ->execute();

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