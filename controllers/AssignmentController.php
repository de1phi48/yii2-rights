<?php

namespace de1phi\rights\controllers;

use yii\data\ArrayDataProvider;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\rbac\Role;
use yii\web\Controller;

use de1phi\user\models\User;

use de1phi\rights\RightsModule;
use de1phi\rights\models\AssignRoleForm;

class AssignmentController extends Controller
{
	public function actionIndex() {
		// Create a data provider for listing the users
		$userDataProvider = new ArrayDataProvider([
		    'allModels' => User::find()->select(['id', 'username'])->all(),
		    'pagination' => [
		        'pageSize' => 20,
		    ],
		]);

		return $this->render('index', [
			'users' => $userDataProvider,
		]);
	}

	public function actionView($id) {
		$user = User::findOne($id);

		$assingnForm = new AssignRoleForm;
		$assingnForm->userId = $id;

		if ($assingnForm->load(\Yii::$app->request->post())) {
			$role = new Role;
        	$role->name = $assingnForm->name;
			\Yii::$app->authManager->assign($role, $user->id);
		}

		$userRoles = \Yii::$app->authManager->getRolesByUser($id);

		$roles = \Yii::$app->authManager->getRoles();
		$rolesList = [];
		foreach ($roles as $role) {
			if(!in_array($role, $userRoles)) {
				$rolesList[$role->name] = $role->name;
			}
		}

		$userRoles = new ArrayDataProvider([
		    'allModels' => $userRoles,
		    'pagination' => [
		        'pageSize' => 20,
		    ],
		]);

		return $this->render('view', [
			'user' => $user,
			'userRoles' => $userRoles,
			'rolesList' => $rolesList,
			'assingnForm' => $assingnForm,
		]);
	}

	public function actionRevoke($userId, $roleName) {
		$role = new Role;
		$role->name = $roleName;

		\Yii::$app->authManager->revoke($role, $userId);
		
		return $this->redirect(['view', 'id' => $userId]);
	}
}