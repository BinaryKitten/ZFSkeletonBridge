<?php
    chdir(dirname(__DIR__));
    defined('APPLICATION_PATH') || define('APPLICATION_PATH',   realpath('./application'));
    defined('APPLICATION_ENV')  || define('APPLICATION_ENV',    (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));

    try {
        require 'init_autoloader.php';
        Bridge_Application::init()->bootstrap()->run();
    } catch(Exception $systemException) {
        require 'system_error.php';
    }
    