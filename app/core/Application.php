<?php

class Application
{
    protected $controller = 'homeController';
    protected $method = 'index';
    protected $parameters = [];

    public function __construct() {
        $this->parseUrl();

        if(file_exists(CONTROLLER . $this->controller . '.php')) {
            $this->controller = new $this->controller;
            $this->controller->index();
        }
    }

    protected function parseUrl() {
        $request = trim($_SERVER['REQUEST_URI'], '/');

        if(!empty($request)) {
            $url = explode('/', $request);
            $this->controller = isset($url[0]) ? $url[0] . 'Controller' : 'homeController';
            $this->method = isset($url[1]) ? $url[1] : 'index';
            unset($url[0], $url[1]);
            $this->parameters = !empty($url) ? array_values($url) : [];
        }
    }
}