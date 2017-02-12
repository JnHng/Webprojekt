<?php

$site_title = "Meine Dateien";
include "header.php";
include "navigation.php";


$weiterleitungWennNichtAngemeldet="/~nl035/index.php";

if($_SESSION['loginname'] == false) {
    header("Location: $weiterleitungWennNichtAngemeldet");
}?>


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3 style="padding-bottom: 10px" class="text-center" >Meine Dateien</h3>
            <table class="table table-hover"><tbody>
            <?php include "dateien.php" ?> </tbody></table>

        </div>
    </div>
</div>