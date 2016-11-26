<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<form class="login" method="POST" action="regtest.php?=submit=1">
    <b>Login</b><br>
    <br>
    <input name="loginname" placeholder="Name"><br>
    <input name="loginpasswort" placeholder="Passwort" type=password><br>
    <br>
    <input type=submit name=submit value="Einloggen">
</form>
</body>
</html>

<?php


include "connection.php";
$login=$_POST["loginname"];
$passwort=$_POST["loginpasswort"];

include "connection.php";

if(!empty($login) && !empty($passwort)) {

    $sql="SELECT * FROM user WHERE username='$login' AND passwort='$passwort'";
    echo $sql;
    $query=$db->query($sql);
    if ($query==false)
    {
        die(var_export($db->errorinfo(), TRUE));
    }


    if (!$ergebnis= $db ->query($statement))
    {
        $fehlerArray = $db ->errorInfo();
        echo "Es ist Fehler". $fehlerArray[1]. "aufgetreten:" .$fehlerArray[2];
    }


    else
    {
        echo "Nutzer nicht gefunden";
    }

    echo "<a href=\"login-form.html\">Zurück zum Login</a>";

    $stmt = $db ->prepare("INSERT INTO user (id, username, passwort, email, profilbild)
VALUES('', :login,:passwort , '', '')");
    $stmt ->bindParam(':login', $login, PDO::PARAM_STR);
    $stmt ->bindParam(':passwort', $passwort, PDO::PARAM_STR);
    $stmt ->execute();

}  else {
    echo "Bitte alle Felder ausfüllen!";
}

?>