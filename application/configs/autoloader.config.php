<?php
return array(
    'ZendX_Loader_ClassMapAutoloader' => array(
        LIB_PATH . '/.classmap.php',
        APPLICATION_PATH . '/.classmap.php'
    ),
    'ZendX_Loader_StandardAutoloader' => array(
        'prefixes' => array(
            'Zend_'     => LIB_PATH . '/Zend',
            'Bridge_'   => LIB_PATH . '/Bridge',
        ),
        'fallback_autoloader' => true,
    ),
);