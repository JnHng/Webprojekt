<form action="winfile.php?submit=1" method="post" enctype="multipart/form-data">
    <input type="file" name="bilddatei" id="bilddatei"><br>
    <input type="submit" name="submit" value="Hochladen">
</form>

<?php


session_start();
include "conn.php";


if(isset($_POST['submit'])) {

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

    /*   if($test !== false) {
           $test = getimagesize($tmp_datei);
           echo "Ist ein Bild! - " . $test["mime"] . ".";

       } else {
           echo "Ist KEIN Bild.";
           exit();

       } */

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

    if (move_uploaded_file($tmp_datei, $ordner . $datei)) {
        echo "Coolio!";
        $up = $db->prepare("INSERT INTO files (name, typ, size) VALUES(:ordner_datei,:typ,:size)");
        $up->bindParam(':ordner_datei', $ordner_datei, PDO::PARAM_STR);
        $up->bindParam(':typ', $typ, PDO::PARAM_STR);
        $up->bindValue(':size', $size, PDO::PARAM_INT);
        $up->execute();
    } else {
        echo "Fehler!";
    }


    $sehen = fopen($ordner_datei, "r") or die("File nicht zu öffnen!");
    echo fread($sehen, filesize($ordner_datei));
    fclose($sehen);



}
?>
