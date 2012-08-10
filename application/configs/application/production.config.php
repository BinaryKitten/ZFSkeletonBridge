<?php
return array(
    'appnamespace' => 'Application',
    'includePaths' => array(
        'library'   => './library',
    ),
    'bootstrap' => array(
        'path'  => './application/Bootstrap.php',
        'class' => 'Bootstrap'
    ),
    'phpSettings' => array(
        'display_startup_errors'    => 0,
        'display_errors'            => 0,
        'date'                      => array(
            'timezone' => 'UTC'
        )
    ),
    'pluginPaths' => array(
        'Bridge_Application_Resouce' => 'Bridge/Application/Resource',
        'ZendX_Application_Resource' => 'ZendX/Application/Resource',
    ),
    'resources' => array(
        'frontController'           => array(
            'controllerDirectory'   => './application/controllers',
            'throwexceptions'       => false,
            'baseurl'               => "/",
            'params'                => array(
                'displayExceptions' => 0
            ),
        ),
        'view' => array(
            'encoding'      => 'UTF-8',
            'contentType'   => 'text/html; charset=UTF-8',
            'doctype'       => 'HTML5',
            'helperPath'    => array(
                'Bridge_View_Helper_' => 'Bridge/View/Helper'
            )
        ),
        'layout' => array(
            'layoutPath' => './application/layouts/scripts'
        ),
        'locale' => array(
            'default' => 'en_GB',
            'force' => true
        ),
    ),
);