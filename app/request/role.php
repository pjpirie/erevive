<?php
require_once("../inc/session.php");
require_once("../inc/dbx.php");
require_once("../function.php");
if($_SERVER["REQUEST_METHOD"] == "POST"){

    $admin_id = safeInput($_POST['id']);
    $user = safeInput($_POST['admin-user']);
    $role = safeInput($_POST['admin-role']);
    $pwd = safeInput($_POST['admin-pwd']);
    // debug(password_verify("pass123", getRecord($dbx, 'user', $admin_id)['password']));
    var_dump($admin_id);
    var_dump($user);
    var_dump($role);
    var_dump($pwd);
    var_dump(password_verify($pwd, getRecord($dbx, 'user', $admin_id)['password']));
    if(password_verify($pwd, getRecord($dbx, 'user', $admin_id)['password'])){
        $dbx->insert("UPDATE user_roles SET role_id = ? WHERE user_id = ?",[$role, $user]);
        redirect("admin", [
            'success' => 'userupdated'
        ]);
    }else{
        exit;
        redirect("admin", [
            'error' => 'wrongpwd'
        ]);
    }
        
}else{
    redirect("market", [
        'error' => 'noform'
    ]);
}
;