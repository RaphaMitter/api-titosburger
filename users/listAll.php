<?php

require_once("../controller/controllerUsers.php");
require_once("../model/modelUsers.php");

if($_SERVER["REQUEST_METHOD"] == "GET") {

    $controllerUsers = new controllerUsers();
    $list = $controllerUsers->listAll();

    if($list) {
        $msg = array("categories" => $list);
        echo json_encode($msg);
    } else {
        $msg = array("categories" => []);
        echo json_encode($msg);
    }

} else {
    header("HTTP/1.1 405 Method Not Allowed");
}