<?php

    require_once(__DIR__. '/Controller.php');
    require_once('./Model/PostModel.php');

    class Dashboard extends Controller{

        public $active = 'dashboard';
        private $postModel;

        public function __construct()
        {
            if(!isset($_SESSION['auth_status'])) header("Location: index.php");
            $this->postModel = new PostModel();
        }

        public function getPosts():array{
            return $this->postModel->fetchPosts();
        }
    }

?>