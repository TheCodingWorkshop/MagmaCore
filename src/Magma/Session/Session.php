<?php

declare(strict_types=1);

namespace Magma\Session;

use Magma\Base\Exception\BaseException;
use Magma\Base\Exception\BaseInvalidArgumentException;
use Magma\Session\SessionInterface;
use Magma\Session\Storage\SessionStorageInterface;
use Throwable;

class Session implements SessionInterface
{

    /** @var SessionStorageInterface */
    protected SessionStorageInterface $storage;

    /** @var string */
    protected string $sessionName;

    /** @var const */
    protected const SESSION_PATTERN = '/^[a-zA-Z0-9_\.]{1,64}$/';

    /**
     * Class constructor
     *
     * @param string $sessionName
     * @param SessionStorageInterface $storage
     * @throws BaseInvalidArgumentException
     */
    public function __construct(string $sessionName, SessionStorageInterface $storage = null)
    {
        if ($this->isSessionKeyValid($sessionName) === false) {
            throw new BaseInvalidArgumentException($sessionName . ' is not a valid session name');
        }
        
        $this->sessionName = $sessionName;
        $this->storage = $storage;
    }

    /**
     * @inheritdoc
     *
     * @param string $key
     * @param mixed $value
     * @return void
     * @throws BaseException
     */
    public function set(string $key, $value) : void
    {
        $this->ensureSessionKeyIsValid($key);
        try{
            $this->storage->SetSession($key, $value);
        } catch(Throwable $throwable) {
            throw new BaseException('An exception was thrown in retrieving the key from the session storage. ' . $throwable);
        }

    }

    /**
     * @inheritdoc
     *
     * @param string $key
     * @param mixed $value
     * @return void
     * @throws BaseException
     */
    public function setArray(string $key, $value) : void
    {
        $this->ensureSessionKeyIsValid($key);
        try{
            $this->storage->setArraySession($key, $value);
        }catch(Throwable $throwable) {
            throw new BaseException('An exception was thrown in retrieving the key from the session storage. ' . $throwable);
        }

    }

    /**
     * @inheritdoc
     *
     * @param string $key
     * @param mixed $default
     * @return void
     * @throws BaseException
     */
    public function get(string $key, $default = null) 
    {
        try{
            return $this->storage->getSession($key, $default);
        } catch(Throwable $throwable) {
            throw $throwable;
        }
    }

    /**
     * @inheritdoc
     *
     * @param string $key
     * @return boolean
     * @throws BaseException
     */
    public function delete(string $key) : bool
    {
        $this->ensureSessionKeyIsValid($key);
        try{
            $this->storage->deleteSession($key);
        }catch(Throwable $throwable) {
            throw $throwable;
        }
        return true;
    }

    /**
     * @inheritdoc
     *
     * @return void
     */
    public function invalidate() : void
    {
        $this->storage->invalidate();
    }

    /**
     * @inheritdoc
     *
     * @param string $key
     * @param [type] $value
     * @return void
     * @throws BaseException
     */
    public function flush(string $key, $value = null)
    {
        $this->ensureSessionKeyIsValid($key);
        try{
            $this->storage->flush($key, $value);
        }catch(Throwable $throwable) {
            throw $throwable;
        }
    }

    /**
     * @inheritdoc
     *
     * @param string $key
     * @return boolean
     * @throws SessiopnInvalidArgumentException
     */
    public function has(string $key) : bool
    {
        $this->ensureSessionKeyIsValid($key);
        return $this->storage->hasSession($key);
    }

    /**
     * Checks whether our session key is valid according the defined regular expression
     *
     * @param string $key
     * @return boolean
     */
    protected function isSessionKeyValid(string $key) : bool
    {
        return (preg_match(self::SESSION_PATTERN, $key) === 1);
    }

    /**
     * Checks whether we have session key 
     *
     * @param string $key
     * @return void
     */
    protected function ensureSessionKeyIsvalid(string $key) : void
    {
        if ($this->isSessionKeyValid($key) === false) {
            throw new BaseInvalidArgumentException($key . ' is not a valid session key');
        }
    }

}