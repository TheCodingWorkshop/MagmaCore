<?php

declare(strict_types=1);

namespace Magma\Base;

use Magma\Base\Exception\BaseInvalidArgumentException;
use Magma\LiquidOrm\DataRepository\DataRepository;
use Magma\LiquidOrm\DataRepository\DataRepositoryFactory;

class BaseModel
{
    
    /** @var string */
    private string $tableSchema;

    /** @var string */
    private string $tableSchemaID;

    /** @var DataRepository */
    private DataRepository $repository;

    /**
     * Main class constructor
     *
     * @param string $tableSchema
     * @param string $tableSchemaID
     * @return void
     * @throws BaseInvalidArgumentException
     */
    public function __construct(string $tableSchema, string $tableSchemaID)
    {
        if (empty($tableSchema) || empty($tableSchemaID)) {
            throw new BaseInvalidArgumentException('These arguments are required.');
        }
        $factory = new DataRepositoryFactory('', $tableSchema, $tableSchemaID);
        $this->repository = $factory->create(DataRepository::class);
    }

    /**
     * Get the data repository object based on the context model
     * which the repository is being executed from.
     *
     * @return DataRepository
     */
    public function getRepo() : DataRepository
    {
        return $this->repository;
    }


}