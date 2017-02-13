<?php
session_start();
include "conn.php"?>

<!DOCTYPE html>
<html lang="en">
<?php
if (!isset($site_title)) {
    $site_title = "Startseite";}
?>

<?php
$user_input = $_GET['user_input'];
$user_input = strip_tags($user_input);

#Profil
$login = $_SESSION['loginname'];
$datei = $_SESSION['profilbild'];

$datei = $_FILES['bilddatei']['name'];
$ordner = "uploads/";

?>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" charset="UTF-8">
    <title><?php echo $site_title; ?></title>
    <link rel="stylesheet" href="/style.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

</head>