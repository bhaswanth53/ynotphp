<?php
    namespace Controllers;

    class HomeController extends Controller
    {
        public function home()
        {
            // make_flash_array('data', array("email" => "No email data", "mobile" => "No mobile data"));
            return $this->render("home");
        }

        public function about($id, $kd, $nt)
        {
            $name = "Bhaswanth";
            $study = "10";
            $data = array('args' => $args, "name" => $name, "study" => $study);
            return $this->render("about", compact('id', 'kd', 'nt'));
        }

        public function test()
        {
            echo "This is test";
        }
    }
