<?php

declare(strict_types=1);

namespace Magma\LiquidOrm\QueryBuilder;

interface QueryBuilderInterface
{

    /**
     * Insert query string
     *
     * @return string
     * @throws QueryBuilderException
     */
    public function insertQuery() : string;

    /**
     * Select query string
     *
     * @return string
     * @throws QueryBuilderException
     */
    public function selectQuery() : string;

    /**
     * Update query string
     *
     * @return string
     * @throws QueryBuilderException
     */
    public function updateQuery() : string;

    /**
     * Delete query string
     *
     * @return string
     * @throws QueryBuilderException
     */
    public function deleteQuery() : string;

    /**
     * Search|Select query string
     *
     * @return string
     * @throws QueryBuilderException
     */
    public function searchQuery() : string;

    /**
     * Raw query string
     *
     * @return string
     * @throws QueryBuilderException
     */
    public function rawQuery() : string;

}