<?php

namespace de1phi\rights\controllers;

use yii\web\Controller;
use yii\data\ArrayDataProvider;
use yii\rbac\Permission;

use de1phi\rights\components\RightsGenerator;
use de1phi\rights\models\ActionForm;
use de1phi\rights\models\GenerateForm;

class ActionController extends Controller
{
	public function actionIndex() {

		$dataProvider = new ArrayDataProvider([
			'allModels' => \Yii::$app->authManager->getPermissions(),
			'pagination' => [
 	      		'pageSize' => 50,
      		],
    	]);

		return $this->render('index', [
			'dataProvider' => $dataProvider,
		]);
	}

	public function actionGenerate() {
		// Create the form model
		$model = new GenerateForm();

		if ($model->load(\Yii::$app->request->post())) {
			$model->items = array_filter($model->items, function($el){ return !($el == "0");});
			$model->items = array_keys($model->items);

			foreach ($model->items as $item) {
				$permission = new Permission;
	        	$permission->name = $item;
	        	$permission->description = null;
	        	$permission->ruleName = null;
	        	$permission->data = null;

	        	\Yii::$app->authManager->addPermission($permission);
	        	return $this->redirect(['index']);
			}
		}

		$generator = new RightsGenerator;
		$actions = $generator->getActions();

		$existingPermissions = \Yii::$app->authManager->getPermissions();
		$existingActions = [];
		foreach ($existingPermissions as $item) {
			$existingActions[] = $item->name;
		}

		return $this->render('generate', [
			'actions' => $actions,
			'model' => $model,
			'existingItems' => $existingActions,
		]);
	}

	public function actionView($id) {
		$action = \Yii::$app->authManager->getPermission($id);

		return $this->render('view', [
			'action' => $action
		]);
	}

	public function actionUpdate($id) {
		$model = new ActionForm;

		if ($model->load(\Yii::$app->request->post())) {
		 	$permission = new Permission;
        	$permission->name = $model->name;
        	$permission->description = $model->description;
        	$permission->ruleName = $model->ruleName;
        	$permission->data = $model->data;
        	
        	\Yii::$app->authManager->updatePermission($id, $permission);

		 	return $this->redirect(['index']);
		 } else {	
			$permission = \Yii::$app->authManager->getPermission($id);

			$model->name = $permission->name;
	        $model->description = $permission->description;
	        $model->ruleName = $permission->ruleName;
	        $model->data = $permission->data;

			return $this->render('update', [
	            'model' => $model,
	        ]);
		}
	}

	public function actionDelete($id) {
		\Yii::$app->authManager->deletePermission($id);

        return $this->redirect(['index']);
	}

}