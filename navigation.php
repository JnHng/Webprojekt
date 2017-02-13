<?php $weiterleitungWennNichtAngemeldet="index.php";
if($_SESSION['loginname'] == false) {header("Location: $weiterleitungWennNichtAngemeldet");}
include "header.php";
$ordner = "Profilbilder/";

?>

<nav class="col-md-10" class="nav nav-pills">
    <div class="container">
        <ul class="nav navbar-nav">
            <li><a href="meine-dateien.php">Meine Dateien</a></li>
            <li><a href="uploadjoin.php">Upload</a></li>
            <li><a  href="profilvorlage_nick.php">Profil</a></li>
            <li><a href="abmelden.php">Log Out</a></li>
        </ul>
    </div>
</nav>

        <div class="col-md-2">

<div style="padding-top: 10px; ">
    <img class=img-circle  src="<?php echo $ordner . $_SESSION['profilbild'] ?> "style="width: 60px; box-shadow: 0px 0px 15px grey;">
</div>
        </div>