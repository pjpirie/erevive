<?php 
// require_once('../function.php');
if(currentPageIs('admin') && (!isAuth() || !isAdmin())){
    redirect("index", [
        'error' => 'noperm'
    ]);
}