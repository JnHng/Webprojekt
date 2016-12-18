<form action="insertfile.php?submit=1" method="post" enctype="multipart/form-data">
    <input type="file" name="bilddatei" id="bilddatei"><br>
    <input type="submit" name="submit" value="Hochladen">
</form>

<?php
/**
 * Created by PhpStorm.
 * User: Illia
 * Date: 14.12.2016
 * Time: 16:22
 */
session_start();
include "conn.php";


if(isset($_POST['submit'])) {

    $datei = $_FILES['bilddatei']['name'];
    $tmp_datei = $_FILES['bilddatei']['tmp_name'];
    $typ = $_FILES['bilddatei']['type'];
    $size = $_FILES['bilddatei']['size'];
    $fehler = $_FILES['bilddatei']['error'];
    $ordner = "/home/iz002/public_html/file/";

    if (isset($datei)) {

        echo "Ihr Bild: '" . basename($datei) . "' ";

    }

    if  (move_uploaded_file($tmp_datei, $ordner . $datei)) {
        echo "Coolio!";
         /* $up = $db->prepare("INSERT INTO files (name, typ, size) VALUES(:datei,:typ,::size)");
         $up->bindParam(':datei', $datei, PDO::PARAM_STR);
         $up->bindParam(':typ', $typ, PDO::PARAM_STR);
         $up->bindValue(':size', $size, PDO::PARAM_INT);
         $up->execute(); */
    }

else {
        echo "Fehler!";
    }
}
?>