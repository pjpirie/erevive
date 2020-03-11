<?php 
ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL);
require_once("layout/header.php");
?>


<div class="card" style="margin: 5rem auto; width: 20vw; border-top: none; border-left: none; border-right: none;">
    <img src="https://via.placeholder.com/150

C/O https://placeholder.com/" class="card-img-top" style="padding: 2rem; border-radius: 50%; "alt="...">
    <div class="card-body" style="border: 1px solid #ccc">
        <h5 class="card-title"><?= getUsername() ?></h5>
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        <a href="<?= getURL('market', ['user' => getUserID()]) ?>" class="btn btn-primary">View Items</a>
    </div>
</div>


<?php require_once("layout/footer.php")?>