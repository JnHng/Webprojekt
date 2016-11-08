<?php
/**
 * Created by PhpStorm.
 * User: Jan
 * Date: 08.11.2016
 */
session_start();
include "connection.php";
$login=$_POST["loginname"];
$passwort=$_POST["passwort"];

include "connection.php";
$sql="SELECT * FROM user WHERE username='$login' AND passwort='$passwort'";
echo $sql;
$query=$db->query($sql);
if ($query==false)
{
    die(var_export($db->errorinfo(), TRUE));
}


if ($zeile=$query->fetch(PDO::FETCH_OBJ))
{
    echo "query";
    if ($zeile->passwort==$passwort) {
        $_SESSION["loginname"] = $zeile->login;
        header('Location: erfolg.php');
    }

}
else
{
    echo "Nutzer nicht gefunden";
}

echo "<a href=\"login-form.html\">Zurück zum Login</a>";