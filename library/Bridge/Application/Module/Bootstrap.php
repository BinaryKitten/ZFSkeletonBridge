<?
/**
 * @author iseus https://github.com/iseus
 * @author BinaryKitten
 * @todo - bring inline with the project style
 **/
abstract class Bridge_Application_Module_Bootstrap extends Zend_Application_Module_Bootstrap {
	public function __construct($application) {
		$dir = APPLICATION_PATH . "/modules/" . strtolower($this->getModuleName()) . "/configs/";
		if(file_exists($dir . "module.ini")) {
			$res = new Zend_Config_Ini($dir . "module.ini", APPLICATION_ENV);
			$this->setOptions($res->toArray());
		}
		if(file_exists($dir . "route.ini")) {
			$res = new Zend_Config_Ini($dir . "route.ini", APPLICATION_ENV);
			$this->setOptions($res->toArray());
		}
		parent::__construct($application);
	}
}

