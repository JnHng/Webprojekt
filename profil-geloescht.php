<?php
$site_title = "Startseite";
include "header.php";
$ordner = "Profilbilder/";

$weiterleitungWennAngemeldet = "/~nl035/meine-dateien.php";

if($_SESSION['loginname'] == true) {
    header("Location: $weiterleitungWennAngemeldet");
}
?>

<body>

<div class="fluid-container">
    <h1 class="text-center" style="padding-bottom: 20px;">Ihr Profil wurde vollständig gelöscht!</h1>
    <img style="padding-bottom: 20px;" src="https://s28.postimg.org/guqx9csnx/SKY.jpg" class="img-responsive" alt="Header">
    <h3 class="text-center"><a href=index.php> Weiter zur Startseite!</a></h3>
</div>


</body>

</html>