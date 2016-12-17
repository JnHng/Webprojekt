<!DOCTYPE html>
<html lang="de">
<head>

    <title>Dateien</title>
    <meta charset="UTF-8">
    <?php include "ses2.php"; ?>

</head>

<?php
/**
 * Created by PhpStorm.
 * User: Illia
 * Date: 04.12.2016
 * Time: 02:01
 */

include "conn.php";


$sql = "SELECT name FROM files";
foreach ($db->query($sql) as $row) {
    echo "<br /> $row[name].<br />";

}
?>

echo "'s Dateien<br/><br />";


echo "Hier geht es zur <br /><a href=\"abmelden.php\"> Abmeldung!</a><br />";

?>