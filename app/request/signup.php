<?php
    error_reporting(E_ERROR | E_WARNING | E_PARSE);
    ini_set('display_errors', 'On');
    require_once("../inc/session.php");
    require_once("../inc/dbx.php");
    require_once("../function.php");

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $email = $_POST['email'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $pwdX = $_POST['password'];
    $pwdY = $_POST['passwordrepeat'];
    // echo(emailExist($dbx, "SELECT * FROM user"));
    // exit;
    if(emailExist($dbx, $email) > 0){
        // exit;
        // echo(passwordMatch($pwdX, $pwdY));
        if(passwordMatch($pwdX, $pwdX)){
            // exit;
            $hashed_pwd = password_hash($pwdX, PASSWORD_BCRYPT);
            $dbx->insert("INSERT INTO user (first_name, last_name, email, password) VALUES (?,?,?,?)",[$fname,$lname,$email,$hashed_pwd]);
            $user = $dbx->select("SELECT * from user WHERE email = ?",[$email]);
            
            $_SESSION['user']['id'] = $user['0']['id'];
            $_SESSION['user']['email']= $user['0']['email'];
            $_SESSION['user']['name'] = $user['0']['first_name'] . " " . $user['0']['last_name'];
            redirect('index');
        }else{
            redirect("index", [
                'error' => 'wrongpass'
            ]);
        }
    }else{
        redirect("index", [
            'error' => 'mailused'
        ]);
    }
}else{
    redirect("index", [
        'error' => 'noform'
    ]);
}
;