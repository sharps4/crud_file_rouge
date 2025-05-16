<?php
    class InitController extends Controller
    {
        public function index()
        {
            Database::execute(file_get_contents('../app/db/init.sql'));
            Controller::redirect('home');
        }
    }
?>