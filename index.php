<?php
defined('ROOT_PATH') or define('ROOT_PATH', realpath(dirname(__FILE__)));
$autolaod = ROOT_PATH . '/vendor/autoload.php';
if (is_file($autolaod)) {
    require $autolaod;
}
use Magma\Application\Application;
$app = new Application(ROOT_PATH);
$app->run()
->setSession()
->setRouteHandler();
