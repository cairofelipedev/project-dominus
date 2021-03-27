<?php
    class Login extends Conexao{

        private $login;
        private $pass;

        public function setLogin($login){
             $this->login = $login;
        }
        public function setpass($pass){
            $this->pass = $pass;
        }
        public function getLogin(){
            return $this->login;
        }
        public function getpass(){
            return $this->pass;
        }


        public function logar(){
            $pdo = parent::getDB();
            
            /*faço meu select com o banco de dados já criado*/
            $logar = $pdo->prepare ("SELECT * FROM users WHERE email = ? OR login = ? AND pass = ?");
            $logar->bindValue(1, $this->getLogin());
			$logar->bindValue(2, $this->getLogin());
            $logar->bindValue(3, $this->getpass());
            $logar->execute();
            if ($logar->rowCount()== 1):
                $dados = $logar->fetch(PDO::FETCH_OBJ);
                
                /*neste ponto informo a tabela que contem o dados do usurário*/
                $_SESSION['email'] = $dados->email;
                $_SESSION['name'] = $dados->name;
                $_SESSION['login'] = $dados->login;
				$_SESSION['type'] = $dados->type;
				$_SESSION['pass'] = $dados->pass;
				$_SESSION['id'] = $dados->id;
			
                
                /*Aqui informo se o mesmo se encontra logado*/
                $_SESSION['logado'] = true;


                return true;
            else:
                return false;
            endif;
        }
    }

?>