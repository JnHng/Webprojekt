<?php
$site_title = "Hochladen";
include "header.php";
?>

<body>

<?php include "navigation.php";?>

<div class="text-center" class="row">
    <div class="container">
        <div class="col-md-12">
            <h3>Upload your files here!</h3>

            <form action="uploadjoin.php" method="post" enctype="multipart/form-data">
                <input style="margin-left: auto; margin-right: auto; padding-top: 10px;" type="file" name="bilddatei" id="bilddatei">
                <input class="text-center" type="submit" name="submit" value="Upload">
            </form>
        </div>
    </div>
</div>

</body>
</html>