<?php
/**
 * Created by PhpStorm.
 * User: Jan
 * Date: 17.01.2017
 * Time: 21:31
 */
include "conn.php";
$user = $_SESSION['loginname'];
if ($user) {

    if ($_POST['submit']) {
        $oldpasswort = md5($_POST['oldpasswort']);
        $newpasswort = md5($_POST['neuespasswort']);
        $repeatpasswort = md5($_POST['repeatneuespasswort']);

        $oldpasswortdb = "SELECT passwort FROM nutzer WHERE username='$user' AND passwort='$oldpasswort'";

        if ($oldpasswort == $oldpasswortdb) {
            if ($newpasswort == $repeatpasswort) {
                $update = "UPDATE nutzer SET password='$newpasswort' WHERE username='$user'";
                session_destroy();
                die ("Vorgang erfolgreich! <a href='login.html'>Zurück</a>");
            } else {
                die ("Die neuen Passwörter stimmen nicht überein!");
            }
        } else {
            die("Altes Passwort stimmt nicht überein!");
        }
    } else {
        echo " <form action='changepw.php' method='POST'>
                Altes Passwort: <input type='text' name='altespasswort'><p>
                Neues Passwort: <input type='password' name='neuespasswort'><br>
                Neues Passwort wiederholen: <input type='password' name='repeatneuespasswort'><p>
                <input type='submit' name='submit' value='Passwort ändern'>
                </form>";
    }
}
else
{
    ("Sie sind nicht eingeloggt.");}
