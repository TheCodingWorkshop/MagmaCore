<?php

declare(strict_types=1);

namespace Magma\LiquidOrm\DataMapper;

use Magma\Base\Exception\BaseInvalidArgumentException;
//use Magma\LiquidOrm\DataMapper\Exception\DataMapperInvalidArgumentException;

class DataMapperEnvironmentConfiguration
{

    /**
     * @var array
     */
    private array $credentials;

    /**
     * Main construct class
     * 
     * @param array $credentials
     * @return void
     */
    public function __construct(array $credentials)
    {
        $this->credentials = $credentials;
    }

    /*private function __isCredentialsValid(string $driver) : void
    {
        if (empty($driver) && !is_string($driver)) {
            throw new DataMapperInvalidArgumentException('Invalid argument. This is either missing or off the invalid data type.');
        }
        if (!is_array($this->credentials)) {
            throw new DataMapperInvalidArgumentException('Invalid credentials');
        }
        if (!in_array($driver, array_keys($this->credentials[$driver]))) {
            throw new DataMapperInvalidArgumentException('Invalid or unsupport database driver.');
        }
    }*/

    /**
     * Checks credentials for validity
     * 
     * @param string $driver
     * @return void
     */
    private function isCredentialsValid(string $driver) : void
    {
        if (empty($driver) || !is_array($this->credentials)) {
            throw new BaseInvalidArgumentException('Core Error: You have either not specify the default database driver or the database.yaml is returning null or empty.');
        }
    }


    /*public function __getDatabaseCredentials(string $driver) : array
    {
        $connectionArray = [];
        $this->isCredentialsValid($driver);
        foreach ($this->credentials as $credential) {
            if (array_key_exists($driver, $credential)) {
                $connectionArray = $credential[$driver];
            }
        }
        return $connectionArray;
    }*/
    /**
     * Get the user defined database connection array
     * 
     * @param string $driver
     * @return array
     * @throws BaseInvalidArgumentException
     */
    public function getDatabaseCredentials(string $driver) : array
    {
        $connectionArray = [];
        $this->isCredentialsValid($driver);
        foreach ($this->credentials as $credential) {
            if (!array_key_exists($driver, $credential)) {
                throw new BaseInvalidArgumentException('Core Error: Your selected database driver is not supported. Please see the database.yaml file for all support driver. Or specify a supported driver from your app.yaml configuration file');
            } else {
                $connectionArray = $credential[$driver];
            }
        }
        return $connectionArray;
    }

}