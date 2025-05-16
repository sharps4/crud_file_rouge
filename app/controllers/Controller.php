<?php
    abstract class Controller
    {
        static public function renderPage(
            array $params = []
        ) : void
        {
            if (!isset($params['styles'])) $params['styles'] = [];
            if (!isset($params['scripts'])) $params['scripts'] = [];
            echo Controller::renderView('default', $params);
            die();
        }

        static public function renderView(
            string $name,
            array  $params = []
        ) : string
        {
            ob_start();
            require('../app/views/'.$name.'.php');
            return ob_get_clean();
        }

        static public function renderJSON(
            array $json
        ) : void
        {
            header('Content-Type: application/json');
            echo json_encode($json);
            die();
        }

        static public function redirect(
            string $route,
            array  $params = [],
            array  $get    = []
        ) : void
        {
            header('Location: '.Router::getRouteURL($route, $params, $get));
            die();
        }

        static public function postExists(
            array $keys
        ) : bool
        {
            foreach ($keys as $key)
            {
                if (!isset($_POST[$key]))
                {
                    return false;
                }
            }
            return true;
        }

        static public function postEqu(
            array $values
        ) : bool
        {
            foreach ($values as $key => $value)
            {
                if (!isset($_POST[$key]) || $_POST[$key] !== $value)
                {
                    return false;
                }
            }
            return true;
        }
    }
?>