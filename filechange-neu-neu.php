<?php
/**
 * Created by PhpStorm.
 * User: Illia
 * Date: 02.02.2017
 * Time: 04:28
 */


session_start();
?>

    <!DOCTYPE html>

    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Dateinamen �ndern</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>


    <form class="filechange" method="POST" action="">
        <b>Dateinamen �ndern:</b><br>
        <br>
        <input name="datei" placeholder="Neuer Dateiname:" type=text><br>
        <br>
        <input type=submit name=submit value="Dateinamen �ndern">
    </form>
    </body>
    </html>

<?php

include "conn.php";

if (isset ($_POST["submit"])) {

    $login = $_SESSION['loginname'];
    $newname = $_POST["datei"];

    $datei = $_FILES['bilddatei']['name'];
    $tmp_datei = $_FILES['bilddatei']['tmp_name'];
    $ordner = "uploads/";
    $ordner_datei = ($ordner . basename($datei));


    $dateiname = $_GET["name"];

    $indivdiual = $login.'_';


    echo $login;


    if (!empty($newname)) {
        $suchen = ".";
        $punkt = strpos($newname, $suchen);
        if($punkt === false) {



        echo $array[0]."<br>".$array[1]."<br>";
            $array = explode(".",$dateiname);
        rename("$dateiname", "uploads/$indivdiual$newname.$array[1]");



        $neuername = "uploads/$indivdiual$newname.$array[1]";

        echo "Okidoki: $neuername!<br>";

        $fileupdate = $db->prepare("UPDATE files SET name = :neuername WHERE username = :login AND name = :dateiname");

        $fileupdate->bindParam(':neuername', $neuername, PDO::PARAM_STR);
        $fileupdate->bindParam(':dateiname', $dateiname, PDO::PARAM_STR);
        $fileupdate->bindParam(':login', $_SESSION['loginname'], PDO::PARAM_STR);

        $fileupdate->execute();
        unset ($fileupdate);

        echo ' Ihr Dateiname wurde erfolgreich ge�ndert. Zur�ck zu <a href="meine-dateien.php">dateien.php</a>';

        /* $statement->execute(array("passwort1" => $passwort1, "id" => $id));
         unset ($statement);
         echo "Ihr Passwort wurde erfolgreich ge?ndert!<br>"; */

        } else {
            echo "Bitte folgendes Zeichen nicht nutzen: '.'<br>";
        }


    } else {
        echo "Bitte geben Sie einen Namen ein!<br>";
    }


}

?>