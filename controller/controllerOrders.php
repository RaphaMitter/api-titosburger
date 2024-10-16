<?php

class controllerOrders {

    public function listOrderByClient($id_user) {
        try {

            $modelOrders = new modelOrders();
            return $modelOrders->listOrderByClient($id_user);

            } catch (Exception $e) {
                return flase;
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
        try {

            $modelOrders = new modelOrders();
            return $modelOrders->updateOrder($id, $data);

        } catch (PDOException $e) {
        return false; 
        }
    }

    public function detailOrderById($id) {
        try {

            $modelOrders = new modelOrders();
            return $modelOrders->detailOrderById($id);

        } catch (PDOException $e) {
            return false;
        }
    }

    public function listAllOrders() {
        try {

            $modelOrders = new modelOrders();
            return $modelOrders->listAllOrders();

        } catch (PDOException $e) {
            return false;
        }
    }

    public function listOrdersByStatus($id_status) {
        try { 

            $modelOrders = new modelOrders();
            return $modelOrders->listOrdersByStatus($id_status);

        } catch (PDOException $e) {
            return false;
        }
    }

    public function createCart($data) {
        try {

            $modelCart = new modelCart();
            return $modelCart->createCart($data);

        } catch (PDOExcepion $e) {
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

            $modelOrders = new modelOrders();
            return $modelOrders->deleteCart($id_cart);

        } catch (PDOException $e) {
            return false;
        }
    }

}
?>