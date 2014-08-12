<?php

namespace de1phi\rights\controllers;

use yii\web\Controller;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;

class PermissionController extends Controller
{
	public function actionIndex($id = null) {

		if($id == null) {
			$id = 'Guest';
		}

		$actions = new ArrayDataProvider([
			'allModels' => \Yii::$app->authManager->getPermissions(),
			'pagination' => [
 	      		'pageSize' => 50,
      		],
    	]);

		$childrens = [];
    	$childrenList = \Yii::$app->authManager->getChildrens($id);
    	foreach ($childrenList as $children) {
    		$childrens[] = $children['child'];
    	}
    	
		$roles = \Yii::$app->authManager->getRoles();
		$roles = ArrayHelper::map($roles, 'name', 'name');

		return $this->render('index', [
			'id' => $id,
			'roles' => $roles,
			'actions' => $actions,
			'childrens' => $childrens,
		]);
	}

	public function actionAssign($id, $name) {

		$role = \Yii::$app->authManager->getRole($id);
		$permission = \Yii::$app->authManager->getPermission($name);

		\Yii::$app->authManager->addChild($role, $permission);

		return $this->redirect(['index', 'id' => $id]);
	}

	public function actionRevoke($id, $name) {

		$role = \Yii::$app->authManager->getItem($id);
		$permission = \Yii::$app->authManager->getItem($name);

		\Yii::$app->authManager->removeChild($role, $permission);

		return $this->redirect(['index', 'id' => $id]);
	}
}