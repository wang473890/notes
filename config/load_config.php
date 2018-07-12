<?php
/**
 * Created by PhpStorm.
 * User: wanggang
 * Date: 2018/7/12
 * Time: 15:50
 */

class LoadConfig
{

    const ENV_NAME = 'ENV_MOD';

    private $_config;

    private $_configDir;

    public $mode;


    private static $_instance;

    private function __construct()
    {
        $this->_configDir = __DIR__;
        $this->setMode();
        $this->initEnv();
        $this->loadConfig();
    }

    public static function instance()
    {
        if (!self::$_instance) {
            self::$_instance = new static();
        }
        return self::$_instance;
    }

    public function setMode()
    {

        if (!$this->mode) {
            $mode = getenv(self::ENV_NAME);

            if (empty($mode)) {
                $modeFile = $this->_configDir . '/mode.php';
                if (file_exists($modeFile)) {
                    $mode = file_get_contents($modeFile);
                }
            }

            $mode = trim(strtoupper($mode));
            $this->mode = $mode;
        }
    }

    private function loadConfig()
    {
        $this->loadMainConfig();
        $this->loadEnvConfig();
    }

    public function getConfig()
    {
        return $this->_config;
    }

    private function loadMainConfig()
    {
        if (empty($this->_config)) {
            $this->_config = require $this->_configDir . '/main.php';
        } else {
            $this->_config = self::mergeArray($this->_config, require $this->_configDir . '/main.php');
        }
    }

    private function loadEnvConfig()
    {
        if ($this->mode) {
            if (empty($this->_config)) {
                $this->_config = require $this->_configDir . '/' . strtolower($this->mode) . '.php';
            } else {
                $this->_config = self::mergeArray($this->_config, require $this->_configDir . '/' . strtolower($this->mode) . '.php');
            }
        }
    }

    public static function mergeArray($a, $b)
    {
        $args = func_get_args();
        $res = array_shift($args);
        while (!empty($args)) {
            $next = array_shift($args);
            foreach ($next as $k => $v) {
                if (is_int($k)) {
                    if (isset($res[$k])) {
                        $res[] = $v;
                    } else {
                        $res[$k] = $v;
                    }
                } elseif (is_array($v) && isset($res[$k]) && is_array($res[$k])) {
                    $res[$k] = self::mergeArray($res[$k], $v);
                } else {
                    $res[$k] = $v;
                }
            }
        }

        return $res;
    }

    private function initEnv()
    {
        switch ($this->mode) {
            case "DEV":
            case "DEVELOPMENT":
                defined('YII_DEBUG') or define('YII_DEBUG', true);
                defined('YII_ENV') or define('YII_ENV', 'dev');
                defined('YII_ENV_PROD') or define('YII_ENV_PROD', true);

                break;
            case "TEST":
                defined('YII_DEBUG') or define('YII_DEBUG', true);
                defined('YII_ENV') or define('YII_ENV', 'test');
                defined('YII_ENV_TEST') or define('YII_ENV_TEST', true);

                break;
            case "PROD":
            case "PRODUCTION":
                defined('YII_DEBUG') or define('YII_DEBUG', true);
                defined('YII_ENV') or define('YII_ENV', 'production');
                defined('YII_ENV_PROD') or define('YII_ENV_PROD', true);
                break;
            default:
                break;
        }
    }
}