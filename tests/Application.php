<?php

declare(strict_types=1);

use Magma\LiquidOrm\DataRepository\DataRepositoryInterface;
use Magma\LiquidOrm\LiquidOrmManager;
use Magma\Session\Storage\NativeSessionStorage;
use Magma\Session\Storage\SessionStorageInterface;
use Magma\Yaml\YamlConfig;

define('MAGMA_MIN_VERSION', '7.4.12');

final class Application
{

    protected array $credentials = [];
    protected string $sessionName = '';
    protected string $cacheName = '';
    protected string $appRoot;
    protected Object $sessionStorage;


    /**
     * Undocumented function
     *
     * @param string $appRoot
     */
    public function __construct(string $appRoot)
    {
        $this->appRoot = $appRoot;
    }

    /**
     * Undocumented function
     *
     * @param array $credentials
     * @param DataRepositoryInterface $repository
     * @param SessionStorageInterface $sessionStorage
     * @return void
     */
    public function liquid(array $credentials = [], SessionStorageInterface $sessionStorage = null)
    {
        if (is_array($credentials) && count($credentials) > 0)   
            $this->credentials = $credentials;
                
        $this->sessionStorage = $sessionStorage ?: new NativeSessionStorage();

    }

    /***
     * 
     */
    public function run()
    {

        $this->directoryConstants();
        if (version_compare($ver = PHP_VERSION, $req = MAGMA_MIN_VERSION, '<')) {
            die(sprintf('You are running PHP %s, but Magma Core requires at least <strong>PHP %s</strong> ro run', $ver, intval($req)));
        }
        /**
         * PHP 5.4 ships with a built in web server for development. This server
         * allows us to run silex without any configuration. However in order
         * to server static files we need to handle it nicely
         */
        $filename = __DIR__ . preg_replace('#(\?.*)$#', '', $_SERVER['REQUEST_URI']);
        if (php_sapi_name() == 'cli-server' && is_file($filename)) {
            return false;
        }
        $autoload = APP_ROOT . '/vendor/autoload.php';
        if (is_file($autoload)) {
            require $autoload;
        }
        $this->defaultEnvironment();

        //$dotenv = Dotenv\Dotenv::createImmutable(APP_ROOT, '.env.example');
        //$dotenv->load();

        $this->errorHandler();
        
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    private function directoryConstants()
    {
        define('DS', '/');
        define("UPLOAD_PATH",       $_SERVER['DOCUMENT_ROOT'] . DS . "uploads/");
        define("APP_ROOT",          $this->appRoot);
        define("STORAGE_PATH",      APP_ROOT . DS . "storage");
        //define("FLAT_DB",           STORAGE_PATH . DS . "flat_db");
        //define("BACKUPS",           STORAGE_PATH . DS . "backups");
        //define("UPDATES",           STORAGE_PATH . DS . "updates");
        //define("SQL_DUMP",          STORAGE_PATH . DS . "dump");
        define("TMP_DIR",           APP_ROOT . DS . "tmp");
        define("CACHE_PATH",        TMP_DIR . DS . "cache");
        define("LOG_DIR",          TMP_DIR . DS . "log");
        define("CONFIG_PATH",       APP_ROOT . DS . "config");
        define("TEMPLATES_PATH",    APP_ROOT . '/App');
        
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    private function defaultEnvironment()
    {
        //date_default_timezone_set('');
        if (!extension_loaded('mbstring')) {
            die(sprintf('mbstring extension is not loaded. This is required for %s to run correctly.', $i));
        }
        ini_set('default_charset', 'UTF-8');
        mb_internal_encoding('UTF-8');
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    private function errorHandler()
    {
        error_reporting(E_ALL | E_STRICT);
        set_error_handler('Magma\ErrorHandling\ErrorHandling::errorHandler');
        set_exception_handler('Magma\ErrorHandling\ErrorHandling::exceptionHandler');
    }


}