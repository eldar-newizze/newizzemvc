<?php

namespace Core;

use Dotenv\Dotenv;

class App
{
    protected $controllerName = 'main';
    protected $method = "index";
    protected $params = [];

    public function __construct()
    {
        $this->setUpConfigs();
        $this->parseUrl();
        $controllerName = 'Controllers\\' . ucfirst($this->params[0]) . 'Controller';

        if (class_exists($controllerName)) {
            $controller = new $controllerName();
            $method = $this->params[1] ?? $this->method;
            if (method_exists($controller, $method)) {
                call_user_func_array([$controller, $method], $this->params);
            } elseif (method_exists($controller, $this->method)) {
                call_user_func_array([$controller, $this->method], $this->params);
            } else {
                $this->error404();
            }
        } else {
            $this->error404();
        }
    }
    public function error404()
    {
        $controllerName = 'Controllers\\' . ucfirst($this->controllerName) . 'Controller';
        $controller = new $controllerName();
        call_user_func_array([$controller, 'error'], []);
    }

    public function parseUrl()
    {
        if (isset($_GET['url'])) {
            $this->params = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
            return;
        }
        $this->params[0] = $this->controllerName;
    }

    private function setUpConfigs()
    {
        $dotenv = Dotenv::createImmutable(__DIR__, '../.env');
        $dotenv->load();
    }
}
