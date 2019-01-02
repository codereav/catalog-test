<?php
/**
 * Created by PhpStorm.
 * User: codereav
 * Date: 27.12.2018
 * Time: 18:17
 */

namespace App\Components;


class Router
{
    private $routes = [];
    private $params = [];
    private $requestUri;

    public function addRoutes(array $routes): void
    {
        $this->routes = array_merge($this->routes, $routes);
    }

    private function splitUrl($url): array
    {
        return preg_split('/\//', $url, -1, PREG_SPLIT_NO_EMPTY);
    }

    public function dispatch($requestUri = null)
    {

        if ($requestUri === null) {
            $uriArray = explode('?', $_SERVER['REQUEST_URI']);
            $uri = reset($uriArray);
            $requestUri = urldecode(rtrim($uri, '/'));
        }
        $this->requestUri = $requestUri;

        //if isset same route url, set array of url parts into $params
        //TODO: do redirect if $this->params not set
        if (isset($this->routes[$requestUri])) {
            $this->params = $this->splitUrl($requestUri);
        }

        foreach ($this->routes as $route => $uri_path) {

            //If exists '::' string in route, replace keys by regexp
            if (strpos($route, '::') !== false) {
                $route = str_replace(['::any', '::num'], ['(.+)', '([0-9]+)'], $route);
            }

            //If the request url matches the regular expression, replace it by $uri_path and replace $uri_path
            if (preg_match('#^' . $route . '$#', $requestUri)) {
                if (strpos($uri_path, '$') !== false && strpos($route, '(') !== false) {
                    $uri_path = preg_replace('#^' . $route . '$#', $uri_path, $requestUri);
                }

                //set array of url parts
                $this->params = $this->splitUrl($uri_path);
                break;
            }
        }
        return $this->execute();
    }

    private function execute()
    {
        $controller = 'App\Controllers\\' . ($this->params[0] ?? 'IndexController');
        $action = $this->params[1] ?? 'indexAction';
        $params = array_slice($this->params, 2);
        return (new $controller())->$action(implode(', ', $params));
    }
}