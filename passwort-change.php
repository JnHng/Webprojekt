<?php
$site_title = "Passwort ändern";
include "header.php";
include "navigation.php";
include "conn.php";

$weiterleitungWennNichtAngemeldet="index.php";
if($_SESSION['loginname'] == false) {header("Location: $weiterleitungWennNichtAngemeldet");} ?>

<body>

<div class="container">
<div class="row">

    <div class="text-center"  class="col-md-12">
        <form class="change" method="POST" action="passwort-change.php?submit=1">
        <h3>Passwort ändern</h3><br>
            <div class="form-group"><input class="form-control" name="passwort1" placeholder="Neues Passwort" type=password></div>
            <div class="form-group"><input class="form-control" name="passwort2" placeholder="Passwort wiederholen" type=password></div>
            <button class="btn btn-link" type=submit name=submit>Passwort ändern</button>
        </form>

        <?php

        if (isset ($_POST["submit"])) {

            /* $id = ["id"];
            $id = $_SESSION['id']; */

            $login = $_SESSION['loginname'];
            $passwort1 = $_POST["passwort1"];
            $passwort2 = $_POST["passwort2"];
            $hash = md5($passwort1);


            if (!empty($passwort1) && !empty($passwort2) && $passwort1 == $passwort2) {

                try {
                    $update = $db->prepare("UPDATE nutzer SET passwort = :hash WHERE username = :login");


                    $update->bindParam(':hash', $hash, PDO::PARAM_STR);
                    $update->bindParam(':login', $_SESSION['loginname'], PDO::PARAM_STR);
                    $update->execute();
                    unset ($update);

                    echo "Ihr Passwort wurde erfolgreich geändert!<br>";

                    /* $statement->execute(array("passwort1" => $passwort1, "id" => $id));
                     unset ($statement);
                     echo "Ihr Passwort wurde erfolgreich geändert!<br>"; */
                } catch (PDOException $e) {
                    echo $e->getMessage();
                }
            } else {
                echo "Passwörter müssen identisch sein!<br>";
            }


        }

        ?>

    </div>
</div>
</div>

</body>
</html>

