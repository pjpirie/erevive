<?php 
require_once("app/inc/init.php"); 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?= loadStyles(); ?>
    <title>eRevive</title>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#"><span style="color: #61af6d">e</span>Revive</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="<?= getURL('index') ?>">Home<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= getURL('market') ?>">Market</a>
                    </li>
                </ul>
                <form method="get" action="<?=getURL('market')?>" class="form-inline ml-md-auto ml-lg-auto mr-sm-auto mr-md-3 mr-lg-3">
                    <input class="form-control" name="search-bar" id="search-bar" type="search" placeholder="Search" aria-label="Search">
                    <div class="form-group">
                        <select class="form-control" id="search-filter" name="search-filter">
                        <option value="name">Product Name</option>
                        <option value="category_id">Category</option>
                        <option value="brand">Brand</option>
                        <option value="date_added">Upload Date</option>
                        </select>
                    </div>
                    <input class="btn btn-outline-success my-2 my-sm-0" type="submit" value="Search">
                </form>
                <?php if(isset($_GET['error'])): ?>
                    <script>
                        errorHandling(<?=$_GET['error']?>);
                    </script>
                <?php endif;?>
                <?php if(isset($_SESSION['user'])): ?>
                    <?php if(isset($_SESSION['user']['admin']) && $_SESSION['user']['admin'] == true): ?>
                        <a href="<?= getURL('admin')?>"><button class="btn ml-2 text-white bg-primary" type="submit">Admin Area</button></a>
                    <?php endif;?>
                    <a href="<?= getURL('create') ?>"><button class="btn ml-2 bg-warning" type="submit">Add Item</button></a>
                    <a href="<?= getURL('profile') ?>"><button class="btn ml-2 border-dark" type="submit"><?= $_SESSION['user']['name']?></button></a>
                    <a href="<?= getRequestURL('logout') ?>"><button class="btn mr-2 ml-2 text-white bg-danger" type="submit">Logout</button></a>
                <?php else:?>
                    <a href="<?= getURL('login') ?>"><button class="btn ml-2 text-white bg-success" type="submit">Login</button></a>
                    <a href="<?= getURL('signup') ?>"><button class="btn mr-2 ml-2 text-white bg-warning" type="submit">Signup</button></a>
                <?php endif;?>
            </div>
        </nav>
    </header>