<?php

declare(strict_types=1);

namespace Magma\LiquidOrm\DataMapper;

use Magma\Base\Exception\BaseUnexpectedValueException;
use Magma\DatabaseConnection\DatabaseConnectionInterface;
use Magma\Yaml\YamlConfig;

class DataMapperFactory
{

    /**
     * Main constructor class
     * 
     * @return void
     */
    public function __construct()
    { }

    /*public function __create(string $databaseConnectionString, string $dataMapperEnvironmentConfiguration) : DataMapperInterface
    {
        $credentials = (new $dataMapperEnvironmentConfiguration([]))->getDatabaseCredentials('mysql');
        $databaseConnectionObject = new $databaseConnectionString($credentials);
        if (!$databaseConnectionObject instanceof DatabaseConnectionInterface) {
            throw new DataMapperException($databaseConnectionString . ' is not a valid database connection object');
        }
        return new DataMapper($databaseConnectionObject);
    }*/

    /**
     * Creates the data mapper object and inject the dependency for this object. We are also
     * creating the DatabaseConnection Object
     * $dataMapperEnvironmentConfiguration get instantiated in the DataRepositoryFactory
     *
     * @param string $databaseConnectionString
     * @param Object $dataMapperEnvironmentConfiguration
     * @return DataMapperInterface
     * @throws BaseUnexpectedValueException
     */
    public function create(string $databaseConnectionString, Object $dataMapperEnvironmentConfiguration) : DataMapperInterface
    {
        // Create databaseConnection Object and pass the database credentials in
        $credentials = $dataMapperEnvironmentConfiguration->getDatabaseCredentials(YamlConfig::file('app')['pdo_driver']);
        $databaseConnectionObject = new $databaseConnectionString($credentials);
        if (!$databaseConnectionObject instanceof DatabaseConnectionInterface) {
            throw new BaseUnexpectedValueException($databaseConnectionString . ' is not a valid database connection object');
        }
        return new DataMapper($databaseConnectionObject);
    }


}