<form action="uploadfile.php?submit=1" method="post" enctype="multipart/form-data">
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


    $upload = "/file/";
    $dateiname = pathinfo($_FILES['bilddatei']['name'], PATHINFO_FILENAME);
    $dateiform = pathinfo($_FILES['bilddatei']['name'], PATHINFO_EXTENSION);
    $tmp_datei = $_FILES['bilddatei']['tmp_name'];
    $type = $_FILES['bilddatei']['type'];
    $groß = $_FILES['bilddatei']['size'];
    $maxgroß = 2097152;
    $error = $_FILES['bilddatei']['error'];
    $erweiterung = strtolower(substr($dateiname, strpos($dateiname, ".") + 1));
    $erweiterung2 = substr($dateiname, 18);


    if (!empty($dateiname && $dateiname)) {

        /* $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));

        $expensions= array("jpeg","jpg","png");

        if(in_array($file_ext,$expensions)=== false){
            echo "extension not allowed, please choose a JPEG or PNG file.";
        } */

       //if (($erweiterung == "jpg" || $erweiterung == "jpeg") && $type == "image/jpeg" && $groß < $maxgroß) {

        if  (move_uploaded_file($tmp_datei, $upload . $dateiname)){
            echo "Erfolgreicher Upload!";

        } else {
            echo "Ein Fehler ist aufgetreten";
        }

   // } else {
    //    echo "Falsche File-Eigenschaften!";
    //}


    } else {
        echo "Wähle eine Datei aus.";
    }

}

/*$dateiganz = $upload . $dateiname .".".$dateiform;

$gültige_dateiform = array('png', 'jpg', 'jpeg');


if(!in_array($dateiform, $gültige_dateiform)) {
    die("Keine zulässige Bilddatei.");
}

if(isset($_FILES['bilddatei']['name'])) {

    echo "Ihr Bild: '" . basename($_FILES['bilddatei']['name']) . "' ";

}

if(file_exists($dateiganz)) {
    $id = 1;
    do {
        $dateiganz = $upload.$dateiname.'_'.$id.'.'.$dateiform;
        $id++;
    } while(file_exists($dateiganz));
}

//Alles okay, verschiebe Datei an neuen Pfad
move_uploaded_file($_FILES['bilddatei']['tmp_name'], $dateiganz);
echo 'Bild wurde erfolgreich hochgeladen: <a href="'.$dateiganz.'">'.$dateiganz.'</a>'; */
?>
