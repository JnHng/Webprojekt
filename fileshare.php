<?php
/**
 * Created by PhpStorm.
 * User: Illia
 * Date: 03.02.2017
 * Time: 04:09
 */



session_start();
?>

    <!DOCTYPE html>

    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Datei teilen</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>


    <form class="filechange" method="POST" action="">
        <b>Wählen Sie den Nutzer, dem Sie die Datei zusenden wollen:</b><br>
        <br>
        <input name="nutzer" placeholder="Nutzer wählen:" type=text><br>
        <br>
        <input type=submit name=submit value="Teilen">
    </form>
    </body>
    </html>

<?php

include "conn.php";

if (isset ($_POST["submit"])) {

    /* $id = ["id"];
    $id = $_SESSION['id']; */

    $login = $_SESSION['loginname'];
    $nutzer = $_POST["nutzer"];
    $filename = $_GET["name"];




    echo $login, $filename;


    if (!empty($nutzer)) {



        $test = $db->prepare("SELECT username FROM nutzer WHERE username = :nutzer");
        $test->bindParam(':nutzer', $nutzer, PDO::PARAM_STR);
        $test->execute();
        $chosenone = $test->fetch(PDO::FETCH_ASSOC);

        if($chosenone == false) {
            echo 'Dieser Nutzer existiert nicht.<br>';
            exit();
        }

else {

    $fileshare = $db->prepare("INSERT INTO files (name, username) VALUES (:filename, :nutzer)");
    $fileshare->bindParam(':filename', $filename, PDO::PARAM_STR);
    $fileshare->bindParam(':nutzer', $nutzer, PDO::PARAM_STR);
    $fileshare->execute();


    /*$fileshare = $db->prepare("UPDATE files SET name = :nutzer WHERE fileid = :fileid");
    $fileshare->bindParam(':nutzer', $nutzer, PDO::PARAM_STR);
    $fileshare->bindValue(':fileid', $_GET['fileid'], PDO::PARAM_INT);
    $fileshare->execute();
    unset ($fileshare);*/

    echo ' Sie haben Ihre Datei erfolgreich geteilt. Zurück zu <a href="dateien.php">dateien.php</a>';

    /* $statement->execute(array("passwort1" => $passwort1, "id" => $id));
     unset ($statement);
     echo "Ihr Passwort wurde erfolgreich ge?ndert!<br>"; */

} } else {
        echo "Bitte geben Sie einen Nutzernamen ein!<br>";
    }


}

?>
