<?php 
ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL);
require_once("layout/header.php");
// var_dump($_SESSION);
?>
<div style="text-align: center; margin-top: 2em;">
    <h1>Welcome To The eRevive Marketplace</h1>
    
    <p>Please create an account if you have yet to do so</p>
    <a href="<?= getURL('signup') ?>"><button class="btn mr-2 ml-2 text-white bg-warning" type="submit">Signup</button></a>
</div>


<?php require_once("layout/footer.php")?>