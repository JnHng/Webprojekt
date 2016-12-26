

<form action="winbild.php?submit=1" method="post" enctype="multipart/form-data">
    <input type="file" name="bilddatei" id="bilddatei"><br>
    <input type="submit" name="submit" value="Hochladen">
</form>

<?php

/**
 * Created by PhpStorm.
 * User: Illia
 * Date: 18.12.2016
 * Time: 02:22
 */

session_start();
include "conn.php";


if(isset($_POST['submit'])) {

    $login = $_SESSION['loginname'];

    $datei = $_FILES['bilddatei']['name'];
    $tmp_datei = $_FILES['bilddatei']['tmp_name'];
    $typ = $_FILES['bilddatei']['type'];
    $size = $_FILES['bilddatei']['size'];
    $max = 2097152;
    $fehler = $_FILES['bilddatei']['error'];
    $ordner = "/home/iz002/public_html/file/";
    $ordner_datei = ($ordner . basename($datei));
    $dateiname = pathinfo($ordner_datei, PATHINFO_FILENAME);
    $dateiform = pathinfo($ordner_datei, PATHINFO_EXTENSION);

    if (empty($datei)) {
        echo "Wählen Sie eine Datei aus";
        exit();
    }

    if($test !== false) {
           $test = getimagesize($tmp_datei);
           echo "Ist ein Bild! - ";

       } else {
           echo "Ist KEIN Bild.";
           exit();

       }

    if (file_exists($ordner_datei)) {
        echo "File gibt es schon!";
        exit();
    }

    if ($size > $max) {
        echo "Zu groß!";
        exit();
    }


    if (isset($datei)) {

        echo "Ihr Bild: '" . basename($datei) . "' ";

    }

    /* $reg = $db->prepare("SELECT * FROM files LEFT JOIN nutzer ON files.id = nutzer.id");

    $reg->execute(array('id' => 1));
    while($kommentar = $reg->fetch()) {
        echo $kommentar['files.id']." ".$kommentar['nutzer.id']." <br />";

    } */


    if (move_uploaded_file($tmp_datei, $ordner . $datei)) {
        echo 'Coolio: <a href="'.$ordner_datei.'">'.$ordner_datei.'</a>';
        $up = $db->prepare("UPDATE nutzer SET profilbild = :ordner_datei WHERE username = :login");
        $up->bindParam(':ordner_datei', $ordner_datei, PDO::PARAM_STR);
        $up->bindParam(':login', $_SESSION['loginname'], PDO::PARAM_STR);
        $up->execute();
    } else {
        echo "Fehler!";
    }


    // $sehen = fopen($ordner_datei, "r") or die("File nicht zu öffnen!");
    // echo fread($sehen, filesize($ordner_datei));
    // fclose($sehen);



}
?>