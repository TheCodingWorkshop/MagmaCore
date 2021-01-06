<?php
defined('ROOT_PATH') or define('ROOT_PATH', realpath(dirname(__FILE__)));
$autolaod = ROOT_PATH . '/vendor/autoload.php';
if (is_file($autolaod)) {
    require $autolaod;
}

/**
 * PHP 5.4 ships with a built in web server for development. This server
 * allows us to run silex without any configuration. However in order
 * to server static files we need to handle it nicely
 */
$filename = __DIR__ . preg_replace( '#(\?.*)$#', '', $_SERVER['REQUEST_URI'] );
if ( php_sapi_name() == 'cli-server' && is_file( $filename ) ) {
    return false;
}

use Magma\Application\Application;
use Magma\Router\Router;
$app = new Application(ROOT_PATH);
$app->run()
->setSession()
->setRouteHandler();
