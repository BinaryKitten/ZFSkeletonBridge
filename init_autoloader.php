<?php

// Support for ZF_PATH environment variable
if (($zf_LibPath = getenv('ZF_LIBPATH') ?: (is_dir('./library') ? './library' : false)) !== false) {
    set_include_path(implode(PATH_SEPARATOR, array(realpath($zf_LibPath))));
    include 'Zend/Loader/AutoloaderFactory.php';
    include 'Zend/Loader/ClassMapAutoloader.php';
    include 'Bridge/Stdlib/ArrayUtils.php';

    $config = array(
        'Zend_Loader_ClassMapAutoloader' => array(
            './library/autoload_classmap.php',
            './application/autoload_classmap.php'
        ),
        'Zend_Loader_StandardAutoloader' => array(
            'prefixes' => array(
                'Bridge_'   => 'Bridge',
                'Zend_'     => 'Zend',
                'ZendX_'    => 'ZendX',
            ),
            'fallback_autoloader' => true,
        ),
    );
    if (file_exists('./application/configs/autoloader.config')) {
        $override_config = include('./application/configs/autoloader.config');
        $config = Bridge_Stdlib_ArrayUtils::merge($config, $override_config);
    }

    Zend_Loader_AutoloaderFactory::factory($config);
}

if (!class_exists('Zend_Loader_AutoloaderFactory')) {
    throw new RuntimeException('Unable to load Zend Framework. Please install to library\Zend or define a ZF_PATH environment variable.');
}
