<?php

declare(strict_types=1);

namespace Magma\GlobalManager;

interface GlobalManagerInterface
{

    /**
     * Set the global variable
     * 
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public function set(string $key, $value) : void;

    /**
     * Get the value of the set global variable
     * 
     * @param string $key
     * @return mixed
     */
    public function get(string $key);

}