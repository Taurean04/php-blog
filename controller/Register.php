<?php

    require_once(__DIR__. '/Controller.php');
    require_once('./Model/UserModel.php');

    class Register extends Controller {

        public $active = 'Register';
        private $userModel;

        public function __construct()
        {
            if(isset($_SESSION['auth_status'])) header("Location: dashboard.php");
            $this->userModel = new UserModel();
        }

        public function register (array $data){
            $name = stripcslashes(strip_tags($data['name']));
            $email = stripcslashes(strip_tags($data['email']));
            $phone = stripcslashes(strip_tags($data['phone_no']));
            $password = stripcslashes(strip_tags($data['password']));

            $EmailStatus = $this->userModel->fetchUser($email)['status'];

            $Error = array(
                'name' => '',
                'email' => '',
                'phone_no' => '',
                'password' => '',
                'status' => false
            );

            if(preg_match('/[^A-Za-z\s]/', $name)){
                $Error['name'] = 'Only Alphabets are allowed.';
                return $Error;
            }

            if(!empty($EmailStatus)){
                $Error['email'] = 'Sorry. This Email Address has been taken.';
                return $Error;
            }

            if(strlen($password) < 7){
                $Error['password'] = 'Please, use a stronger password.';
                return $Error;
            }

            $Payload = array(
                'name' => $name,
                'email' => $email,
                'phone_no' => $phone,
                'password' => password_hash($password, PASSWORD_BCRYPT)
            );

            $Response = $this->userModel->createUser($Payload);
            $Data = $this->userModel->fetchUser($email)['data'];
            unset($Data['password']);

            if(!$Response['status']){
                $Response['status'] = 'Sorry, An unexpected error occured and your request could not be completed.';
                return $Response;
            }

            $_SESSION['data'] = $Data;
            $_SESSION['auth_status'] = true;
            header("Location: dashboard.php");
            return true;
        }
    }

?>