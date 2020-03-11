<?php    

    error_reporting(E_ALL);
    ini_set('display_errors', 'On');
    require_once("../inc/session.php");
    require_once("../inc/dbx.php");
    require_once("../function.php");
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $email = $_POST['email'];
    $pwd = $_POST['password'];
    if($user = $dbx->select("SELECT * FROM user INNER JOIN user_roles ON user.id = user_roles.user_id WHERE email=?",[$email])){
        if(password_verify($pwd, $user['0']['password'])){
            $_SESSION['user']['id'] = $user['0']['id'];
            $_SESSION['user']['email']= $user['0']['email'];
            $_SESSION['user']['name'] = $user['0']['first_name'] . " " . $user['0']['last_name'];
            $_SESSION['user']['admin'] = $user['0']['role_id'] == 1 ? true : false;
            // var_dump($user[0]);
            // exit;
            redirect('index');
        }else{
            exit;
            redirect("login", [
                'error' => 'wrongpass'
            ]);
        }
    }else{
        echo("Wrong Mail");
        redirect("login", [
            'error' => 'wrongmail'
        ]);
    }
}else{
    echo('else');
    redirect("login", [
        'error' => 'noform'
    ]);
}