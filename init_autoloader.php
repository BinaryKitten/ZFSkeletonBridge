<?php

// Support for ZF_PATH environment variable
if (($zf_LibPath = getenv('ZF_LIBPATH') ?: (is_dir('./library') ? './library' : false)) !== false) {
    include $zf_LibPath . '/Zend/Loader/AutoloaderFactory.php';
    include $zf_LibPath . '/Bridge/Stdlib/ArrayUtils.php';

    if (file_exists('./application/configs/autoloader.config')) {
        $override_config = include('./application/configs/autoloader.config')
    }

    Zend_Loader_AutoloaderFactory::factory(array(
        'Zend_Loader_StandardAutoloader' => array(
            'prefixes' => array(
                'Zend_'     => './library/Zend',
                'Bridge_'   => './library/Bridge',
            ),
            'autoregister_zf' => true
        )
    ));
}

if (!class_exists('Zend_Loader_AutoloaderFactory')) {
    throw new RuntimeException('Unable to load Zend Framework. Please install to library\Zend or define a ZF_PATH environment variable.');
}
