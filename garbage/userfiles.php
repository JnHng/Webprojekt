<?php
$site_title = "Profil";
include "header.php";
include "nav"

include "profilfeld.php";

// if($_SESSION['loginname'] !== true) { header("Location: index.php");}
$login = $_SESSION['loginname'];
$datei = $_SESSION['profilbild'];

$datei = $_FILES['bilddatei']['name'];
$tmp_datei = $_FILES['bilddatei']['tmp_name'];
$typ = $_FILES['bilddatei']['type'];
$size = $_FILES['bilddatei']['size'];
$max = 1000000;
$fehler = $_FILES['bilddatei']['error'];
$ordner = "uploads/";
$ordner_datei = ($ordner.basename($datei));
$dateiform = pathinfo($ordner_datei, PATHINFO_EXTENSION);

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
