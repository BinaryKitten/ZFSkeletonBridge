<?php
    defined('PUBLIC_PATH')                  || define('PUBLIC_PATH',                    __DIR__);
    defined('APPLICATION_PATH')             || define('APPLICATION_PATH',               realpath(__DIR__ . '/../application'));
    defined('LIB_PATH')                     || define('LIB_PATH',                       realpath(__DIR__ . '/../library'));
    defined('APPLICATION_ENV')              || define('APPLICATION_ENV',                (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));

// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(LIB_PATH)));

try {
    $autoloaderConfig   = include(APPLICATION_PATH .'/configs/autoloader.config.php');
    require_once LIB_PATH . '/ZendX/Loader/AutoloaderFactory.php';
    ZendX_Loader_AutoloaderFactory::factory($autoloaderConfig);


    $applicationConfig  = Bridge_Config_Loader::getConfig('application');
    $application = new Zend_Application(APPLICATION_ENV, $applicationConfig);
    $application->bootstrap()->run();
} catch(Exception $e) {
    header('HTTP/1.1 500 Internal Server Error');
    echo '<h1>Error Loading Site</h1>';
    echo '<p><strong>Message:</strong><br /><pre>' . $e->getMessage() . '</pre></p>';

    if (isset($_GET['debug'])) {
        echo '(' . $e->getCode() . ')' .$e->getFile() . ':' . $e->getLine() . '<br />';
        echo '<pre>';
        print_r($e->getTraceAsString());
        echo '</pre>';
    }
}