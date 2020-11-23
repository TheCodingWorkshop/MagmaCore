<?php

declare(strict_types=1);

namespace Magma\LiquidOrm\QueryBuilder;

use Magma\LiquidOrm\QueryBuilder\Exception\QueryBuilderException;
use Magma\LiquidOrm\QueryBuilder\QueryBuilderInterface;


class QueryBuilderFactory
{

    /**
     * Main constructor method
     * 
     * @return void
     */
    public function __construct()
    { }

    /**
     * Create the QueryBuilder object
     *
     * @param string $queryBuilderString
     * @return QueryBuilderInterface
     */
    public function create(string $queryBuilderString) : QueryBuilderInterface
    {
        $queryBuilderObject = new $queryBuilderString();
        if (!$queryBuilderString instanceof QueryBuilderInterface) {
            throw new QueryBuilderException($queryBuilderString . ' is not a valid Query builder object.');
        }
        return $queryBuilderObject;
    }

}