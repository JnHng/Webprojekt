
<!DOCTYPE html>
<html lang="de">
<head>

    <title>Dateien</title>
    <meta charset="UTF-8">

    <form class="file" method="POST" action="filesuch.php?submit=1">
    <input name="filename" placeholder="File-Name" type=name><br>
    <input type=submit name=submit value="Name suchen">
    <?php //include  "ses2.php"; ?>

</head>

<?php


if (isset ($_POST["submit"])) {
    /**
     * Created by PhpStorm.
     * User: Illia
     * Date: 04.12.2016
     * Time: 02:01
     */
    $such = $_POST["filename"];


    include "conn.php";

   /* $sql = "SELECT name FROM files WHERE name=:such";
    $result = $sql->execute(array('name' => $such));
    $user = $reg->fetchAll();
    $anzahl_user = $reg->rowCount();
    $nutzer = $sql->fetch(PDO::FETCH_ASSOC);

    foreach ($db->query($sql) as $row) {
        echo "<br /> $row[$such]<br />";

    } */

    $sql = "SELECT name FROM files";
    $resultat = $db-> query($sql);
    while($row = $resultat -> fetch (PDO::FETCH_ASSOC)){
        echo $row["name"]. "<br/>";
    }


    echo "'s Dateien<br/><br />";


    echo "Hier geht es zur <br /><a href=\"abmelden.php\"> Abmeldung!</a><br />";
}
?>