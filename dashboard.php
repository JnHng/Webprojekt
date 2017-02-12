<?php
$site_title = "Profil";
include "header.php";
include "navigation.php";
include "conn.php";

$weiterleitungWennNichtAngemeldet="index.php";
if($_SESSION['loginname'] == false) {header("Location: $weiterleitungWennNichtAngemeldet");} ?>

<div class="container">
    <div class="row">
        <div class="col-md-2">
            <img class="center-block" src="<?php echo $ordner . $_SESSION['profilbild'] ?> "style="width: 100%; padding-top: 10px">
                        <h4 ><?php echo "$login" ?></h4>

                        <a href="profilbild-upload.php">Neues Profilbild</a> <br>
                        <a href="passwort-change.php">Passwort ändern</a>
        </div>

        <div class="text-center" class="col-md-10">
            <h3>Upload your files here!</h3>
            <form action="uploadjoin.php" method="post" enctype="multipart/form-data">
                <input style="margin-left: auto; margin-right: auto; padding-top: 10px;" type="file" name="bilddatei" id="bilddatei"><br>
                <input type="submit" name="submit" value="Hochladen"></form>

        </div>

        <div class="col-md-10">
            <h3 class="text-center" >Meine Dateien</h3>
            <table class="table table-hover"><tbody>
                <?php include "dateien.php" ?> </tbody></table>

        </div>

    </div>
</div>