<?php

namespace de1phi\rights\components;

use yii\base\Component;
use yii\helpers\ArrayHelper;

/**
 * @inheritdoc
 */
class RightsGenerator extends Component
{

	/**
	* Returns all actions.
	* @param array $actions the actions.
	*/
	public function getActions() {

		$actions = [];

		$controllers = [];

		$controllers = ArrayHelper::merge(
							$controllers, 
							$this->getControllers()
						);
		
		$controllers = ArrayHelper::merge(
							$controllers, 
							$this->getControllersInModules()
						);

		$controllers = ArrayHelper::merge(
							$controllers, 
							$this->getControllersInVendor()
						);

		foreach ($controllers as $controller) {
			$actions = ArrayHelper::merge(
							$actions, 
							$this->parseActions($controller)
						);
		}

		return $actions;
	}

	public function getControllers($path = null) {
		if($path == null) {
			$path = \Yii::getAlias('@app/controllers');
		}
		$controllers = [];

		if(is_dir($path)) {
			$dir = scandir($path);
			foreach ($dir as $item) {
				if(preg_match('/(\S+)Controller.php/', $item)) {
					$controllers[] = \Yii::getAlias($path . DIRECTORY_SEPARATOR . $item);
				}
			}
		}

		return $controllers;
	}

	public function getControllersInModules($modulesPath = null) {
		if($modulesPath == null) {
			$modulesPath = \Yii::getAlias('@app/modules');
		}
		$controllers = [];

		if(is_dir($modulesPath)) {
			$dir = scandir($modulesPath);
			foreach ($dir as $item) {
				if($item !== '.' && $item !== '..') {
					$path = \Yii::getAlias($modulesPath . DIRECTORY_SEPARATOR . $item  . DIRECTORY_SEPARATOR . 'controllers');
					if(is_dir($path)) {
						$controllers = ArrayHelper::merge(
							$controllers, 
							$this->getControllers($path)
						);
					}

					$subModulesPath = \Yii::getAlias($modulesPath . DIRECTORY_SEPARATOR . $item  . DIRECTORY_SEPARATOR . 'modules');
					if(is_dir($subModulesPath)) {
						$controllers = ArrayHelper::merge(
							$controllers, 
							$this->getControllersInModules($subModulesPath)
						);
					}
				}
			}
		}

		return $controllers;
	}	

	public function getControllersInVendor() {
		$path = \Yii::getAlias('@app/vendor');
		$controllers = [];

		if(is_dir($path)) {
			$dir = scandir($path);
			foreach ($dir as $item) {
				if($item !== '.' && $item !== '..') {
					$extensionPath = \Yii::getAlias($path . DIRECTORY_SEPARATOR . $item);
					if(is_dir($extensionPath)) {
						$controllers = ArrayHelper::merge(
							$controllers, 
							$this->getControllersInModules($extensionPath)
						);
					}
				}
			}
		}

		return $controllers;
	}

	public function parseActions($controller) {
		$actions = [];

		$namespace = '';

		$controllerName = preg_replace('/.php/', '', end(explode('/', $controller)));

		$file = fopen($controller, 'r');	
		while(feof($file) === false) {
			$line = fgets($file);
			if(empty($namespace)) {
				preg_match('/namespace\s+(.+?);/', $line, $matches);
				if($matches !== array()) {
					$namespace = $matches[1];
				}
			}
			preg_match('/public[ \t]+function[ \t]+action([A-Z]{1}[a-zA-Z0-9]+)[ \t]*\(/', $line, $matches);
			if($matches !== array()) {
				$actions[] = $namespace . '\\' . $controllerName . '::action' . $matches[1];
			}
		}	

		return $actions;
	}
}