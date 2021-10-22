<?php

// declare namespace
namespace app\core;

class Application
{
    // use strongly typed php 7.4+ properties
    public Router $router;
    public Request $request;
    public Response $response;
    public static string $ROOT_DIR;
    public static Application $app;
    public function __construct($rootPath) {
        self::$app = $this;
        $this -> request = new Request();
        $this -> response = new Response();
        $this -> router = new Router($this -> request, $this -> response);
        self::$ROOT_DIR = $rootPath;
    }

    public function run() {
        echo $this -> router -> resolve();
    }
}
