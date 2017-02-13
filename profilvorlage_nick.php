<?php
$site_title = "Profil";
include "header.php";
include "navigation.php";
$ordner = "Profilbilder/";
?>

<body>
<div class="row">
    <div class="container">
    <div class="text-center" class="col-md-12">
        <h3>Das bist Du!</h3>

    <img class="center-block" src="<?php echo $ordner . $_SESSION['profilbild'] ?> "style="width: 400px; padding-top: 10px"/>
        <h4 class="text-center" style="padding-top: 10px"><?php echo "$login" ?></h4>


        <a href="profilbild-upload.php">Neues Profilbild</a> |
        <a href="passwort-change.php">Passwort ändern</a> |
        <a href="profil-loeschen.php">Profil löschen</a>
    </div>
    </div>
</div>

</body>

</html>