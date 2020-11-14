<?php

declare(strict_types=1);

namespace Magma\LiquidOrm\EntityManager;

use Magma\LiquidOrm\DataMapper\DataMapper;
use Magma\LiquidOrm\QueryBuilder\QueryBuilder;
use Throwable;

class Crud implements CrudInterface
{

    protected DataMapper $dataMapper;

    protected QueryBuilder $queryBuilder;

    protected string $tableSchema;

    protected string $tableSchemaID;

    public function __construct(DataMapper $dataMapper, QueryBuilder $queryBuilder, string $tableSchema, string $tableSchemaID)
    {
        $this->dataMapper = $dataMapper;
        $this->queryBuilder = $queryBuilder;
        $this->tableSchema = $tableSchema;
        $this->tableSchemaID = $tableSchemaID;
    }

    public function getSchema() : string
    {
        return $this->tableSchema;
    }

    public function getSchemaID() : string
    {
        return $this->tableSchemaID;
    }

    public function lastID() : int
    {
        return $this->dataMapper->getLastId();
    }

    /**
     * @inheritDoc
     */
    public function create(array $fields = []) : bool
    {
        try {
            $args = ['table' => $this->getSchema(), 'type' => 'insert', 'fields' => $fields];
            $query = $this->queryBuilder->buildQuery($args)->insertQuery();
            $this->dataMapper->persist($query, $this->dataMapper->buildQueryParameters($fields));
            if ($this->dataMapper->numRows() ==1) {
                return true;
            }
        } catch(Throwable $throwable) {
            throw $throwable;
        }
    }

    public function read(array $selectors = [], array $conditions = [], array $parameters = [], array $optional = []) : array
    {
        try{
            $args = ['table' => $this->getSchema(), 'type' => 'select', 'selectors' => $selectors, 'conditions' => $conditions, 'params' => $parameters, 'extras' => $optional];
            $query = $this->queryBuilder->buildQuery($args)->selectQuery();
            $this->dataMapper->persist($query, $this->dataMapper->buildQueryParameters($conditions, $parameters));
            if ($this->dataMapper->numRows() > 0) {
                return $this->dataMapper->results();
            }
        } catch(Throwable $throwable) {
            throw $http_response_header;
        }
    }

    public function update(array $fields = [], string $primaryKey) : bool
    {
        try {
            $args = ['table' => $this->getSchema(), 'type' => 'update', 'fields' => $fields, 'primary_key' => $primaryKey];
            $query = $this->queryBuilder->buildQuery($args)->updateQuery();
            $this->dataMapper->persist($query, $this->dataMapper->buildQueryParameters($fields));
            if ($this->dataMapper->numRows() == 1) {
                return true;
            }
        }catch(Throwable $throwable) {
            throw $throwable;
        }
    }

    public function delete(array $conditions = []) : bool
    {
        try {
            $args = ['table' => $this->getSchema(), 'type' => 'delete', 'conditions' => $conditions];
            $query = $this->queryBuilder->buildQuery($args)->deleteQuery();
            $this->dataMapper->persist($query, $this->dataMapper->buildQueryParameters($conditions));
            if ($this->dataMapper->numRows() == 1) {
                return true;
            }
        }catch(Throwable $throwable) {
            throw $throwable;
        }
    }

    public function search(array $selectors = [], array $conditions = []) : array
    {
        try {
            $args = ['table' => $this->getSchema(), 'type' => 'search', 'selectors' => $selectors, 'conditions' => $conditions];
            $query = $this->queryBuilder->buildQuery($args)->searchQuery();
            $this->dataMapper->persist($query, $this->dataMapper->buildQueryParameters($conditions));
            if ($this->dataMapper->numRows() > 0) {
                return $this->dataMapper->results();
            }
        }catch(Throwable $throwable) {
            throw $throwable;
        }

    }

    public function rawQuery(string $rawQuery, ?array $conditions = [])
    {

    }


}