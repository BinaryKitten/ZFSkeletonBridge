<?php

/**
 * Simple class to load Config files and merge appropriately
 *
 * @author Kathryn Reeve <kathryn@binarykitten.com>
 */
class Bridge_Config_Loader {
    public static function getConfig($key, $asClass=null)
    {
        $key        = strtolower($key);
        $location   = APPLICATION_PATH. '/configs/'.$key;

        if (file_exists($location.'.config.php')) {
             $config = include($location .'.config.php');
        } elseif (file_exists(APPLICATION_PATH. '/configs/'.$key.'/')) {
            if (!file_exists($location .'/production.config.php')) {
                throw new Zend_Config_Exception('Cannot locate config file for '.$key);
            }
            $config = include($location .'/production.config.php');

            if (APPLICATION_ENV !== 'production') {
                if (file_exists($location . '/'. APPLICATION_ENV . '.config.php')) {
                    $config = Bridge_Stdlib_ArrayUtils::merge(
                        $config,
                        include($location . '/'. APPLICATION_ENV . '.config.php')
                    );
                }
            }

        } else {
            throw new Zend_Config_Exception('Cannot locate config file for '.$key);
        }
       
        if ($asClass !== null && class_exists($asClass)) {
            $config = new $asClass($config);
        }

        return $config;
    }
}