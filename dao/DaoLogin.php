<?php

require_once('../database/Database.php');

class DaoLogin {

    private $conn;

    public function __construct() {
        $database = new Database();
        $db = $database->dbConnection();
        $this->conn = $db;
    }

    public function runQuery($sql) {
        $stmt = $this->conn->prepare($sql);
        return $stmt;
    }

    public function Logar(ModelLogin $login) {
        try {

            $email = $login->getEmail();
            $senha = $login->getSenha();

            // $senhaCriptografada = hash('sha512', md5($senha));

            $logado = false;

            $stmt = $this->conn->prepare("SELECT DISTINCT u.idUsuario, u.senhaUsuario, u.emailUsuario, u.nivelUsuario FROM aluno a, professor p,gerente g, usuario u WHERE (a.idUsuario = u.idUsuario AND u.emailUsuario = :email) OR (p.idUsuario = u.idUsuario AND u.emailUsuario = :email) OR (g.idUsuario = u.idUsuario AND u.emailUsuario = :email)");
            $stmt->execute(array(':email' => $email));
            $userRow = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($stmt->rowCount() == 1) {
                if ($senha == $userRow['senhaUsuario']) {
                    session_start();
                    $_SESSION['user_session'] = $userRow['emailUsuario'];
                    $_SESSION['user_id'] = $userRow['idUsuario'];
                   
                    if($userRow['nivelUsuario'] == 1){
                        echo 1;
                    }
                    else if($userRow['nivelUsuario'] == 2){
                        echo 2;
                    }
                    else if($userRow['nivelUsuario'] == 3){
                        echo 3;
                    }
                } else {
                    echo 0;
                }
            } 
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function is_loggedin() {
        if (isset($_SESSION['user_session'])) {
            return true;
        }
    }

    public function redirecionar($url) {
        header("Location: $url");
    }

    public function Logout() {
        session_destroy();
        unset($_SESSION['user_session']);
        return true;
    }

}

?>