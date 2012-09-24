<?php

/**
 * Simple class to load Config files and merge appropriately
 *
 * @author Kathryn Reeve <kathryn@binarykitten.com>
 */
class Bridge_Config_Loader
{

    public static function getConfig($key, $module = null, $asClass=null)
    {
        $key        = strtolower($key);
        if ($module !== null && $asClass == null && substr(strtolower($module),0,5)=='zend_') {
            $asClass = $module;
            $module = null;
        }

        $location   = APPLICATION_PATH;
        if ($module !== null) {
            $location = Zend_Controller_Front::getInstance()->getModuleDirectory($module);
        }
        $location .= DIRECTORY_SEPARATOR . 'configs' . DIRECTORY_SEPARATOR . $key;


        if (file_exists($location.'.config.php')) {
             $config = include($location .'.config.php');
        } elseif (file_exists($location . DIRECTORY_SEPARATOR)) {
            if (!file_exists($location . DIRECTORY_SEPARATOR .'production.config.php')) {
                throw new Zend_Config_Exception('Cannot locate config file for '.$key);
            }
            $config = include($location . DIRECTORY_SEPARATOR . 'production.config.php');

            if (APPLICATION_ENV !== 'production') {
                if (file_exists($location . DIRECTORY_SEPARATOR . APPLICATION_ENV . '.config.php')) {
                    $config = Bridge_Stdlib_ArrayUtils::merge(
                        $config,
                        include($location . DIRECTORY_SEPARATOR . APPLICATION_ENV . '.config.php')
                    );
                }
            }
        } else {
            throw new Zend_Config_Exception('Cannot locate config file for '.$key);
        }

        if ($asClass !== null && class_exists($asClass)) {
            if (class_exists($asClass)) {
                $config = new $asClass($config);
            }
        }

        return $config;
    }
}
