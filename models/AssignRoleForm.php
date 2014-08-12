<?php

namespace de1phi\rights\models;

use yii\base\Model;

class AssignRoleForm extends Model
{
    public $name;
    public $userId;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['name', 'userId'], 'required'],
        ];
    }

    /**
     * Logs in a user using the provided username and password.
     * @return boolean whether the user is logged in successfully
     */
    public function assign()
    {
        if ($this->validate()) {
            // action
            return true;
        } else {
            return false;
        }
    }
}