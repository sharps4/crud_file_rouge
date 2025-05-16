<?php
    class ErrorController extends Controller
    {
        public function error404()
        {
            Controller::renderPage([
                'title' => 'Erreur 404',
                'main'  => Controller::renderView('error', ['code' => 404])
            ]);
        }

        public function error405()
        {
            Controller::renderPage([
                'title' => 'Erreur 405',
                'main'  => Controller::renderView('error', ['code' => 405])
            ]);
        }
    }
?>