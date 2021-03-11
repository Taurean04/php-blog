<?php

    require_once(__DIR__. '/Db.php');

    class PostModel extends Db{
        public function fetchPosts() :array {

            $query = "SELECT * FROM `posts` ORDER BY `id` DESC";
            $this->query($query);
            $this->execute();
            $Posts = $this->fetchAll();

            if(count($Posts) > 0){
                $Response = array(
                    'status' => true,
                    'data' => $Posts
                );
                return $Response;
            }
            $Response = array(
                'status' => false,
                'data' => []
            );
            return $Response;
        }

        public function fetchPost($id) :array {

            $query = "SELECT * FROM `posts` WHERE `id` = :id";
            $this->query($query);
            $this->bind('id', $id);
            $this->execute();

            $Post = $this->fetch();
            if(!empty($Post)){
                $Response = array(
                    'status' => true,
                    'data' => $Post
                );
                return $Response;
            }
            if(empty($Post)){
                $Response = array(
                    'status' =>false,
                    'data' => $Post
                );
                return $Response;
            }
        }

        public function createPost(array $post) :array{
            $query = "INSERT INTO `posts` (title, description, content, date_posted) VALUES (:title, :description, :content, :date_posted)";
            $this->query($query);
            $this->bind('title', $post['title']);
            $this->bind('description', $post['description']);
            $this->bind('content', $post['content']);
            $this->bind('date_posted', date('Y-m-d H:i:s'));

            if($this->execute()){
                $Response = array('status' => true);
                return $Response;
            }else{
                $Response = array('status' => false);
                return $Response;
            }
        }

        public function track_views($id){		
            $this->query("UPDATE posts SET views = views+1 WHERE id = :id ");
            $this->bind('id', $id);
            $this->execute();
	    }

    }

?>