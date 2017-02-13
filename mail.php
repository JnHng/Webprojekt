<?php
$site_title = "Datei teilen";
include "header.php";
include "navigation.php"; ?>

    <body>

    <div class="container">
        <div class="row">
            <div class="text-center" class="col-md-12">
    <form  class="mail" method="POST" action="">
        <h3 style="padding-bottom: 10px;">Mit wem wollen Sie teilen?</h3>
        <div class="form-group"><input class="form-control" name="nutzer" placeholder="Nutzernamen eingeben" type=text></div>
        <input class="btn btn-link" type=submit name=submit value="Jetzt teilen!">
    </form>

                <?php

                if (isset ($_POST["submit"])) {

                    $login = $_SESSION['loginname'];
                    $nutzer = $_POST["nutzer"];
                    $filename = $_GET["name"];
                    $fileid = $_GET["fileid"];




                    if (!empty($nutzer)) {

                        $einzigartig = $db->prepare("SELECT fileid, name, username FROM files WHERE fileid = :fileid");
                        $einzigartig->execute(array('fileid' => $fileid));
                        $ausgabe = $einzigartig->fetch();

                        $filename=$ausgabe['name'];

                        $eigene_mail = $_GET['email'];


                        /* $result = $db->query("SELECT * from files WHERE fileid = $fileid")->fetchObject();


                         if($result == false) {
                             echo "Die FileId ist nicht korrekt!";
                             exit();
                         }

                         echo md5($result->name); */

                        $usermail = $db->prepare("SELECT username, email FROM nutzer WHERE username = :nutzer");
                        $usermail->execute(array('nutzer' => $nutzer));
                        $ausgabe = $usermail->fetch();

                        $email=$ausgabe['email'];



                        $test = $db->prepare("SELECT email FROM nutzer WHERE email = :email");
                        $test->bindParam(':email', $email, PDO::PARAM_STR);
                        $test->execute();
                        $chosenone = $test->fetch(PDO::FETCH_ASSOC);

                        if($chosenone == false) {
                            echo 'Diese E-Mail existiert nicht.<br>';
                            exit();
                        }

                        $ordner = "uploads/";

                        $betreff = "$login hat mit Ihnen eine Datei geteilt.";

                        $message = "https://mars.iuk.hdm-stuttgart.de/~nl035/$filename";

                        $headers[] = 'MIME-Version: 1.0';
                        $headers[] = 'Content-type: text/html; charset=utf-8';
                        $headers[] = "From: $login $eigene_mail";




                        mail($email, $betreff, $message, implode("\r\n", $headers));

                        echo "Der Filelink wurde erfolgreich per Mail versendet. <br>";

                    } else {
                        echo "Bitte geben Sie einen Nutzernamen ein!<br>";
                    }


                }

                ?>
            </div>
        </div>
    </div>
    </body>
    </html>

