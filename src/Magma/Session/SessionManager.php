<?php

declare(strict_types=1);

namespace Magma\Session;

use Magma\Session\SessionFactory;
use Magma\Yaml\YamlConfig;

class SessionManager
{

    /**
     * Create an instance of our session factory and pass in the default session storage
     * we will fetch the session name and array of options from the core yaml configuration
     * files
     *
     * @return void
     */
    public static function initialize() : Object
    {
        $factory = new SessionFactory();
        return $factory->create('magmacore', \Magma\Session\Storage\NativeSessionStorage::class, YamlConfig::file('session'));
    }

}