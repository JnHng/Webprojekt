<?php

$site_title = "Startseite";
include "header.php";
include "navigation.php";

$weiterleitungWennNichtAngemeldet="/~nl035/index.php";

if($_SESSION['loginname'] == false) {
    header("Location: $weiterleitungWennNichtAngemeldet");
}
?>

<body>

<div class="text-center" class="row">
    <div class="container">
    <div class="col-md-12">
        <h3>Upload your files here!</h3>

        <form action="../uploadjoin.php" method="post" enctype="multipart/form-data">
            <input style="margin-left: auto; margin-right: auto;" type="file" name="bilddatei" id="bilddatei"><br>
            <input type="submit" name="submit" value="Hochladen"></form>



    </div>
    </div>
</div>



</body>
</html>

