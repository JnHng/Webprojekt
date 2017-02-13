<?php
$site_title = "Alles löschen";
include "header.php";
include "navigation.php";
?>

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

    $deleteall = "SELECT name, username FROM files WHERE username='$login'";


    $ergebnis = $db->query($deleteall);
    while($row = $ergebnis->fetch(PDO::FETCH_ASSOC)){
        //  echo $row['$login'].'/'.$row['name'].'<br/>';

        unlink($row['name']);

    }



        $loesch = $db->prepare("DELETE FROM files WHERE username = :login");
        $loesch->bindParam(':login', $_SESSION['loginname'], PDO::PARAM_STR);


        $loesch->execute();



        echo "All ihre Dateien wurden gel�scht! <br>";




}




?>