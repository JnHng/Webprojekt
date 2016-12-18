<?php
session_start();
$id = $_SESSION['loginname'];
$upload_folder = 'upload/'; //Das Upload-Verzeichnis
$filename = $id.pathinfo($_FILES['datei'][''], PATHINFO_FILENAME);
$extension = strtolower(pathinfo($_FILES['datei']['name'], PATHINFO_EXTENSION));


//Überprüfung der Dateiendung
$allowed_extensions = array('png' /**, 'jpg', 'jpeg', 'gif' */);
if(!in_array($extension, $allowed_extensions)) {
    die("Ungültige Dateiendung. Nur png");
}

//Überprüfung der Dateigröße
$max_size = 500*1024; //500 KB
if($_FILES['datei']['size'] > $max_size) {
    die("Bitte keine Dateien größer 500kb hochladen");
}

//Überprüfung dass das Bild keine Fehler enthält
if(function_exists('exif_imagetype')) { //exif_imagetype erfordert die exif-Erweiterung
    $allowed_types = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);
    $detected_type = exif_imagetype($_FILES['datei']['tmp_name']);
    if(!in_array($detected_type, $allowed_types)) {
        die("Nur der Upload von Bilddateien ist gestattet");
    }
}

//Pfad zum Upload
$new_path = $upload_folder.$filename.'.'.$extension;

//falls die Datei bereits existiert
if(file_exists($new_path)) {
    die ("Datei existiert bereits!");
}

//Alles okay, verschiebe Datei an neuen Pfad
move_uploaded_file($_FILES['datei']['tmp_name'], $new_path);
echo 'Bild erfolgreich hochgeladen: <a href="'.$new_path.'">'.$new_path.'</a>';
?>