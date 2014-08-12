<?php

namespace de1phi\rights\models;

use yii\base\Model;

class ActionForm extends Model
{
    public $name;
    public $description;
    public $ruleName;
    public $data;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // rule name is required
            [['name', 'description'], 'required'],
        ];
    }
}