<?php 
    class Router
    {
        static private array $routes = [];


        static public function addRoutes(
            array $routes
        ) : void
        {
            foreach ($routes as $route)
            {
                self::addRoute(
                    $route['name'],
                    $route['method'],
                    $route['uri'],
                    $route['controller'],
                    $route['action'],
                    $route['needLogin'],
                );
            }
        }

        static public function addRoute(
            string $name,
            string $method,
            string $uri,
            string $controller,
            string $action,
            bool   $needLogin
        ) : void
        {
            self::$routes[$name] = [
                'method'      => $method,
                'uri'         => self::filterURI($uri),
                'controller'  => $controller,
                'action'      => $action,
                'needLogin'   => $needLogin,
            ];
        }

        static public function getRouteURI(
            string $name,
            array  $params = [],
            array  $get    = []
        ) : string
        {
            $uri = '';
            foreach (self::$routes[$name]['uri'] as $arg)
            {
                if ($arg[0] === '$')
                {
                    $param = substr($arg, 1);
                    $uri .= '/'.$params[$param];
                }
                else
                {
                    $uri .= '/'.$arg;
                }
            }
            if (count($get) > 0)
            {
                $uri .= '?';
                $args = [];
                foreach ($get as $var => $value)
                {
                    $args[] = "$var=$value";
                }
                $uri .= implode('&', $args);
            }
            return $uri;
        }

        static public function getRouteURL(
            string $name,
            array  $params = [],
            array  $get    = []
        ) : string
        {
            return $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME'].self::getRouteURI($name, $params, $get);
        }

        static public function run() : void
        {
            $uri = self::filterURI($_SERVER['PATH_INFO'] ?? '/');
            $length = count($uri);
            foreach (self::$routes as $name => $route)
            {
                if ($length === count($route['uri']))
                {
                    $params = [];
                    $valid = true;
                    for ($i = 0; $i < $length; $i++)
                    {
                        if ($route['uri'][$i][0] === '$')
                        {
                            $params[substr($route['uri'][$i], 1)] = $uri[$i];
                        }
                        else if ($uri[$i] !== $route['uri'][$i])
                        {
                            $valid = false;
                            break;
                        }
                    }
                    if ($valid)
                    {
                        if ($_SERVER['REQUEST_METHOD'] !== $route['method'])
                        {
                            self::runError(405);
                        }
                        else if ($route['needLogin'] && !logged())
                        {
                            Controller::redirect('loginPage');
                        }
                        else
                        {
                            require_once('../app/controllers/'.$route['controller'].'Controller.php');
                            (new ($route['controller'].'Controller')())->{$route['action']}($params);
                        }
                    }
                }
            }
            self::runError(404);
        }

        static private function runError(
            int $code
        ) : void
        {
            require_once('../app/controllers/ErrorController.php');
            (new ErrorController())->{"error$code"}();
        }

        static private function filterURI(
            string $uri
        ) : array
        {
            $length = strlen($uri);
            $hasBeginSlash = $length > 0 && $uri[0] === '/';
            $hasEndSlash = $length > 1 && $uri[$length-1] === '/';
            $uri = substr($uri, $hasBeginSlash, $length-$hasBeginSlash-$hasEndSlash);
            return $uri === '' ? [] : explode('/', $uri);
        }
    }
?>