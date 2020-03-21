<?php
require_once("../inc/session.php");
require_once("../inc/dbx.php");
require_once("../function.php");
if($_SERVER["REQUEST_METHOD"] == "POST"){

    $id = safeInput($_POST['id']);
// exit;
    if(getUserID() == getRecord($dbx,'products', $id)['user_id'] || $_SESSION['user']['admin']){
        $dbx->insert("DELETE FROM products WHERE id = ? ",
        [$id]);
        redirect("market", [
            'success' => 'recorddeleted'
        ]);
    }else{
        redirect("market", [
            'error' => 'wronguser'
        ]);
    }
        
    // redirect("index");
}else{
    redirect("market", [
        'error' => 'noform'
    ]);
}
;