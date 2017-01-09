<form action="file.php?submit=1" method="post" enctype="multipart/form-data">
    <input type="file" name="bilddatei" id="bilddatei"><br>
    <input type="submit" name="submit" value="Hochladen">
</form>

<?php
/**
 * Created by PhpStorm.
 * User: Illia
 * Date: 05.12.2016
 * Time: 02:05
 */

if(isset($_GET["submit"])) {

    $upload = "/home/iz002/public_html/file/";
    $dateiname = pathinfo($_FILES['bilddatei']['name'], PATHINFO_FILENAME);
    $dateiform = pathinfo($_FILES['bilddatei']['name'], PATHINFO_EXTENSION);
    $tmp_datei = $_FILES['bilddatei']['tmp_name'];
    $type = $_FILES['bilddatei']['type'];


    $dateiganz = $upload . $dateiname . "." . $dateiform;

    $gültige_dateiform = array('png', 'jpg', 'jpeg');


    if (!in_array($dateiform, $gültige_dateiform)) {
        die("Keine zul�ssige Bilddatei.");

    }

    if (isset($_FILES['bilddatei']['name'])) {

        echo "Ihr Bild: '" . basename($_FILES['bilddatei']['name']) . "' ";

    }

    if (file_exists($dateiganz)) {
        $id = 1;
        do {
            $dateiganz = $upload . $dateiname . '_' . $id . '.' . $dateiform;
            $id++;
        } while (file_exists($dateiganz));
    }

//Alles okay, verschiebe Datei an neuen Pfad
    move_uploaded_file($_FILES['bilddatei']['tmp_name'], $dateiganz);
    echo 'Bild wurde erfolgreich hochgeladen: <a href="' . $dateiganz . '">' . $dateiganz . '</a>';

}

?>
