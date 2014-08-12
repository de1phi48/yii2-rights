<?php

namespace de1phi\rights\controllers;

use yii\web\Controller;
use yii\data\ArrayDataProvider;
use yii\rbac\Role;

use de1phi\rights\models\ChildForm;
use de1phi\rights\models\RoleForm;

class RoleController extends Controller
{
	public function actionIndex() {

		$dataProvider = new ArrayDataProvider([
			'allModels' => \Yii::$app->authManager->getRoles(),
			'pagination' => [
 	      		'pageSize' => 10,
      		],
    	]);

		return $this->render('index', [
			'dataProvider' => $dataProvider,
		]);
	}

	public function actionView($id) {
		$model = new ChildForm;
		$role = \Yii::$app->authManager->getRole($id);

		if ($model->load(\Yii::$app->request->post())) {
			\Yii::$app->authManager->addChild($role, $model);
		}

		$parents = new ArrayDataProvider([
			'allModels' =>\Yii::$app->authManager->getParents($role->name),
			'pagination' => [
 	      		'pageSize' => 50,
      		],
    	]);

    	$childrenItems = \Yii::$app->authManager->getChildren($id);

    	$childrens = new ArrayDataProvider([
			'allModels' => $childrenItems,
			'pagination' => [
 	      		'pageSize' => 50,
      		],
    	]);

    	$childrenList = [];

    	foreach ($childrenItems as $childrenItem) {
    		$childrenList[] = $childrenItem->name;
    	}

    	$items = \Yii::$app->authManager->getAuthItems();
    	$authItems = [];

    	foreach ($items as $authItem) {
    		if(!in_array($authItem->name, $childrenList) and ($id != $authItem->name)) {
    			$authItems[$authItem->name] = $authItem->name;
    		}
    	}

		return $this->render('view', [
			'model' => $model,
			'role' => $role,
			'parents' => $parents,
			'childrens' => $childrens,
			'authItems' => $authItems,
		]);
	}

	public function actionCreate() {
		$model = new RoleForm;
		$model->isNewRecord = true;

        if ($model->load(\Yii::$app->request->post())) {
        	$role = new Role;
        	$role->name = $model->name;
        	$role->description = $model->description;
        	$role->ruleName = $model->ruleName;
        	$role->data = $model->data;

        	\Yii::$app->authManager->addRole($role);

            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
	}

	public function actionUpdate($id) {
		$model = new RoleForm;
		$model->isNewRecord = false;

		if ($model->load(\Yii::$app->request->post())) {
		 	$role = new Role;
        	$role->name = $model->name;
        	$role->description = $model->description;
        	$role->ruleName = $model->ruleName;
        	$role->data = $model->data;

        	\Yii::$app->authManager->updateRole($id, $role);

		 	return $this->redirect(['index']);
		 } else {	
			$role = \Yii::$app->authManager->getRole($id);

			$model->name = $role->name;
	        $model->description = $role->description;
	        $model->ruleName = $role->ruleName;
	        $model->data = $role->data;

			return $this->render('update', [
	            'model' => $model,
	        ]);
		}
	}

	public function actionDelete($id) {
		\Yii::$app->authManager->deleteRole($id);

        return $this->redirect(['index']);
	}

	public function actionRevoke($id, $name) {

		$role = \Yii::$app->authManager->getItem($id);
		$permission = \Yii::$app->authManager->getItem($name);

		\Yii::$app->authManager->removeChild($role, $permission);

		return $this->redirect(['view', 'id' => $id]);
	}

}