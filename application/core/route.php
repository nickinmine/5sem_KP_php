<?php
class Route {
    private static string $TEMPDIR;

    function __construct() {
        self::$TEMPDIR = 'D:\ApacheServers\univerMVC\htdocs\logs';
    }

    static function start() {
        $controller_name = 'Index';
        $action_name = 'index';
        $get = explode('?', $_SERVER['REQUEST_URI']);
        $routes = explode('/', $get[0]);

        if (!empty($routes[1])) {
            $controller_name = $routes[1];
        }

        if (!empty($routes[2])) {
            $action_name = $routes[2];
        }

        $model_name = 'Model_'.$controller_name;
        $controller_name = 'Controller_'.$controller_name;
        $action_name = 'action_'.$action_name;
        $model_file = strtolower($model_name).'.php';
        $model_path = "application/models/".$model_file;
        if(file_exists($model_path)) {
            include "application/models/".$model_file;
        }

        $controller_file = strtolower($controller_name).'.php';
        $controller_path = "application/controllers/".$controller_file;
        if(file_exists($controller_path)) {
            include "application/controllers/".$controller_file;
        } else {
            Route::ErrorPage404();
            return;
        }

        $controller = new $controller_name;
        $action = $action_name;
        if(method_exists($controller, $action)) {
            $controller->$action();
        } else {
            Route::ErrorPage404();
        }
    }

    static function ErrorPage404() {
        http_response_code(404);
        include 'application/controllers/controller_error.php';
        $controller = new Controller_Error();
        $controller->action_index();
    }

    static function addlog($str) {
        (new Route())->__construct();
        date_default_timezone_set("Europe/Moscow");
        $logfile = self::$TEMPDIR .'\univerMVC.log';
        $fd = fopen($logfile, 'a+');
        if ($fd) {
            fwrite($fd, date("Y-m-d H:i:s") . " " . $str . "\r\n");
            fclose($fd);
        }
    }
}