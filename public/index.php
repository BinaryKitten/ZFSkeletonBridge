<?php
    chdir(dirname(__DIR__));
    defined('APPLICATION_PATH') || define('APPLICATION_PATH',   realpath('./application'));
    defined('APPLICATION_ENV')  || define('APPLICATION_ENV',    (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));

    try {
        include 'init_autoloader.php';
        Bridge_Application::init()->boostrap()->run();
    } catch(Exception $systemException) {
        include ('system_error.php');
    }