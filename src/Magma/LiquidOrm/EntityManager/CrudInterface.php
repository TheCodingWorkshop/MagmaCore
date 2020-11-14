<?php

declare(strict_types=1);

namespace Magma\LiquidOrm\EntityManager;

interface CrudInterface
{


    public function getSchema() : string;

    public function getSchemaID() : string;

    public function lastID() : int;

    public function create(array $fields = []) : bool;

    public function read(array $selectors = [], array $conditions = [], array $parameters = [], array $optional = []) : array;

    public function update(array $fields = [], string $primaryKey) : bool;

    public function delete(array $conditions = []) : bool;

    public function search(array $selectors = [], array $conditions = []) : array;

    public function rawQuery(string $rawQuery, array $conditions = []);

}