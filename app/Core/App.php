<?php

class App
{
    private $controller = 'HomeController';
    private $method = 'index';
    private $params = [];
    
    
    public function __construct()
    {
        $url = $this->parseURL(); // Parsing URL

        // Setting up controller
        if (isset($url[0])) {
            if (file_exists('app/Controllers/' . ucfirst($url[0]) . 'Controller.php')) {
                $this->controller = ucfirst($url[0]) . 'Controller';
                unset($url[0]);
            }
        }

        // Creating controller object
        require_once 'app/Controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;

        // Setting up method
        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        // Setting up parameters if needed
        $this->params = $url ? array_values($url) : [];

        // Calling controller's method
        call_user_func_array([$this->controller, $this->method], $this->params);
    }
    
    private function parseURL()
    {
        if (isset($_GET['url']))
            return explode('/', htmlspecialchars(rtrim($_GET['url'], '/')));
    }
}