<?php

session_start();

$login = $_SESSION['loginname'];
$datei = $_SESSION['profilbild'];

$datei = $_FILES['bilddatei']['name'];
$tmp_datei = $_FILES['bilddatei']['tmp_name'];
$typ = $_FILES['bilddatei']['type'];
$size = $_FILES['bilddatei']['size'];
$max = 2097152;
$fehler = $_FILES['bilddatei']['error'];
$ordner = "Profilbilder/";
$ordner_datei = ($ordner.basename($datei));
$dateiname = pathinfo($ordner_datei, PATHINFO_FILENAME);
$dateiform = pathinfo($ordner_datei, PATHINFO_EXTENSION);
?>

<html lang="de">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" charset="UTF-8">
    <title>My Profile</title>
    <link rel="stylesheet" href="style.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>

<body>

<nav class="nav nav-pills">
    <div class="container">
        <ul class="nav navbar-nav">
            <li><a href="#">Home</a></li>
            <li><a href="dateien.php">My Files</a></li>
            <li class="active"><a href="Upload%20Form.html">Upload</a></li>
            <li><a href="profilvorlage_nick.php">Profile<span class="sr-only">(aktuell)</span></a></li>
            <li><a href="abmelden.php">Log Out</a></li>
        </ul>
    </div>
</nav>

<div class="row">
    <div class="container">
    <div class="text-center" class="col-md-12">
        <h3>Das bist Du!</h3>

    <img class="center-block" src="<?php echo $ordner . $_SESSION['profilbild'] ?> "style="width: 400px; padding-top: 10px"/>
        <h4 class="text-center" style="padding-top: 10px"><?php echo "$login" ?></h4>


        <a href="bearbeiten2.php">Neues Profilbild | </a>
        <a href="pwchange2.php">Passwort ändern</a>
    </div>
    </div>
</div>





</body>

