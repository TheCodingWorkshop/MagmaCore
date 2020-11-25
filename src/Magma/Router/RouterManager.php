<?php

declare(strict_types=1);

namespace Magma\Router;

use Magma\Router\Router;
use Magma\Yaml\YamlConfig;

class RouterManager extends Router
{

    public static function dispatchRoute(string $url)
    {
        $router = new Router();
        $routes = YamlConfig::file('routes');
        if (is_array($routes) && !empty($routes)) {
            $args = [];
            foreach ($routes as $key => $route) {
                if (isset($route['namespace']) && $route['namespace'] !='') {
                    $args = ['namespace' => $route['namespace']];
                } elseif( isset($route['controller']) && $route['controller'] !='') {
                    $args = [
                        'controller' => $route['controller'],
                        'action' => $route['action']
                    ];
                }
                if (isset($key)) {
                    $router->add($key, $args);
                }    
            }
            $router->dispatch($url);
        }
    }

}