<?php
namespace ApigilityClientTest\Utils;

use Zend\Mvc\Service\ServiceManagerConfig,
    Zend\ServiceManager\ServiceManager,
    Zend\Stdlib\ArrayUtils;

use RuntimeException;

class Bootstrap
{

    /** @var  ServiceManager */
    protected static $serviceManager;

    /** @var string[] */
    protected static $zf2ModulePaths;

    /**
     * Get service manager instance
     * @access public
     * @static
     * @return ServiceManager
     */
    public static function getServiceManager()
    {
        // return service manager instance
        return static::$serviceManager;
    }

    /**
     * Set service manager instance
     * @access public
     * @static
     * @param  ServiceManager $serviceManager Service manager instance
     * @return void
     */
    public static function setServiceManager(ServiceManager $serviceManager)
    {
        // store service manager instance
        static::$serviceManager = $serviceManager;
    }

    /**
     * Initialize bootstrap class
     * @access public
     * @static
     * @return void
     */
    public static function init()
    {
        // add vendor and module directory to module paths if exists
        static::addModulePaths(array('vendor', 'module'));

        // init autoloader
        static::initAutoloader();

        // init service manager
        static::initServiceManager();
    }

    /**
     * Initialize class autoloader
     * @access protected
     * @static
     * @return void
     *
     * @throws RuntimeException
     */
    protected static function initAutoloader()
    {
        // get vendor path
        $vendorPath = static::findParentPath('vendor');

        // check if vendor autoload file not exists
        if (!$vendorPath || !file_exists($vendorPath.'/autoload.php')) {

            // throw RuntimeException indicate composer autoloader is not found
            throw new RuntimeException('vendor/autoload.php could not be found. Did you install via composer?');
        }

        /** @noinspection PhpIncludeInspection include autoload file */
        $loader = include $vendorPath.'/autoload.php';

        // add this suite test to loader
        $loader->add('ApigilityClientTest', dirname(dirname(__DIR__)));
    }

    /**
     * Initialize service manager
     * @access protected
     * @static
     * @return void
     */
    protected static function initServiceManager()
    {
        // Load the user-defined test configuration file, if it exists; otherwise, load
        if (is_readable(__DIR__ . '/../../TestConfig.php')) {
            $testConfig = include __DIR__ . '/../../TestConfig.php';
        } else {
            $testConfig = include __DIR__ . '/../../TestConfig.php.dist';
        }

        $baseConfig = array(
            'module_listener_options' => array(
                'module_paths' => static::$zf2ModulePaths,
            ),
        );

        $config = ArrayUtils::merge($baseConfig, $testConfig);

        // create service manager instance
        $serviceManager = new ServiceManager(new ServiceManagerConfig());

        // set application configuration to service manager
        $serviceManager->setService('ApplicationConfig', $config);
        $serviceManager->setFactory('ServiceListener', 'Zend\Mvc\Service\ServiceListenerFactory');

        /** @var $moduleManager \Zend\ModuleManager\ModuleManager */
        $moduleManager = $serviceManager->get('ModuleManager');

        // load modules and return service manager instance
        $moduleManager->loadModules();

        // store service manager
        static::setServiceManager($serviceManager);
    }

    /**
     * Add module paths to container
     * @access protected
     * @static
     * @param  string|string[] $paths Module paths
     * @return void
     */
    protected static function addModulePaths($paths)
    {
        // check if paths container is not setup
        if (static::$zf2ModulePaths === null) {

            // create paths container
            static::$zf2ModulePaths = array(dirname(dirname(dirname(__DIR__))));
        }

        // be sure we have a paths list
        $paths = array_filter((array) $paths);

        // iterate all paths
        foreach ($paths as $path) {

            // check parent path exists
            if (($modulePath = static::findParentPath($path)) && !in_array($modulePath, static::$zf2ModulePaths)) {

                // add module path to container
                static::$zf2ModulePaths[] = $modulePath;
            }
        }
    }

    /**
     * Find parent path
     * @access protected
     * @static
     * @param  string      $path Path to search
     * @return bool|string
     */
    protected static function findParentPath($path)
    {
        // setup current and previous directory
        $currentDir = __DIR__;
        $previousDir = '.';

        // iterate all previous directory
        while (!is_dir($currentDir.DIRECTORY_SEPARATOR.$path)) {

            // update current directory
            $currentDir = dirname($currentDir);

            // chech if current and previous directories are same
            if ($previousDir === $currentDir) {

                // return false
                return false;
            }

            // update previous directory
            $previousDir = $currentDir;
        }

        // return directory according path
        return $currentDir.DIRECTORY_SEPARATOR.$path;
    }
}
