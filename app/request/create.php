<?php

require_once("../includes/session.php");
require_once("../includes/database.php");
require_once("../includes/functions.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    var_dump($_POST);
//    exit();
//    $id = $_POST['id'];
    $action = $_POST['submit'];
    $name = $_POST['name'];
    $start_date = $_POST['start-date'];
    $end_date = $_POST['end-date'];
    $location = $_POST['location'];
    $type = $_POST['type'];
    $skill = $_POST['skill'];
//    echo "{$id} {$action} {$name} {$start_date} {$end_date} {$location} {$type}";
//    exit();
    if ($action !== "Delete") {
        if($type == "materials"){
            $conn->insert("INSERT INTO materials (name) VALUES (?) ",[$name]);
            $mat_id = $conn->select("SELECT id FROM materials WHERE name = ?",[$name])[0];
//            die($mat_id->id. " " .$skill);
            $conn->insert("INSERT INTO skill_materials (material_id, skill_id) VALUES (?,?) ",[$mat_id->id,$skill]);
        }else{
//            die("dead");
            $conn->insert("INSERT INTO {$type} (name, date, end_date, location) VALUES (?,?,?,?)",
                [$name, $start_date, $end_date, $location]);
        }
        redirect("index", [
            'success' => 'recordcreated'
        ]);
    }
    redirect("index");
} else {
    redirect("login", [
        'error' => 'noform'
    ]);
};