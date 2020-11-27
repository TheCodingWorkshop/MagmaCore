<?php

declare(strict_types=1);

namespace Magma\Session;

use Magma\Base\Exception\BaseUnexpectedValueException;
use Magma\Session\Storage\SessionStorageInterface;
use Magma\Session\SessionInterface;

class SessionFactory
{

    public function __construct()
    { }

    /**
     * Factory method which creates the specified cache along with the specified kind of session storage.
     * After creating the session, it will be registered at the session manager
     * @param string $sessionName
     * @param string $storageObjectName
     * @param array $options
     * @return SessionInterface
     * @throws BaseUnexpectedValueException
     */
    public function create(string $sessionName, string $storageString, array $options = []) : SessionInterface
    {
        $storageObject = new $storageString($options);
        if (!$storageObject instanceof SessionStorageInterface) {
            throw new BaseUnexpectedValueException($storageString . ' is not a valid session storage object.');
        }

        return new Session($sessionName, $storageObject);
    }

}