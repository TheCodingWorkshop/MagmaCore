<?php

declare(strict_types=1);

namespace Magma\Abstracts;

use Magma\Base\BaseModel;

abstract class AbstractBaseModel extends BaseModel
{

    /**
     * Guard these IDs from being deleted etc..
     *
     * @return array
     */
    abstract public function guardedID() : array;



}