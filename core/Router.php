<?php

namespace app\core;

class Router {
    // sample array
    // array = ['get' => ['/' => callback], 'post' => ['/' => callback]]
    protected array $routes = [];
    public function get($path, $callback) {
        // for a given path, this is the call back
        $this -> routes['get'][$path] = $callback;
    }

    public function resolve() {
        echo '<pre>';
        var_dump($_SERVER);
        echo '<pre>';
        exit;
    }
}

?>