<?php

declare(strict_types=1);

namespace Magma\LiquidOrm\DataMapper;

use Magma\LiquidOrm\DataMapper\Exception\DataMapperException;
use Magma\DatabaseConnection\DatabaseConnectionInterface;

class DataMapperFactory
{

    /**
     * Main constructor class
     * 
     * @return void
     */
    public function __construct()
    { }

    /**
     * Creates the data mapper object and inject the dependency for this object
     *
     * @param string $databaseConnectionString
     * @param string $dataMapperEnvironmentConfiguration
     * @return DataMapperInterface
     * @throws DataMapperException
     */
    public function create(string $databaseConnectionString, string $dataMapperEnvironmentConfiguration) : DataMapperInterface
    {
        $credentials = (new $dataMapperEnvironmentConfiguration([]))->getDatabaseCredentials('mysql');
        $databaseConnectionObject = new $databaseConnectionString($credentials);
        if (!$databaseConnectionObject instanceof DatabaseConnectionInterface) {
            throw new DataMapperException($databaseConnectionString . ' is not a valid database connection object');
        }
        return new DataMapper($databaseConnectionObject);
    }

}