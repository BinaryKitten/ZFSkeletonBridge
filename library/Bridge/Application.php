<?php

class Bridge_Application
{
   /**
     * @param array $configuration
     * @return Zend_Application
     */
    public static function init($configuration = array())
    {
        if (is_string($configuration)) {
            $configuration = Bridge_Config_Loader::getConfig($configuration);
        } elseif(empty($configuration)) {
            $configuration = Bridge_Config_Loader::getConfig('application');
        }
        return new Zend_Application(APPLICATION_ENV, $configuration);
    }
}
