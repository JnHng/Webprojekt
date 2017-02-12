<?php
/**
 * Created by PhpStorm.
 * User: Illia
 * Date: 03.02.2017
 * Time: 04:09
 */



session_start();
include "ses2.php";
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
        <b>W�hlen Sie den Nutzer, dem Sie die Datei zusenden wollen:</b><br>
        <br>
        <input name="nutzer" placeholder="Nutzer w�hlen:" type=text><br>
        <br>
        <input type=submit name=submit value="Teilen">
    </form>
    </body>
    </html>

<?php

include "conn.php";

if (isset ($_POST["submit"])) {


    $login = $_SESSION['loginname'];
    $nutzer = $_POST["nutzer"];
    $filename = $_GET["name"];

    $indivdiual = $nutzer.'_';


    echo $login.':', $filename;


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

    if (copy("file/$filename", "file/$indivdiual$filename")){


        $neuername = "$indivdiual$filename";


    $fileshare = $db->prepare("INSERT INTO files (name, username) VALUES (:neuername, :nutzer)");
    $fileshare->bindParam(':neuername', $neuername, PDO::PARAM_STR);
    $fileshare->bindParam(':nutzer', $nutzer, PDO::PARAM_STR);
    $fileshare->execute();


    echo ' Sie haben Ihre Datei erfolgreich geteilt. Zur�ck zu <a href="new_files/dateien.php">dateien.php</a>';

    } else {
        echo "Bitte geben Sie einen Nutzernamen ein!<br>";
    }
}


    } else {
        echo "Bitte geben Sie einen Nutzernamen ein!<br>";
    }


}

?>