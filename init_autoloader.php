<?php

// Support for ZF_PATH environment variable
if (($zf_LibPath = getenv('ZF_LIBPATH') ?: (is_dir('./library') ? './library' : false)) !== false) {
    include $zf_LibPath . '/Zend/Loader/AutoloaderFactory.php';
    include $zf_LibPath . '/Bridge/Stdlib/ArrayUtils.php';

    $config = array(
        'Zend_Loader_StandardAutoloader' => array(
            'prefixes' => array(
                'Zend_'     => './library/Zend',
                'Bridge_'   => './library/Bridge',
            ),
            'fallback_autoloader' => true,
        ),
        'Zend_Loader_ClassMapAutoloader' => array(
            './library/autoload_classmap.php',
            './application/autoload_classmap.php'
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
