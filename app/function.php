<?php
require_once("inc/session.php");
require_once("inc/dbx.php");

error_reporting(E_ERROR | E_WARNING | E_PARSE);

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

function debug($a){
    echo '<pre>';
    var_dump($a);
    echo '</pre>';
    exit;
}
function emailExist($dbx, string $targetEmail){
    //  return ($dbx->count("SELECT * FROM user WHERE email = ?",[$targetEmail])) > 0 ? true : false;
    // debug($dbx->count("SELECT * FROM user WHERE email = ?",[$targetEmail]));
    return $dbx->count("SELECT * FROM user WHERE email = ?",[$targetEmail]);
}

function passwordMatch(string $pwd_x, string $pwd_y){
    return $pwd_x == $pwd_y ? true : false;
}
function getAge($dbx ,$date){
    $a = $dbx->select("SELECT CURRENT_TIMESTAMP AS 'Time'");
    $b = array_pop($dbx->select("SELECT TIMEDIFF(? , ?)",[ $a[0]['Time'],$date])[0]);
    $units = explode(':',$b);
    // var_dump($units);
    // exit;
    // $time_diff = [
    //     'hours' => $units[0],
    //     'minutes' => $units[1],
    //     'seconds' => $units[2]
    // ];
    if(intval($units[0]) > 0){
        return intval($units[0]) . "h";
    }elseif(intval($units[1]) > 0){
        return intval($units[1]) . "m";
    }elseif(intval($units[2]) > 0){
        return intval($units[2]) . "s";
    }
}
function getProducts($dbx, $user_id = null){
    if($user_id != null){
        $prods = $dbx->select("SELECT * FROM products INNER JOIN category on products.category_id = category.id WHERE user_id = ?",[$user_id]);
    }else{
        $prods = $dbx->select("SELECT * FROM products INNER JOIN category on products.category_id = category.id");
    }
    if(empty($prods)){
        ?>
            <div class="card market__item--none">
                <h1>No Products... D:</h1>
            </div>
            <?php
    }else{
        foreach($prods as $prod){
            ?>
            <div class="card market__item">
                <img src="
                <?php  
                if($prod['image_url'] != ""){
                    echo($prod['image_url']);
                }else{
                    echo('https://via.placeholder.com/150C/O https://placeholder.com/'); 
                }
                ?>" class="card-img-top img-fit" style="padding: 2rem;"alt="...">
                <div class="card-body" style="border: 1px solid #ccc">
                    <h5 class="card-title"><?= $prod['name']?></h5>
                    <p class="card-text"><?= $prod['category_name']?></p>
                    <p class="card-text"><?= $prod['description']?></p>
                    <p class="card-text"><?= getAge($dbx,$prod['date_added']) ?></p>
                    <a href="<?= getURL('market', ['user' => $prod['user_id']]) ?>" class="btn btn-primary">View Items</a>
                </div>
            </div>
            <?php
        }
    }
}

// echo("FUNC");
// var_dump(emailExist("paul@paul.com"));