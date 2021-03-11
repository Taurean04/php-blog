<?php

    require_once(__DIR__. '/Controller.php');
    require_once('./Model/PostModel.php');

    class Post extends Controller{

        public $active = 'add_post';
        private $postModel;

        public function __construct()
        {
            if(!isset($_SESSION['auth_status'])) header("Location: index.php");
            $this->postModel = new PostModel();
        }

        public function newPost (array $data){
            $title = stripcslashes($data['title']);
            $description = stripcslashes($data['description']);
            $content = stripcslashes($data['content']);;

            $Error = array(
                'title' => '',
                'description' => '',
                'content' => '',
                'date_posted' => '',
                'status' => false
            );

            if(empty($title)){
                $Error['title'] = 'Title cannot be empty.';
                return $Error;
            }

            if(empty($content)){
                $Error['content'] = 'Post content cannot be empty.';
                return $Error;
            }

            $Payload = array(
                'title' => $title,
                'description' => $description,
                'content' => $content,
            );

            $Response = $this->postModel->createPost($Payload);

            if(!$Response['status']){
                $Response['status'] = 'Sorry, An unexpected error occured and your request could not be completed.';
                return $Response;
            }
            header("Location: dashboard.php");
            return true;
        }

        public function getPost($id):array{
            return $this->postModel->fetchPost($id);
        }        

        public function views($id){
            return $this->postModel->track_views($id);
        }
    }

?>