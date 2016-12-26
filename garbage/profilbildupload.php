<?php
session_start();
$id = $_SESSION['loginname'];
$upload_folder = 'file/';
$filename = $id.pathinfo($_FILES['datei'][''], PATHINFO_FILENAME);
$extension = strtolower(pathinfo($_FILES['datei']['name'], PATHINFO_EXTENSION));


$allowed_extensions = array('png');
if(!in_array($extension, $allowed_extensions)) {
    die("Ungültige Dateiendung. Nur png");
}

$max_size = 500*1024;
if($_FILES['datei']['size'] > $max_size) {
    die("Bitte keine Dateien größer 500kb hochladen");
}

if(function_exists('exif_imagetype')) {
    $allowed_types = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);
    $detected_type = exif_imagetype($_FILES['datei']['tmp_name']);
    if(!in_array($detected_type, $allowed_types)) {
        die("Nur der Upload von Bilddateien ist gestattet");
    }
}

$new_path = $upload_folder.$filename.'.'.$extension;

if(file_exists($new_path)) {
    die ("Datei existiert bereits!");
}

move_uploaded_file($_FILES['datei']['tmp_name'], $new_path);
echo 'Bild erfolgreich hochgeladen: <a href="'.$new_path.'">'.$new_path.'</a>';
?>