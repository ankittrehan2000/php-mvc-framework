<?php

// declare namespace
namespace app\core;

class Application
{
    // use strongly typed php 7.4+ properties
    public Router $router;
    public Request $request;
    public Response $response;
    public Controller $controller;
    public Database $database;
    public static string $ROOT_DIR;
    public static Application $app;
    public function __construct($rootPath, array $config) {
        self::$app = $this;
        $this -> request = new Request();
        $this -> response = new Response();
        $this -> router = new Router($this -> request, $this -> response);
        $this -> database = new Database($config['database']);
        self::$ROOT_DIR = $rootPath;
    }

    public function run() {
        echo $this -> router -> resolve();
    }

    public function getController() {
        return $this -> controller;
    }

    public function setController(Controller $controller) {
        $this -> controller = $controller;
    }
}
