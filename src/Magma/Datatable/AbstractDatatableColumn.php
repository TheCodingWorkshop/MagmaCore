<?php

declare(strict_types=1);

namespace Magma\Datatable;

use Magma\Datatable\DatatableColumnInterface;

abstract class AbstractDatatableColumn implements DatatableColumnInterface
{
    abstract public function columns() : array;
}