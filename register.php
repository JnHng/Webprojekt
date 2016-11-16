
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



?>