<!DOCTYPE html>
<html lang="de">
<head>

    <title>Dateien</title>
    <meta charset="UTF-8">
    <?php  include "ses2.php"; ?>

</head>

<?php

session_start();
/**
 * Created by PhpStorm.
 * User: Illia
 * Date: 04.12.2016
 * Time: 02:01
 */
include "conn.php";
include "profilfeld.php";
include "deleteall.php";


$login = $_SESSION['loginname'];
$ordner = "file/";

echo "> Datei Hochladen!</a><br><br>";



$two_tables = "SELECT fileid, name, username FROM files
WHERE username='$login' ORDER BY name";


$ergebnis = $db->query($two_tables);
$zahl = $ergebnis->rowCount();
while($row = $ergebnis->fetch(PDO::FETCH_ASSOC)){
    //  echo $row['$login'].'/'.$row['name'].'<br/>';

    echo ' - Datei ansehen: <a href="'.$ordner .$row['name'].'">'.$ordner.$row['name'].'</a> �ndern:
     <a href="mail.php?fileid='.$row['fileid'].'"> Teilen</a>
     <a href="filedelete.php?fileid='.$row['fileid'].'"> Loeschen</a>
     <a href="filechange.php?fileid='.$row['fileid'].'"> Umbenennen</a>';

}

$login = $_SESSION['loginname'];

echo "<br/>Anzahl der Dateien: $zahl";

echo "<br/>Username: $login     <br/>" ;

echo "  $login's Dateien<br/><br/>";



echo "> Abmeldung!</a><br /><br>";


?>