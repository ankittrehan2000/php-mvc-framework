<?php

namespace app\core;

class Router {
    // sample array
    // array = ['get' => ['/' => callback], 'post' => ['/' => callback]]
    protected array $routes = [];
    private Request $request;
    public Response $response;
    public function get($path, $callback) {
        // for a given path, this is the call back
        $this -> routes['get'][$path] = $callback;
    }

    public function __construct(Request $request, Response $response) {
        $this -> request = $request;
        $this -> response = $response;
    }

    public function resolve() {
        // to get the path
        $path = $this -> request -> getPath();
        $method = $this -> request -> getMethod();
        $callback = $this -> routes[$method][$path] ?? false;
        if ($callback == false) {
            $this -> response -> setStatusCode(404);
            return "404: Not found";
        }
        // call the passed in callback
        if (is_string($callback)) {
            return $this -> renderView($callback);
        }
        return call_user_func($callback);
    }

    public function renderView($view) {
        $layoutContent = $this -> layoutContent();
        $viewContent = $this -> renderOnlyView($view);
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    protected function layoutContent() {
        // start a buffer
        ob_start();
        include_once Application::$ROOT_DIR."/views/layouts/main.php";
        // return value from buffer
        return ob_get_clean();
    }

    protected function renderOnlyView($view) {
        // start a buffer
        ob_start();
        include_once Application::$ROOT_DIR."/views/$view.php";
        // return value from buffer
        return ob_get_clean();
    }
}

?>