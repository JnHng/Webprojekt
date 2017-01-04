<form action="pic.php" method="post" enctype="multipart/form-data">
    <input type="file" name="bilddatei" id="bilddatei"><br>
    <input type="submit" value="Neues Profilbild hochladen">
</form>

<?php
/**
 * Created by PhpStorm.
 * User: Illia
 * Date: 05.12.2016
 * Time: 02:05
 */

$upload = "/iz002/public_html/dateien/";
$dateiname = pathinfo($_FILES['bilddatei']['name'], PATHINFO_FILENAME);
$dateityp = pathinfo($_FILES['bilddatei']['name'], PATHINFO_EXTENSION);

$dateiganz = $upload . $dateiname .".".$dateityp;

$gueltiger_dateityp = array('png', 'jpg', 'jpeg');


if(!in_array($dateityp, $gueltiger_dateityp)) {
    die("Keine zul�ssige Bilddatei.");
}

if(isset($_FILES['bilddatei']['name'])) {

    echo "Ihr Bild: '" . basename($_FILES['bilddatei']['name']) . "' ";

}

if(file_exists($dateiganz)) {
    $id = 1;
    do {
        $dateiganz = $upload.$dateiname.'_'.$id.'.'.$dateityp;
        $id++;
    } while(file_exists($dateiganz));
}

//Alles okay, verschiebe Datei an neuen Pfad
move_uploaded_file($_FILES['bilddatei']['tmp_name'], $dateiganz);
echo 'Bild wurde erfolgreich hochgeladen: <a href="'.$dateiganz.'">'.$dateiganz.'</a>';
?>



