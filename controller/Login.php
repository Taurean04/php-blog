<?php

    require_once(__DIR__. '/Controller.php');
    require_once('./Model/UserModel.php');

    class Login extends Controller{
        public $active = 'login';
        private $userModel;

        public function __construct()
        {
            if(isset($_SESSION['auth_status'])) header("Location: dashboard.php");
            $this->userModel = new UserModel();
        }

        public function login(array $data){
            $email = stripcslashes(strip_tags($data['email']));
            $password = stripcslashes(strip_tags($data['password']));

            $EmailRecords = $this->userModel->fetchEmail($email);
            if(!$EmailRecords['status']){
                if(password_verify($password, $EmailRecords['data']['password'])){
                    $Response = array('status' => true);

                    $_SESSION['data'] = $EmailRecords['data'];
                    $_SESSION['auth_status'] = true;
                    header("Location: dashboard.php");
                }
                $Response = array('status' => false);
                return $Response;
            }
            $Response = array('status' => false);
            return $Response;
        }
    }

?>