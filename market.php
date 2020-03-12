<?php 
ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
error_reporting(E_ERROR | E_WARNING | E_PARSE);
require_once("layout/header.php");
?>

<div class="market">
    <?= getProducts($dbx) ?>
</div>


<?php require_once("layout/footer.php")?>