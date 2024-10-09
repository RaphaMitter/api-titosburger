<?php

include_once("../services/connectionDB");

protected $salt = "TIt0s@2024"; 

class modelUsers 
{
    public function save($data) {
        try {
        
            $firstname = htmlspecialchars($data["firstname"], ENT_NOQUOTES);
            $lastname = htmlspecialchars($data["lastname"], ENT_NOQUOTES);
            //USUARIO E E-MAIL = USERNAME
            $username = htmlspecialchars($data["username"], ENT_NOQUOTES);
            $password = htmlspecialchars($data["password"], ENT_NOQUOTES);
            $birthday = htmlspecialchars($data["birthday"], ENT_NOQUOTES);
            $cpf = filter_var($data["cpf"], FILTER_SANITIZE_NUMBER_INT);

            //Permissao
            $permission = htmlspecialchars($data["permission"], ENT_NOQUOTES);

            //iRÁ CHAMAR A FUNÇÃO DE CRIPTOGRAFIA DE SENHA
            $password_secure = $this->tokenize($password);

            $conn = conncectionDB::connect();
            $conn->prepare("INSERT INTO" tblUsers VALUES (':firstname',
                                                     ':lastname',
                                                     ':username',
                                                     ':password_secure',
                                                     ':birthday',
                                                     ':cpf',
                                                     ':mail',
                                                     1, NOW()));
            $save->bindParam(':firstname', $firstname);
            $save->bindParam(':lastname', $lastname);
            $save->bindParam(':username', $username);
            $save->bindParam(':password_secure', $password_secure);
            $save->bindParam(':birthday', $birthday);
            $save->bindParam(':cpf', $cpf);
            $save->bindParam(':mail', $username);
            $save->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    protected function tokenize($value){
        try{

             $combinedPassword = $value . $this->salt;

            return password_hash($combinedPassword, PASSWORD_BCRYPT);

        } catch (\Throwable $th) {
            return false;
        }

    }

    private function searchUserByEmail($username) {
        try {
            $conn = conncectionDB::connect();
            $search = $conn->prepare("SELECT id_user FROM tblUsers WHERE username = ':username' ");
            $search->bindParam(':username', $username);
            $search->execute();
            $result = $search->fetch(PDO::FETCH_ASSOC);

            return $result;
            
        } catch (PDOException $e) {
            return false;
        }
    }

    public function saveGroup($id_user, $group) {
        try {
            $conn = conncectionDB::connect();
            $saveGroup = $conn->prepare("INSERT INTO tblusersroles (id_user, group) VALUES(':id_user', ':group')");
            $saveGroup->bindParam(':id_user', $id_user);
            $saveGroup->bindParam(':group', $group);
            $saveGroup->execute();

            return true;

        } catch (PDOException $e) {
        return false;
         }
  }

    public function auth($data) {
      try {

        $username = htmlspecialchars($data["username"], ENT_NOQUOTES);
        $conn = connectionDB::connect();
        $auth = $conn_>prepare("SELECT * FROM tblUsers WHERE username = ':username'");
        $auth->bindParam(':username', $data['username']);
        $auth->execute();
        $result = $auth->fetch(PDO::FETCH_ASSOC);

        if($result) {
            $passwordDB = $result->pass_user;

            $validatePassword = password_verify($data->password . $this->salt, $passwordDB);

            if($validatePassword) {
                return $result;
            } else {
                return false;
            }
        }

         } catch (PDOException $e) {
        return false;
         }
  }

   public function generatetwoFactor($data) {
      try {

        //Dados recebidos da requisição 
        $username = htmlspecialchars($data["username"], ENT_NOQUOTES);

        //Expiração do token em 15 minutos
        $expired_at = date('d/m/Y H:i:s', time() + (15 * 60));

        //Gerar token com adata e hora atual com nome do usuario
        $token = md5(date('d/m/Y H:i:s') . $data->username);
        $finalToken = substr($token, 6);

        //Gravar os dados do token
        $conn = connectionDB::connect();
        $saveToken = $conn->prepare("INSERT INTO tbltokens VALUES (':token', ':username', ':expired')");
        $saveToken->bindParam(':token', $finalToken);
        $saveToken->bindParam(':username', $username);
        $saveToken->bindParam(':expired', $expired_at);
        $saveToken->execute();

        if($saveToken) {
            //Texto do corpo do e-mail
            $message = "Utilize o token: $finalToken";

            $sendMail = mail($username, 'Token', $message);

            if($sendMail) {
                return true;
            }else {
                return false;
            }

        }
        

    } catch (PDOExceptio $e) {
    return false;
    }
}

    public function validateTwoFactor($data) {
        try {

            $token = htmlspecialchars($data["token"], ENT_NOQUOTES);
            $username = htmlspecialchars($data["username"], ENT_NOQUOTES);

            $conn = connectionDB::connect();
            $validate = conn->prepare("SELECT * FROM tblTokens WHERE username = ':username' AND token = ':token'");
            $validate->bindParam(':username', $username);
            $validate->bindParam(':token', $token);
            $validate->execute();
            $result = $validate->fetch(PDO::FETCH_ASSOC);
            
            //Obter data e hora atual
            $now = date('d/m/Y H:i:s');
            //Converter data atual para validar a expiração
            $date = strtotime($now); //121354545 converte em numeral
            //Converter data expiração para validar
            $expired_at = strtotime($result['expired_at']);

           
            //Deletar o token após o uso
            $deleteToken = conn->prepare("DELETE FROM tblTokens WHERE username = ':username' AND token = ':token'");
            $deleteToken->bindParam(':username', $username);
            $deleteToken->bindParam(':token', $token);
            $deleteToken->execute();

             //Validar se a data e hora atual é superior a data expiração
             if($date > $expire_at) {
                return false;
            } else {
                return true;
            }

        } catch (PDOException $e) {
            return false;
        }
    }

    public function listAll() {
        try {
            $conn = connectionDB::connect();
            $list = $conn->query("SELECT * FROM tblsUsers");
            $result = $list->fetchAll(PDO::FETCH_ASSOC);

            return $result;

        } catch (PDOException $e) {
            return false;
        }
    }

    public function searchByyId($id) {
        try {

            $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

            $conn = connectionDB::connect();
            $search = $conn->prepare("SELECT * FROM  tblUsers WHERE id_user = ':id_user'");
            $search->bindParam(':id_user', $id);
            $search->execute();
            $result = $search->fetch(PDO::FETCH_ASSOC);
            
            return $result;

        }catch (PDOException $e) {
            return false;
        }

    }

    public function delete($id) {
        try {
            $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

            $conn = connectionDB::connect();
            $delete = $conn->prepare("DELETE FROM  tblUsers WHERE id_user = ':id_user'");
            $delete->bindParam(":id_user", $id);
            $delete->execute();

            return true;

        } catch (PDOException $e) {
            return false;
        }
    }

    public function update($id, $data) {
        try {

            $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
            $firstname = htmlspecialchars($data["firstname"], ENT_NOQUOTES);
            $lastname = htmlspecialchars($data["lastname"], ENT_NOQUOTES);
            $mail = htmlspecialchars($data["mail"], ENT_NOQUOTES);
            $password = htmlspecialchars($data["password"], ENT_NOQUOTES);
            $status = filter_var($data["status"], FILTER_SANITIZE_NUMBER_INT);

        } catch (PDOException $e) {
            return false;
        }
    }
}
?>