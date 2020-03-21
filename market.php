<?php 
ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
error_reporting(E_ERROR | E_WARNING | E_PARSE);
require_once("layout/header.php");
?>

<div class="market">
    <?php
    if(isset($_GET['user'])){
        echo(getProducts($dbx, $_GET['user']));
    }elseif(isset($_GET['search-filter'])){
        if($_GET['search-bar'] != ""){
            // echo('BREAK 5');
            $query = $dbx->select("SELECT * FROM products WHERE {$_GET['search-filter']} = ?",[('%'.$_GET['search-bar'].'%')], true);
            if($_GET['search-filter'] == "name"){
                // echo('BREAK Name');
                $query = $dbx->select("SELECT products.*, category.category_name FROM products INNER JOIN category on products.category_id = category.id WHERE name LIKE ?",["%{$_GET['search-bar']}%"]);
            }elseif($_GET['search-filter'] == "category_id"){
                // echo('BREAK Category');
                $query = $dbx->select("SELECT products.*, category.category_name FROM products INNER JOIN category on products.category_id = category.id WHERE category.category_name LIKE ?",["%{$_GET['search-bar']}%"]);
            }elseif($_GET['search-filter'] == "date_added"){
                // echo('BREAK Age');
                $query = $dbx->select("SELECT products.*, category.category_name FROM products INNER JOIN category on products.category_id = category.id WHERE 1 ORDER BY  date_added DESC");
            }elseif($_GET['search-filter'] == "brand"){
                // echo('BREAK Brand');
                $query = $dbx->select("SELECT products.*, category.category_name FROM products INNER JOIN category on products.category_id = category.id WHERE brand LIKE ?",["%{$_GET['search-bar']}%"]);
            }
            // exit;
            echo(getProducts($dbx, null , $query));
        }else{
            // echo('BREAK 6');
            // exit;
            if($_GET['search-filter'] == "name"){
                // echo('BREAK Name');
                $query = $dbx->select("SELECT products.*, category.category_name FROM products INNER JOIN category on products.category_id = category.id WHERE 1 ORDER BY name");
            }elseif($_GET['search-filter'] == "category_id"){
                // echo('BREAK Category');
                $query = $dbx->select("SELECT products.*, category.category_name FROM products INNER JOIN category on products.category_id = category.id WHERE 1 ORDER BY category_id");
            }elseif($_GET['search-filter'] == "date_added"){
                // echo('BREAK Age');
                $query = $dbx->select("SELECT products.*, category.category_name FROM products INNER JOIN category on products.category_id = category.id WHERE 1 ORDER BY date_added DESC");
            }elseif($_GET['search-filter'] == "brand"){
                // echo('BREAK Brand');
                $query = $dbx->select("SELECT products.*, category.category_name FROM products INNER JOIN category on products.category_id = category.id WHERE 1 ORDER BY brand");
            }
    
            echo(getProducts($dbx, null , $query));
        }
    }else{
        echo(getProducts($dbx));
    }
    ?>
</div>


<?php require_once("layout/footer.php")?>