<?php
require_once("../inc/session.php");
require_once("../inc/dbx.php");
require_once("../function.php");
if($_SERVER["REQUEST_METHOD"] == "POST"){

    $id = safeInput($_POST['id']);
    $name = safeInput($_POST['prod-name']);
    $desc = safeInput($_POST['prod-desc']);
    $price = safeInput($_POST['prod-price']);
    $brand = safeInput($_POST['prod-brand']);
    $category = safeInput($_POST['prod-cat']);
    $imgURL = safeInput($_POST['imageURL']);
    // var_dump($id);
    // var_dump(getRecord($dbx, 'products', $id));
    // exit;
    if(isAuth()){
        $dbx->insert("INSERT INTO `products` (`name`, `user_id`, `description`, `price`, `category_id`, `date_added`, `image_url`, `brand`) VALUES (?, ?, ?, ?, ?, current_timestamp(), ?, ?) ",
        [$name, $id, $desc, $price, intval($category) ,$imgURL, $brand]);
        // var_dump([$name, $id, $desc, $price, intval($category) ,$imgURL, $brand]);
        // exit; 
        redirect("market", [
            'success' => 'recordadded'
        ]);
    }

    redirect("index");
}else{
    redirect("market", [
        'error' => 'noform'
    ]);
}
;