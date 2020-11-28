<?php

declare(strict_types=1);

namespace App\Entity;

use Magma\Base\BaseEntity;

class UserEntity extends BaseEntity
{

    /**
     * Main constructor entity
     * 
     * @param array $dirtyData - raw data coming from php super global $_POSTs 
     * @return void
     * @throws BaseInvalidArgumentException
     */
    public function __construct(array $dirtyData)
    {
        parent::__construct($dirtyData);
    }

}