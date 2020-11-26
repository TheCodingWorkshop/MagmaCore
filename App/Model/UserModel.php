<?php

declare(strict_types=1);

namespace App\Model;

use Magma\Base\BaseModel;

class UserModel extends BaseModel
{

    private const TABLESCHEMA = 'users';
    private const TABLESCHEMAID = 'id';

    public function __construct()
    {
        parent::__construct(self::TABLESCHEMA, self::TABLESCHEMAID);
    }

}