<?php

declare(strict_types=1);

namespace Magma\Router;

interface RouterInterface
{

    /**
     * Simple add a route to the routing table
     * 
     * @param string $route
     * @param array $params
     * @return void
     */
    public function add(string $route, array $params = []) : void;

    /**
     * Dispatch route and create controller objects and execute the default method 
     * on that controller object
     * 
     * @param string $url
     * @return void
     */
    public function dispatch(string $url) : void;

}