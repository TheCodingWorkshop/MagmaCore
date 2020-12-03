<?php

declare(strict_types=1);

namespace Magma\Datatable;

interface DatatableInterface
{

    public function create(string $dataColumnString, array $dataRepository = [], array $sortController = []) : self;

    public function table() : ?string;

    public function pagination() : ?string;

}