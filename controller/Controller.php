<?php
    require_once('./Model/Db.php');
    session_start();
    class Controller{
        private $Db;

        public function track_visit(){            
            $this->Db = new Db();	
            if(!isset($_COOKIE['visit'])){
                setcookie('visit', 'yes', time()+(60*60*20*30));
                $this->Db->query("UPDATE visit SET total_count = total_count+1");
                $this->Db->execute();
                return true;
            }
	    }
    }

?>