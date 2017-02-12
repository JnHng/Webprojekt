<?php

session_start();
include "ses2.php";
?>

    <!DOCTYPE html>

    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Nutzer löschen</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>


    <form class="del" method="POST" action="">
        <b>Wollen Sie diese Datei wirklich löschen?</b><br>
        <br>
        <input type=submit name="Ja" value="Jep">
        <br>
        <input type=submit name="Nein" value="Nope">
    </form>
    </body>
    </html>

<?php

if (isset ($_POST["Nein"])) {


    echo header("Location: dateien.php");
}

if (isset ($_POST["Ja"])) {


    include "conn.php";


    $login = $_SESSION['loginname'];
    $fileid = $_GET['fileid'];


    try {
        $loesch = $db->prepare("DELETE FROM files WHERE username = :login AND fileid = :fileid");


        $loesch->bindParam(':login', $login, PDO::PARAM_STR);
        $loesch->bindValue(':fileid', $fileid, PDO::PARAM_INT);

        $loesch->execute();

        echo ' Ihre Datei wurde gelöscht. Zurück zu <a href="dateien.php">dateien.php</a>';

    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}




?>