<?php

require_once("../controller/controllerProducts.php");
require_once("../model/modelProducts.php");

if($_SERVER["REQUEST_METHOD"] =="DELETE") {
    
    $_id = $_GET["id"];

    $controllerProducts = new controllerProducts();
    $delete = $controllerProducts->delete($id);

    if($delete) {
        $msg = array("msg" => "Product has been deleted successfully.");
        echo json_encode($msg);
    } else {
        $msg = array("msg" => "Error, Product does not deleted.");
        echo json_encode($msg);
    } 
}else {

headre("HTTP/1.1 405 Method Not Allowed");    
}

?>