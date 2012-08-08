<?php
return array(
    'phpSettings' => array(
        'display_startup_errors' => 0,
        'display_errors' => 0,
        'date' => array(
            'timezone' => 'Europe/London'
        )
    ),
    'bootstrap' => array(
        'path' => APPLICATION_PATH . '/Bootstrap.php',
        'class' => 'Bootstrap'
    ),
    'appnamespace' => 'Application',
    'pluginPaths' => array(
        'ZendX_Application_Resource' => 'ZendX/Application/Resource',
    ),
    'resources' => array(
        'frontController' => array(
            'controllerDirectory' => APPLICATION_PATH . '/controllers',
            'params' => array(
                'displayExceptions' => 0
            ),
            'throwexceptions' => false,
            'baseurl' => "/"
        ),
        'view' => array(
            'encoding' => 'UTF-8',
            'contentType' => 'text/html; charset=UTF-8',
            'doctype' => 'HTML5',
            'helperPath' => array(
                'Bridge_View_Helper_' => 'Bridge/View/Helper/'
            )
        ),
        'layout' => array(
            'layoutPath' => APPLICATION_PATH . '/layouts/scripts/'
        ),
        'locale' => array(
            'default' => 'en_GB',
            'force' => true
        ),
    ),
);