<?php

include_once("../services/connectionDB.php");

class modelOrders {

    public function listOrderByClient($id_user) {
        try{

        $conn = connection::connect();
        $list = $conn->query("SELECT * FROM tblOrders WHERE id_user = :id_user");
        $list->bindParam(":id_user", $id_user);
        $list->execute();
            } catch (PDOException $e) {
        return false;

          }
    }

    public function listAllOrders() {
        try {

            $conn = connectionDB::connect();

            $lisAll = $conn->query("SELECT * FROM tblOrders");
            $result = $listAll->fetchAll(PDO::FETCH_ASSOC);

            return $result;

        } catch (PDOException $e) {
            return false;
        }
    }
}
?>