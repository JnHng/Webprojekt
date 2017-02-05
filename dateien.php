<!DOCTYPE html>
<html lang="de">
<head>

    <title>Dateien</title>
    <meta charset="UTF-8">
    <?php // include "ses2.php"; ?>

</head>

<?php

session_start();
/**
 * Created by PhpStorm.
 * User: Illia
 * Date: 04.12.2016
 * Time: 02:01
 */
include "conn.php"
include "profilfeld.php";

$login = $_SESSION['loginname'];
$datei = $_SESSION['profilbild'];

$datei = $_FILES['bilddatei']['name'];
$tmp_datei = $_FILES['bilddatei']['tmp_name'];
$typ = $_FILES['bilddatei']['type'];
$size = $_FILES['bilddatei']['size'];
$max = 1000000;
$fehler = $_FILES['bilddatei']['error'];
$ordner = "file/";
$ordner_datei = ($ordner.basename($datei));
$dateiform = pathinfo($ordner_datei, PATHINFO_EXTENSION);


/* $sql = "SELECT name FROM files";
foreach ($db->query($sql) as $row) {
    echo "<br /> $row[name].<br />";
}
*/


/* $join = "SELECT nutzer.username, files.name
FROM nutzer
INNER JOIN files
ON nutzer.username = files.username
ORDER BY nutzer.username"; */

$two_tables = "SELECT name, fileid FROM files
WHERE username='$login' ORDER BY name";

$ergebnis = $db->query($two_tables);
$zahl = $ergebnis->rowCount();
while($row = $ergebnis->fetch(PDO::FETCH_ASSOC)){
  //  echo $row['$login'].'/'.$row['name'].'<br/>';

echo ' - Datei ansehen: <a href="'.$row['name'].'">'.$row['name'].'</a> Ändern:
     <a href="fileshare.php?name='.$row['name'].'"> Teilen</a>
     <a href="filedelete.php?fileid='.$row['fileid'].'"> Loeschen</a>
     <a href="filechange.php?fileid='.$row['fileid'].'"> Umbenennen</a>';
}

$login = $_SESSION['loginname'];

echo "<br/>Anzahl der Dateien: $zahl";

echo "'<br/>'Username: $login     <br/>" ;

echo "  $login's Dateien<br/><br/>";

echo ' - Bild ansehen: <a href="'.$row['name'].'">'.$row['name'].'</a>';


echo "Hier geht es zur <br /><a href=\"abmelden.php\"> Abmeldung!</a><br />";

?>


