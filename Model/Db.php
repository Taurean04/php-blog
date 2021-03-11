<?php

    class Db {
        protected $dbName = 'blog'; /** Database Name */
        protected $dbHost = 'localhost'; /** Database Host */
        protected $dbUser = 'root'; /** Database User */
        protected $dbPass = ''; /** Database Password */
        protected $dbHandler, $dbStmt;

        public function __construct()
        {
            $dsn = 'mysql:host='. $this->dbHost . ';dbname=' . $this->dbName;

            $options = array(
                PDO::ATTR_PERSISTENT => true,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            );

            try{
                $this->dbHandler = new PDO($dsn, $this->dbUser, $this->dbPass, $options);
            }catch(Exception $e){
                var_dump("Couldn't Establish A Database Connection. Error: ". $e->getMessage());
            }
        }

        public function query($query){
            $this->dbStmt = $this->dbHandler->prepare($query);
        }

        public function bind($param, $value, $type = null){
            if(is_null($type)){
                switch(true){
                    case is_int($value): $type = PDO::PARAM_INT;
                    break;
                    case is_bool($value): $type = PDO::PARAM_BOOL;
                    break;
                    case is_null($value): $type = PDO::PARAM_NULL;
                    break;
                    default: $type = PDO::PARAM_STR;
                    break;
                }
            }

            $this->dbStmt->bindValue($param, $value, $type);
        }

        public function execute(){
            $this->dbStmt->execute();
            return true;
        }

        public function fetch(){
            $this->execute();
            return $this->dbStmt->fetch(PDO::FETCH_ASSOC);
        }

        public function fetchAll(){
            $this->execute();
            return $this->dbStmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function fetchColumn(){
            $this->execute();
            return $this->dbStmt->fetchColumn();
        }
    }

?>