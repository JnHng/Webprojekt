

<?php
session_start();
include "ses2.php";
include "conn.php";
$login = $_SESSION['loginname'];
$text = $_POST['text'];
$notiz = $_SESSION['text'];

if (isset ($_POST["submit"])) {



$login = $_SESSION['loginname'];
$text = $_POST['text'];
$notiz = $_SESSION['text'];
/**
 * Created by PhpStorm.
 * User: Illia
 * Date: 30.12.2016
 * Time: 01:46
 */


    if (!empty($text)) {






        $schreiben = $db->prepare("UPDATE nutzer SET text = :text WHERE username = :login");


            $schreiben->bindParam(':text', $text, PDO::PARAM_STR);
            $schreiben->bindParam(':login', $_SESSION['loginname'], PDO::PARAM_STR);
            $schreiben->execute();


            echo "$login s'Notiz erstellt! $text <br>";


    } else {
        echo "Schreiben Sie zuerst eine Notiz!<br>";
    }




    $sql = "SELECT * FROM nutzer WHERE username='$login' AND text='$text'";

    $query = $db->query($sql);
    if ($query == false) {
        die(var_export($db->errorinfo(), TRUE));
    }


    if ($zeile = $query->fetch(PDO::FETCH_OBJ)) {

        if ($zeile->text == $text && $zeile->username == $login) {
            $_SESSION["loginname"] = $zeile->username;
            $_SESSION["text"] = $zeile->text;



        }
        if($sql == true) {
            echo "Gespeichert";
        }

    }

    else {
        echo "Fehler aufgetreten";
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<form class="text" method="POST" action="text.php?submit=1">
    <br>
    <h1>Notizen:</h1>
    <textarea name="text" cols="50" rows="10"><?php
         echo "$_SESSION[text]";
        ?></textarea>
    <br>
    <input type=submit name=submit value="Speichern">
</form>
</body>
</html>

