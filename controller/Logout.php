<?php

    require_once(__DIR__. '/Controller.php');

    class Logout extends Controller {
        public function __construct()
        {
            session_destroy();
            header("Location: index.php");
        }
    }

?>