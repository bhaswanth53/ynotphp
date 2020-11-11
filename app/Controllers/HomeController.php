<?php
    namespace Controllers;

    class HomeController extends Controller
    {
        public function home()
        {
            return $this->render("home");
        }
    }
