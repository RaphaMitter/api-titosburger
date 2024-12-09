<?php 

class controllerUser {

    public function save($data) {
        try {

            $modelUsers = new modelUsers();
            return $modelUsers->save($data);

        } catch (PDOException $e) {
            return false;
        }

    }
     public function update($id_user, $data) {
        try {
            $modelUsers = new modelUsers();
            return $modelUsers->update($id_user, $data);

        } catch (PDOException $e) {
            return false;
        }
     }

     public function auth($data) {
        try {

            $modelUsers = new modelUsers();
            return $modelUsers->auth($data);

        } catch (PDOException $e) {
            return false;
        }

     }

     public function recoveryPassword($data) {

        try {
            $modelUsers = new modelUsers();
            return $modelUsers->recoveryPassword($data);

        } catch (PDOException $e) {
            return false;
        }
     }

     public function validationToken($data) {
        try { 

            $modelUsers = new modelUsers();
            return $modelUsers->validationToken($data);

        } catch (PDOException $e) {
            return false;
        }
     }

     public function validationEmail($data) {
        try {

            $modelUsers = new modelUsers();
            return  $modelUsers->validationEmail($data);

        }  catch (PDOException $e) {
            return false;
        }
     }

     public function listAll() {
        try {

            modelUser = new modelUser();
            return $modelUser->listAll();

        } catch (PDOException $e) {
            return false;
        }
     }

     public function searchById($id) {
        try {

            $modelUser = new modelUser();
            return  $modelUser->searchById($id);

        } catch (PDOException $e) {
            return false;
        }
     }

     public function delete($id) {
        try {

            $modelUser = new modelUser();
            return $modelUser->delete($id);

        } catch (PDOException $e) {
            return false;
        }
     }
}


?>