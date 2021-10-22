<?php

// declare namespace
namespace app\core;

class Application
{
    // use strongly typed php 7.4 properties
    public Router $router;
    public function __construct() {
        $this -> router = new Router();
    }

    public function run() {
        $this -> router -> resolve();
    }
}
