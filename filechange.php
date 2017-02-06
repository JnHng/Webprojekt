<?php
/**
 * Created by PhpStorm.
 * User: Illia
 * Date: 02.02.2017
 * Time: 04:28
 */


session_start();
?>

    <!DOCTYPE html>

    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Dateinamen ändern</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>


    <form class="filechange" method="POST" action="">
        <b>Dateinamen ändern:</b><br>
        <br>
        <input name="datei" placeholder="Neuer Dateiname:" type=text><br>
        <br>
        <input type=submit name=submit value="Dateinamen ändern">
    </form>
    </body>
    </html>

<?php

include "conn.php";

if (isset ($_POST["submit"])) {

    $login = $_SESSION['loginname'];
    $newname = $_POST["datei"];

    $datei = $_FILES['bilddatei']['name'];
    $tmp_datei = $_FILES['bilddatei']['tmp_name'];
    $ordner = "file/";
    $ordner_datei = ($ordner . basename($datei));


    $dateiname = $_GET["name"];




    echo $login; 


    if (!empty($newname)) {
      if (copy("file/$dateiname", "file/$newname.doc")){

        //rename("file/$dateiname", "file/$newname.doc");

        $neuername = "$newname.doc";

        echo "Okidoki:!<br>";

            $fileupdate = $db->prepare("UPDATE files SET name = :neuername WHERE username = :login AND name = :dateiname");

            $fileupdate->bindParam(':neuername', $neuername, PDO::PARAM_STR);
            $fileupdate->bindParam(':dateiname', $dateiname, PDO::PARAM_STR);
            $fileupdate->bindParam(':login', $_SESSION['loginname'], PDO::PARAM_STR);

            $fileupdate->execute();
            unset ($fileupdate);

            echo ' Ihr Dateiname wurde erfolgreich geändert. Zurück zu <a href="dateien.php">dateien.php</a>';



      } else {
          echo "Fehler!<br>";
      }


    } else {
        echo "Bitte geben Sie einen Namen ein!<br>";
    }


}

?>
