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

    $indivdiual = $login.'_';


    echo $login;


    if (!empty($newname)) {

        /* $eingabe = $newname;
        $suchen = '/./';
        preg_match($eingabe, $suchen, $punkt); */

        /* if ($newname = "."){

             echo "Nope: .";
             exit();
         } */

        $array = explode(".",$dateiname);

        echo $array[0]."<br>".$array[1]."<br>";

        // $typ = $array[1];

        rename("file/$dateiname", "file/$indivdiual$newname.$array[1]");

        //rename("file/$dateiname", "file/$newname.doc");

        $neuername = "$indivdiual$newname.$array[1]";

        echo "Okidoki: $neuername!<br>";

        $fileupdate = $db->prepare("UPDATE files SET name = :neuername WHERE username = :login AND name = :dateiname");

        $fileupdate->bindParam(':neuername', $neuername, PDO::PARAM_STR);
        $fileupdate->bindParam(':dateiname', $dateiname, PDO::PARAM_STR);
        $fileupdate->bindParam(':login', $_SESSION['loginname'], PDO::PARAM_STR);

        $fileupdate->execute();
        unset ($fileupdate);

        echo ' Ihr Dateiname wurde erfolgreich geändert. Zurück zu <a href="dateien.php">dateien.php</a>';

        /* $statement->execute(array("passwort1" => $passwort1, "id" => $id));
         unset ($statement);
         echo "Ihr Passwort wurde erfolgreich ge?ndert!<br>"; */




    } else {
        echo "Bitte geben Sie einen Namen ein!<br>";
    }


}

?>
