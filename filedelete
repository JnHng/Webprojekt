<?php

session_start();
?>

    <!DOCTYPE html>

    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Nutzer löschen</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>


    <form class="change" method="POST" action="">
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



    try {
        $loesch = $db->prepare("DELETE FROM files WHERE username = :login AND fileid = :fileid");


        $loesch->bindParam(':login', $_SESSION['loginname'], PDO::PARAM_STR);
        $loesch->bindValue(':fileid', $_GET['fileid'], PDO::PARAM_INT);

        $loesch->execute();
        unset ($loesch);

        echo ' Ihre Datei wurde gelöscht. Zurück zu <a href="dateien.php">dateien.php</a>';

        /* $statement->execute(array("passwort1" => $passwort1, "id" => $id));
         unset ($statement);
         echo "Ihr Passwort wurde erfolgreich ge?ndert!<br>"; */
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}




?>
