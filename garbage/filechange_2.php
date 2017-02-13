<?php
/**
 * Created by PhpStorm.
 * User: Illia
 * Date: 02.02.2017
 * Time: 04:28
 */


session_start();
include "header.php";
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


if (isset ($_POST["submit"])) {

    $login = $_SESSION['loginname'];
    $newname = $_POST["datei"];



    $dateiname = $_GET["name"];
    $fileid = $_GET["fileid"];

    $indivdiual = $login.'_';




    if (!empty($newname)) {
        $suchen = ".";
        $punkt = strpos($newname, $suchen);
        if($punkt === false) {


            $einzigartig = $db->prepare("SELECT fileid, name, username FROM files WHERE fileid = :fileid");
            $einzigartig->execute(array('fileid' => $fileid));
            $ausgabe = $einzigartig->fetch();

    $dateiname=$ausgabe['name'];


        $array = explode(".",$dateiname);

//        echo $array[0]."<br>".$array[1]."<br>";


        copy("$ordner$dateiname", "$indivdiual$newname.$array[1]");



        $neuername = "$indivdiual$newname.$array[1]";

        echo "Okidoki: $neuername!<br>";

        $fileupdate = $db->prepare("UPDATE files SET name = :neuername WHERE fileid = :fileid && username = :login AND name = :dateiname");

        $fileupdate->bindValue(':fileid', $fileid, PDO::PARAM_INT);
        $fileupdate->bindParam(':neuername', $neuername, PDO::PARAM_STR);
        $fileupdate->bindParam(':dateiname', $dateiname, PDO::PARAM_STR);
        $fileupdate->bindParam(':login', $_SESSION['loginname'], PDO::PARAM_STR);

        $fileupdate->execute();
        unset ($fileupdate);

        echo ' Ihr Dateiname wurde erfolgreich ge�ndert. Zur�ck zu <a href="dateien.php">dateien.php</a>';


        } else {
            echo "Bitte folgendes Zeichen nicht nutzen: '.'<br>";
        }


    } else {
        echo "Bitte geben Sie einen Namen ein!<br>";
    }


}

?>