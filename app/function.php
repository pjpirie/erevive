<?php
require_once("inc/session.php");
require_once("inc/dbx.php");
error_reporting(-1);

function loadStyles(){
    $styles = 
    '
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">
    ';
    return $styles;
}
function loadScripts(){
    $scripts = '<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    ';
    return $scripts;
}
function isAuth(){
    return isset($_SESSION['user']) ? true : false;
}
function isAdmin(){
    return $_SESSION['user']['admin'];
}
function getUserID($user = []){
    // if(empty($user)){
        return $_SESSION['user']['id'];
    // }else{
        // return $dbx->select("SELECT id FROM user where ")
    // }
}
function getUsername(){
    return $_SESSION['user']['name'];
}
/**
 * returns an absolute path to the root directory of the project
 *
 * @return string
 */
function getBaseURL(){
    return "http://" . $_SERVER['HTTP_HOST'] . "/eRevive";
}
/**
 * returns the page the the function was called from as a string eg index.php = "index"
 *
 * @return string
 */
function getPage(){
    $current_location = "index";
    if($url_part = array_pop(explode("/", $_SERVER["REQUEST_URI"]))){
        $url_part = array_slice(explode(".php", $url_part),0,1);
        if(!empty($url_part)){
            return $url_part[0];
        }
    }
    return $current_location;
}

/**
 * checks if the current page is equal to a set location
 *
 * @param $location
 * @return bool
 */
function currentPageIs($location){
    $current_location =  getPage();
    return $current_location === $location;
}


/** 
 * creates an absolute path to a specific page
 *
 * @param string $location
 * @param array $param
 * @return string
 */
function getURL(string $location, array $param = []){
    $base_url = getBaseURL();
    $path = !empty($param) || $location !== "index" ? "{$location}.php" : "";
    if(!empty($param)){
        $query_params = http_build_query($param);
        $path .= "?{$query_params}";
         // var_dump($query_params);
         // exit();
    }
    return "{$base_url}/{$path}";
}

/**
  * creates an absolute path to a specific request file
  *
  * @param string $location
  * @param array $param
  * @return string
  */
function getRequestURL(string $location, array $param = []){
    $base_url = getBaseURL();
    $path = !empty($param) || $location !== "index" ? "{$location}.php" : "";
    if(!empty($param)){
        $query_params = http_build_query($parameters);
        $path .= "?{$query_params}";
    }
    return "{$base_url}/app/request/{$path}";
}



/**
 * redirects the user ti a specific page using headers
 *
 * @param string $location
 * @param array $param
 */
function redirect(string $location, array $param = []){
    $path_location = getURL($location, $param);
    // die(getURL($location, $param));
    header("Location: {$path_location}");
    // return "Location: {$path_location}";
}

function emailExist($dbx, string $targetEmail){
    //  return ($dbx->count("SELECT * FROM user WHERE email = ?",[$targetEmail])) > 0 ? true : false;
    return $dbx->select("SELECT * FROM user WHERE email = ?",[$targetEmail]);
}

function passwordMatch(string $pwd_x, string $pwd_y){
    return $pwd_x == $pwd_y ? true : false;
}


// echo("FUNC");
// var_dump(emailExist("paul@paul.com"));