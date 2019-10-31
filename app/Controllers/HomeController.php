<?php
    namespace Controllers;

    class HomeController extends Controller
    {
        public function home()
        {
            // return __DIR__ . "/views/home.php";
            // return "../views/home.php";
            // return $_SERVER['HTTP_HOST'] . "/projects/test/router/views/home.php";
            // return "views/home.php";
            return $this->render("home");
            // return $this->redirect("about/10/5/route/1540");
            // echo env("APP_URL");
        }

        public function about($args)
        {
            // return "views/about.php";
            $name = "Bhaswanth";
            $study = "10";
            $data = array('args' => $args, "name" => $name, "study" => $study);
            return $this->render("about", $args);
        }

        public function test()
        {
            echo "This is test";
        }
    }
