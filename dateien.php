<?php

include "conn.php";


$login = $_SESSION['loginname'];
$ordner = "Uploads/";



$two_tables = "SELECT name, fileid FROM files
WHERE username='$login' ORDER BY name";

$ergebnis = $db->query($two_tables);
$zahl = $ergebnis->rowCount();
while($row = $ergebnis->fetch(PDO::FETCH_ASSOC)){
  //  echo $row['$login'].'/'.$row['name'].'<br/>';

    echo ' <tr><td> <a href="'.$row['name'].'">'.$row['name'].'</a></td>
     <td><a href="fileshare.php?name='.$row['name'].'"> Teilen</a> |
     <a href="filedelete.php?fileid='.$row['fileid'].'"> Loeschen</a> |
     <a href="filechange.php?fileid='.$row['fileid'].'"> Umbenennen</a></td></tr>';
}

$login = $_SESSION['loginname'];





