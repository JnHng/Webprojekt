<?php

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


    <form class="mail" method="POST" action="">
        <b>W�hlen Sie den Nutzer, dem Sie die Datei per Mail schicken wollen:</b><br>
        <br>
        <input name="email" placeholder="Mail w�hlen:" type=text><br>
        <br>
        <input type=submit name=submit value="Teilen">
    </form>
    </body>
    </html>

<?php

include "conn.php";

if (isset ($_POST["submit"])) {

    $login = $_SESSION['loginname'];
    $email = $_POST["email"];
    $filename = $_GET["name"];
    $fileid = $_GET["fileid"];

    echo $login;


    if (!empty($email)) {

        $einzigartig = $db->prepare("SELECT fileid, name, username FROM files WHERE fileid = :fileid");
        $einzigartig->execute(array('fileid' => $fileid));
        $ausgabe = $einzigartig->fetch();

        $fileiname=$ausgabe['name'];

        $eigene_mail = $_GET['email'];



        $test = $db->prepare("SELECT email FROM nutzer WHERE email = :email");
        $test->bindParam(':email', $email, PDO::PARAM_STR);
        $test->execute();
        $chosenone = $test->fetch(PDO::FETCH_ASSOC);

        if($chosenone == false) {
            echo 'Diese E-Mail existiert nicht.<br>';
            exit();
        }


        $betreff = "Geteilter: Filelink";

        $from = "From: $login $eigene_mail";


        mail($email, $betreff, $fileiname, $from);

        echo "Der Filelink wurde erfolgreich per Mail versendet <br>";

    } else {
        echo "Bitte geben Sie einen Nutzernamen ein!<br>";
    }


}

?>