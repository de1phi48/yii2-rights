<?php

namespace de1phi\rights\models;

use yii\base\Model;

class RoleForm extends Model
{
    public $name;
    public $description;
    public $ruleName;
    public $data;

    public $isNewRecord = false;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // rule na,e is required
            [['name'], 'required'],
        ];
    }
}