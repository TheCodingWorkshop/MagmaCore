<?php

declare(strict_types=1);

namespace Magma\LiquidOrm\QueryBuilder;

abstract class AbstractQueryBuilder implements QueryBuilderInterface
{

    /** @var array */
    protected array $key;

    /** @var string */
    protected string $sqlQuery = '';

    /** @var array */
    protected const SQL_DEFAULT = [
        'conditions' => [],
        'selectors' => [],
        'replace' => false,
        'distinct' => false,
        'from' => [],
        'where' => null,
        'and' => [],
        'or' => [],
        'orderby' => [],
        'fields' => [],
        'primary_key' => '',
        'table' => '',
        'type' => '',
        'raw' => '',

        'table_join' => '',
        'join_key' => '',
        'join' => []
    ];

    /** @var array */
    protected const QUERY_TYPES = ['insert', 'select', 'update', 'delete', 'raw', 'search', 'join'];

    /**
     * Main class constructor
     * 
     * @return void
     */
    public function __construct()
    {}

    protected function orderByQuery()
    {
        // Append the orderby statement if set
        if (isset($this->key["extras"]["orderby"]) && $this->key["extras"]["orderby"] != "") {
            $this->sqlQuery .= " ORDER BY " . $this->key["extras"]["orderby"] . " ";
        }
    }

    protected function queryOffset()
    {
        // Append the limit and offset statement for adding pagination to the query
        if (isset($this->key["params"]["limit"]) && $this->key["params"]["offset"] != -1) {
            $this->sqlQuery .= " LIMIT :offset, :limit";
        }

    }

    protected function isQueryTypeValid(string $type) : bool
    {
        if (in_array($type, self::QUERY_TYPES)) {
            return true;
        }
        return false;
    }

    /**
     * Checks whether a key is set. returns true or false if not set
     * 
     * @param string $key
     * @return bool
     */
    protected function has(string $key): bool
    {
        return isset($this->key[$key]);
    }

}