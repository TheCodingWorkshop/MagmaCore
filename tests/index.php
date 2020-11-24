<?php


$appRoot = realpath(dirname(__FILE__));
$application = $appRoot . '/src/Magma/Application.php';
if (is_file($application)) {
    require $application;
}

(new Application($appRoot))->run();

use Magma\Yaml\YamlConfig;

var_dump(YamlConfig::file('session'));