
<?php
include "header.php";

$text = $_POST['text'];
$notiz = $_SESSION['text'];

if (isset ($_POST["submit"])) {



$login = $_SESSION['loginname'];
$text = $_POST['text'];
$notiz = $_SESSION['text'];


    if (!empty($text)) {


        $schreiben = $db->prepare("UPDATE nutzer SET text = :text WHERE username = :login");


            $schreiben->bindParam(':text', $text, PDO::PARAM_STR);
            $schreiben->bindParam(':login', $_SESSION['loginname'], PDO::PARAM_STR);
            $schreiben->execute();


            echo

            "$login s'Notiz erstellt! $text";


    } else {
        #echo "Schreiben Sie zuerst eine Notiz!";
        header("Location: meine-dateien.php");
    }




    $sql = "SELECT * FROM nutzer WHERE username='$login' AND text='$text'";

    $query = $db->query($sql);
    if ($query == false) {
        die(var_export($db->errorinfo(), TRUE));
    }


    if ($zeile = $query->fetch(PDO::FETCH_OBJ)) {

        if ($zeile->text == $text && $zeile->username == $login) {
            $_SESSION["loginname"] = $zeile->username;
            $_SESSION["text"] = $zeile->text;



        }
        if($sql == true) {
            header("Location: meine-dateien.php");
        }

    }

    else {
        echo "Fehler aufgetreten";
    }

}

?>

