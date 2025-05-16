<?php
    class LoginController extends Controller
    {
        public function index()
        {
            if (logged())
            {
                Controller::redirect('home');
            }
            else
            {
                Controller::renderPage([
                    'title' => 'Connexion',
                    'main'  => Controller::renderView('login', [
                        'error' => isset($_GET['error'])
                    ])
                ]);
            }
        }

        public function login()
        {
            if (Controller::postEqu(['password' => ADMIN_PASS]))
            {
                session_start();
                $_SESSION['logged'] = true;
                Controller::redirect('home');
            }
            else
            {
                Controller::redirect('loginPage', [], ['error' => true]);
            }
        }

        public function logout()
        {
            session_destroy();
            Controller::redirect('loginPage');
        }
    }
?>