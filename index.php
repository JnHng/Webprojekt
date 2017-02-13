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
    <h1 class="text-center" style="padding-bottom: 20px;">Hi ich bin Cloudia!</h1>
    <img style="padding-bottom: 20px;" src="https://s28.postimg.org/guqx9csnx/SKY.jpg" class="img-responsive" alt="Header">
    <h3 class="text-center">I am your digital backpack, where you can take your files everywhere you want with you!</h3>
</div>

<div class="container" style="padding-top: 40px">
    <div class="row">
        <div class="col-md-6">
            <form  class="login" method="POST" action="login.php?submit=1">
                <div class="form-group">
                    <input type="text" name="loginname" class="form-control" id="beispielFeldEmail1" placeholder="Username">
                </div>

                <div class="form-group">
                    <input type="password" name="loginpasswort" class="form-control" id="beispielFeldPasswort1" placeholder="Passwort">
                </div>

                <button type="submit" name=submit value="Einloggen" class="btn btn-link">Anmelden</button>
            </form>


        </div>


        <div class="col-md-6">

            <form class="register" method="POST" action="regmatch.php?submit=1">

                <div class="form-group"><input name="username" class="form-control" placeholder="Username" type=text></div>
                <div class="form-group"><input name="email" class="form-control" placeholder="E-Mail" type=email></div>
                <div class="form-group"><input name="passwort1" class="form-control" placeholder="Passwort" type=password></div>
                <div class="form-group"><input name="passwort2" class="form-control" placeholder="Passwort wiederholen" type=password></div>

                <button type="submit" type=submit name=submit value="Registrieren" class="btn btn-link">Registieren</button>
            </form>
        </div>
    </div>
</div>


</body>

</html>