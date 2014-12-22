<?php
namespace GwopApigilityClientTest\Framework;

use GwopApigilityClientTest\Utils\Bootstrap;
use PHPUnit_Framework_TestCase;
use Zend\ServiceManager\ServiceManager;

class TestCase extends PHPUnit_Framework_TestCase
{

    /** @var ServiceManager */
    protected $serviceManager;

    protected static $serverVars;

    public static function setUpBeforeClass()
    {
        self::setServerVar('REMOTE_ADDR', '10.1.0.1');
        self::setServerVar('HTTP_X_FORWARDED_FOR', '10.1.0.199');
    }

    public static function tearDownAfterClass()
    {
        if (! empty(self::$serverVars)) foreach (self::$serverVars as $key) {
            unset($_SERVER[$key]);
        }
    }

    public static function setServerVar($key, $value)
    {
        self::$serverVars[$key] = $value;
        $_SERVER[$key] = $value;
    }

    /**
     * Get \Zend\ServiceManager\ServiceManager instance
     * @access public
     * @return ServiceManager
     */
    public function getServiceManager()
    {
        if (! $this->serviceManager instanceof ServiceManager) {
            $this->serviceManager = Bootstrap::getServiceManager();
        }

        return $this->serviceManager;
    }

    public function getTestConfig()
    {
        return $this->getServiceManager()->get('config');
    }

}
