<?php
    namespace Controllers;

    class HomeController extends Controller
    {
        public function home()
        {
            return $this->render("home");
        }

        public function about($args)
        {
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
