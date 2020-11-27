<?php

declare(strict_types=1);

namespace Magma\DatabaseConnection\Exception;

use PDOException;

class DatabaseConnectionException extends PDOException
{
    
    /**
     * Main constructor class which overrides the parent constructor and set the message
     * and the code properties which is optional
     * 
     * @param string $message
     * @param int $code
     * @return void
     */
    public function __construct($message = null, $code = null)
    {
        $this->message = $message;
        $this->code = $code;
    }

}