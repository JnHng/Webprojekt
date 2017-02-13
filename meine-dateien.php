<?php

$site_title = "Meine Dateien";
include "header.php";
include "navigation.php";
$ordner = "Profilbilder/";
?>

<body>




<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h3 style="padding-bottom: 10px" class="text-center">Meine Dateien</h3>
            <table class="table table-hover"><tbody>
                <?php
                $login = $_SESSION['loginname'];
                $ordner = "uploads/";

                $two_tables = "SELECT name, fileid FROM files WHERE username='$login' ORDER BY name";

                $ergebnis = $db->query($two_tables);
                $zahl = $ergebnis->rowCount();
                while($row = $ergebnis->fetch(PDO::FETCH_ASSOC)){

                    echo ' <tr><td> <a href="'.$row['name'].'">'.$row['name'].'</a></td>
     <td style="text-align: right;"><a href="mail.php?name='.$row['name']."&fileid=".$row['fileid'].'"> Teilen</a> |
     <a href="filedelete.php?fileid='.$row['fileid']."&name=".$row['name'].'">Löschen</a> |
     <a href="filechange-neu.php?fileid='.$row['fileid']."&name=".$row['name'].'"> Umbenennen</a> </td></tr>';
                } ?> </tbody></table>

            <p class="text-center"><a class="text-center" href="allesloeschen.php">Alle Dateien löschen</a></p>



        </div>
        <div class="col-md-4">

            <form class="text" method="POST" action="text.php">
                <h3 style="padding-bottom: 8px;" >Notizen</h3>
                <textarea style="padding: 10px; width: 100%;" name="text" ><?php
                    echo $_SESSION['text']; ?></textarea>
                <input class="btn btn-link" type=submit name=submit value="Speichern">
            </form>

        </div>



    </div>
</div>

</body>