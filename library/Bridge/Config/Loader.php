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
                    $config = self::merge(
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

    /**
     * Merge two arrays together.
     *
     * If an integer key exists in both arrays, the value from the second array
     * will be appended the the first array. If both values are arrays, they
     * are merged together, else the value of the second array overwrites the
     * one of the first array.
     *
     * @param  array $a
     * @param  array $b
     * @return array
     */
    public static function merge(array $a, array $b)
    {
        foreach ($b as $key => $value) {
            if (array_key_exists($key, $a)) {
                if (is_int($key)) {
                    $a[] = $value;
                } elseif (is_array($value) && is_array($a[$key])) {
                    $a[$key] = self::merge($a[$key], $value);
                } else {
                    $a[$key] = $value;
                }
            } else {
                $a[$key] = $value;
            }
        }

        return $a;
    }

}