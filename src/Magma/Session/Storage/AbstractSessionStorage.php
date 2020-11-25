<?php

declare(strict_types=1);

namespace Magma\Session\Storage;

use Magma\Base\Exception\BaseException;
use Throwable;

abstract class AbstractSessionStorage implements SessionStorageInterface
{

    /** @var array */
    protected array $options = [];

    /**
     * abstract class constructor
     *
     * @param array $options
     * @return void
     */
    public function __construct(array $options = [])
    {
        if ($options)
            $this->options = $options;

        $this->iniSet();
        // Destroy any existing sessions started with session.auto_start
        if ($this->isSessionStarted()) {
            session_unset();
            session_destroy();
        }
        $this->start();
    }

    /**
     * Set the name of the session
     *
     * @param string $sessionName
     * @return void
     */
    public function setSessionName(string $sessionName) : void
    {
        session_name($sessionName);
    }

    /**
     * Return the current session name
     *
     * @return string
     */
    public function getSessionName() : string
    {
        return session_name();
    }

    /**
     * Set the name of the session ID
     *
     * @param $sessionID
     * @return void
     */
    public function setSessionID(string $sessionID) : void
    {
        session_id($sessionID);
    }

    /**
     * Return the current session ID
     *
     * @return string
     */
    public function getSessionID()
    {
        return session_id();
    }

    public function iniSet()
    {
        ini_set('session.gc_maxlifetime', $this->options['gc_maxlifetime']);
        ini_set('session.gc_divisor', $this->options['gc_divisor']);
        ini_set('session.gc_probability', $this->options['gc_probability']);
        ini_set('session.lifetime', $this->options['lifetime']);
        ini_set('session.use_cookies', $this->options['use_cookies']);
    }

    /**
     * Prevent session within the cli. Even though we can't run sessions within
     * the command line. also we checking we have a session id and its not empty
     * else return false
     * 
     * @return bool
     */
    public function isSessionStarted()
    {
        return php_sapi_name() !== 'cli' ? $this->getSessionID() !=='' : false;
    }

    /**
     * Start our session if we haven't already have a php session
     * 
     * @return void
     */
    public function startSession()
    {
        if (session_status() == PHP_SESSION_NONE)
            session_start();
    }

    /**
     * Define our session_set_cookie_params method via the $this->options parameters which 
     * will be define within our core config directory
     * 
     * @return void
     */
    public function start() : void                                                                                         
    {
        $this->setSessionName($this->options['session_name']);
        $domain = (isset($this->options['domain']) ? $this->options['domain'] : isset($_SERVER['SERVER_NAME']));
        $secure = (isset($this->options['secure']) ? $this->options['secure'] : isset($_SERVER['HTTPS']));

        session_set_cookie_params($this->options['lifetime'], $this->options['path'], $domain, $secure, $this->options['httponly']);

        $this->startSession();
    }


}