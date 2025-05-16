<?php
    class HomeController extends Controller
    {
        public function index()
        {
            Controller::renderPage([
                'main'  => Controller::renderView('home')
            ]);
        }
    }
?>