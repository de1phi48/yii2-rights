<?php

namespace de1phi\rights\components;

use yii\base\ActionFilter;
use yii\web\ForbiddenHttpException;

class RightsFilter extends ActionFilter
{
	
    /**
     * This method is invoked right before an action is to be executed (after all possible filters.)
     * @param Action $action the action to be executed.
     * @return boolean whether the action should continue to be executed.
     */
	public function beforeAction($action) {
		$user = \Yii::$app->getUser();
        $action_name = $action->controller->module->controllerNamespace . '\\' . ucfirst($action->controller->id) . 'Controller' . '::' . 'action' . ucfirst($action->id);
        if(!$user->can($action_name)) {
            $this->denyAccess($user);
        } else {
            return true;
        }
    }

    /**
     * Denies the access of the user.
     * The default implementation will redirect the user to the login page if he is a guest;
     * if the user is already logged, a 403 HTTP exception will be thrown.
     * @param User $user the current user
     * @throws ForbiddenHttpException if the user is already logged in.
     */
    protected function denyAccess($user) {
        if ($user->getIsGuest()) {
           $user->loginRequired();
        } else {
        	throw new ForbiddenHttpException(\Yii::t('yii', 'You are not allowed to perform this action.'));
        }
    }
}
?>