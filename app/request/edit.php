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
    if(getUserID() == getRecord($dbx,'products', $id)['user_id'] || $_SESSION['user']['admin']){
        $dbx->insert("UPDATE products SET name = ?, description = ?, brand = ?, price = ?, category_id = ?, image_url = ? WHERE id = ? ",
        [$name, $desc, $brand, $price,$category ,$imgURL, $id]);
        redirect("market", [
            'success' => 'recordupdated'
        ]);
    }

    redirect("index");
}else{
    redirect("market", [
        'error' => 'noform'
    ]);
}
;