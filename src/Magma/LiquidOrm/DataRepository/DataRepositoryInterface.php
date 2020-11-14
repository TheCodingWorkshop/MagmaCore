<?php

declare(strict_types=1);

namespace Magma\LiquidOrm\DataRepository;

interface DataRepositoryInterface
{

    public function find(int $id) : array;

    public function findAll() : array;

    public function findBy(array $selectors = [], array $conditions = [], array $parameters = [], array $optional = []) : array;

    public function findOneBy(array $conditions) : array;

    public function findObjectBy(array $conditions = [], array $selectors = []) : Object;

    public function findBySearch(array $selectors = [], array $conditions = [], array $parameters = [], array $optional = []) : array;

    public function findByIdAndDelete(array $conditions) : bool;

    public function findByIdAndUpdate(array $fields = [], int $id) : bool;

    public function findWithSearchAndPaging(array $args, Object $request) : array;

    public function findAndReturn(int $id, array $selectors = []) : self;


}