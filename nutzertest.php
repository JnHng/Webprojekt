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


    <form class="nutzer" method="POST" action="">
        <b>Wählen Sie einen Nutzer:</b><br>
        <br>
        <input name="nutzer" placeholder="Nutzer wählen:" type=text><br>
        <br>
        <input type=submit name=submit value="Wählen">
    </form>
    </body>
    </html>

<?php

include "conn.php";

if (isset ($_POST["submit"])) {

    /* $id = ["id"];
    $id = $_SESSION['id']; */


    $nutzer = $_POST["nutzer"];
    $error = false;




// echo $nutzer;


    if (!empty($nutzer)) {



        $test = $db->prepare("SELECT username FROM nutzer WHERE username = :nutzer");
        $test->bindParam(':nutzer', $nutzer, PDO::PARAM_STR);
        $test->execute();
        $chosenone = $test->fetch(PDO::FETCH_ASSOC);

        if($chosenone == true) {
            echo 'Dieser Nutzer existiert: <br>';
            echo $nutzer;
            exit();
        }
        else{
            echo 'Dieser Nutzer existiert nicht: <br>';
            echo $nutzer;}

        } else {
        echo "Bitte geben Sie einen Nutzernamen ein!<br>";
        }


}

?>
