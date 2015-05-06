<?php
namespace Utils;

class Router
{
    private static function callAction($controllerName, $actionName, array $arguments = [])
    {
        $controllerName = "Controllers\\{$controllerName}";
        $controller = new $controllerName;

        call_user_func_array([$controller, $actionName], $arguments);
    }

    public static function dispatch()
    {
        $request = filter_input(INPUT_GET, 'r');
        $route = array_values(array_filter(explode('/', $request)));

        $controllerName = 'MainController';
        $actionName = 'defaultAction';
        $arguments = [];

        if (!empty($route)) {
            $controllerName = $route[0] .'Controller';
        
            if (!empty($route[1])) {
                $actionName = $route[1];
            }

            $arguments = array_slice($route, 2);    
        }

        return self::callAction($controllerName, $actionName, $arguments);
    }
}
