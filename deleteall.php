<?php
/**
 * Created by PhpStorm.
 * User: Illia
 * Date: 05.12.2016
 * Time: 12:10
 */



session_start();
?>

    <!DOCTYPE html>

    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Alle Files l�schen</title>
        <link rel="stylesheet" href="style.css">
        <?php  //include "ses2.php"; ?>
    </head>
    <body>


    <form class="delete" method="POST" action="">
        <b>Wollen Sie all ihre Dateien unwiderruflich l�schen?</b><br>
        <br>
        <input type=submit name="Ja" value="ALLES L�SCHEN!">
        <br><br>
    </form>
    </body>
    </html>

<?php




if (isset ($_POST["Ja"])) {

    include "conn.php";

    $login = $_SESSION['loginname'];

    try {$loesch = $db->prepare("DELETE FROM files WHERE username = :login");
        $loesch->bindParam(':login', $_SESSION['loginname'], PDO::PARAM_STR);


        $loesch->execute();

        echo "All ihre Dateien wurden gelöscht! <br>";

    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}





?>