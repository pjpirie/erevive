<?php
require_once("../includes/session.php");
require_once("../includes/database.php");
require_once("../includes/functions.php");
if($_SERVER["REQUEST_METHOD"] == "POST"){
//    var_dump($_POST);
//    exit();
    $id = $_POST['id'];
    $action = $_POST['submit'];
    $name = $_POST['name'];
    $start_date = $_POST['start-date'];
    $end_date = $_POST['end-date'];
    $location = $_POST['location'];
    $type = $_POST['type'];
//    echo "{$id} {$action} {$name} {$start_date} {$end_date} {$location} {$type}";
//    echo
//        "UPDATE
//            {$type} SET"
//        .
//        (empty($name) ? "" : " name = ?,") .
//        (empty($start_date) ? "" : " date = ?,") .
//        (empty($end_date) ? "" : " end_date = ?,") .
//        (empty($location) ? "" : " location = ?") .
//        (empty($name) ? "" : " '{$name}'") .
//        (empty($start_date) ? "" : " ,'{$start_date}'").
//        (empty($end_date) ? "" : " ,'{$end_date}'").
//        (empty($location) ? "" : " ,'{$location}'")
//    ;
//    exit();
    if($action !== "Delete"){
        if($type == "materials"){
            $conn->insert("UPDATE materials SET name = ? WHERE id = ? ",[$name, $id]);
        }else{
            $conn->insert("UPDATE {$type} SET name = ?, date = ?, end_date = ?, location = ? WHERE id = ? ",
                [$name, $start_date, $end_date, $location, $id]);
        }
        redirect("index", [
            'success' => 'recordupdated'
        ]);
    }else{
        if($type == "materials"){
            $conn->insert("DELETE FROM materials WHERE id = ? ", [
                $id
            ]);
        }else{
            $conn->insert("DELETE FROM ? WHERE id = ? ", [
                $type ,$id
            ]);
        }
        redirect("index", [
            'success' => 'recorddeleted'
        ]);
    }

    redirect("index");
}else{
    redirect("login", [
        'error' => 'noform'
    ]);
}
;