<?php

declare(strict_types=1);

namespace Magma\LiquidOrm\EntityManager;

use Magma\LiquidOrm\EntityManager\Exception\CrudException;
use Magma\LiquidOrm\EntityManager\EntityManagerInterface;
use Magma\LiquidOrm\QueryBuilder\QueryBuilderInterface;
use Magma\LiquidOrm\DataMapper\DataMapperInterface;

class EntityManagerFactory
{

    protected DataMapperInterface $dataMapper;

    protected QueryBuilderInterface $queryBuilder;

    /**
     * Undocumented function
     *
     * @param DataMapperInterface $dataMapper
     * @param QueryBuilderInterface $queryBuilder
     */
    public function __construct(DataMapperInterface $dataMapper, QueryBuilderInterface $queryBuilder)
    {
        $this->dataMapper = $dataMapper;
        $this->queryBuilder = $queryBuilder;
    }

    /**
     * Undocumented function
     *
     * @param string $crudString
     * @param string $tableSchema
     * @param string $tableSchemaID
     * @param array $options
     * @return EntityManagerInterface
     */
    public function create(string $crudString, string $tableSchema, string $tableSchemaID, array $options = []) : EntityManagerInterface
    {
        $crudObject = new $crudString($this->dataMapper, $this->queryBuilder, $tableSchema, $tableSchemaID, $options);
        if (!$crudObject instanceof CrudInterface) {
            throw new CrudException($crudString . ' is not a valid crud object.');
        }
        return new EntityManager($crudObject);
    }

}