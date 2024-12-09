<?php

class controllerOders {
    public function listOrderByclient($id_user){
    try {

        $modelOrders = new modelOrders();
        return $modelOrders->listOrderByclient($id_user);

    } catch(PDOException $e) {
        return false;
    }
  }
   public function createOrder($data) {
    try {
        $modelOrders = new modelOrders();
        return $modelOrders->createOrder($data);

    } catch (PDOException $e) {
        return false;
    }
  }

  public function updateOrder($id, $data) {
    try{
        $modelOrders = new modelOrders();
        return $modelOrders->updateOrder($id, $data);

    } catch (PDOExceotion $e) {
        return false;
    }
  }
  
  public function detailOrderByid($id) {
    try {
        $modelOrders = new modelOrder();
        return $modelOrders->detailOrderByid($id);

    } catch (PDException $e) {
        return false;
    }
  }

  public function listAllOrders() {
    try {
        $modelOrders = new modelOrders();
        return $modelOrders->listAllOrders();

    } catch (PDOEception $e) {
        return false;
    }
  }

  public function listOrdersByStatus($id_status) {
    try {
    $modelOrders->listOrdersByStatus($id_status);
    return $modelOrders->listOrdersByStatus($id_status);

  } catch (PDException $e) {
    return false;
   }

  }

  public function createCart($data) {
    try {

        $modelOrders  = new modelOrders();
        return $modelOrders->createCart($data);

    } catch (PDoEception $e) {
        return false;
    }
  }

  public function insertItenCart($data) {
    try {

        $modelOrders = new modelOrders();
        return $modelOrders->insertItenCart($data);

    } catch (PDOException $e) {
        return false;
    }
  }

  public function deleteCart($id_cart) {
    try {

        $modelOrders =  new modelOrders();
        return $modelOrders->deleteCart($id_cart);

    } catch (PDOExeception $e) {
        return false;
    }
  }

}

?>