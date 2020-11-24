<?php

define('ROOT_DIR', realpath(dirname(__FILE__)));
$autolaod = ROOT_DIR . '/vendor/autoload.php';
if (is_file($autolaod)) {
    require $autolaod;
}

use Magma\Application\Application;
$app = new Application(ROOT_DIR);
var_dump($app);