<?php

    require_once(__DIR__. '/Db.php');

    class UserModel extends Db{

        public function fetchEmail(string $email) :array{
            $query = "Select * FROM `users` WHERE `email` = :email";
            $this->query($query);
            $this->bind('email', $email);
            $this->execute();

            $Email = $this->fetch();
            if(empty($Email)){
                $Response = array(
                    'status' => true,
                    'data' => $Email
                );
                return $Response;
            }
            if(!empty($Email)){
                $Response = array(
                    'status' =>false,
                    'data' => $Email
                );
                return $Response;
            }
        }

        public function createUser(array $user) :array{
            $query = "INSERT INTO `users` (name, email, phone_no, password) VALUES (:name, :email, :phone_no, :password)";
            $this->query($query);
            $this->bind('name', $user['name']);
            $this->bind('email', $user['email']);
            $this->bind('phone_no', $user['phone_no']);
            $this->bind('password', $user['password']);

            if($this->execute()){
                $Response = array('status' => true);
                return $Response;
            }else{
                $Response = array('status' => false);
                return $Response;
            }
        }

        public function fetchUser(string $email):array{
            $query = "SELECT * FROM `users` WHERE `email` = :email";
            $this->query($query);
            $this->bind('email', $email);
            $this->execute();

            $User = $this->fetch();
            if(!empty($User)){
                $Response = array(
                    'status' => true,
                    'data' => $User
                );
                return $Response;
            }
            return array(
                'status' => false,
                'data' => []
            );
        }

    }

?>