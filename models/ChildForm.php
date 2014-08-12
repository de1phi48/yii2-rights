<?php

namespace de1phi\rights\models;

use yii\base\Model;

class ChildForm extends Model
{
    public $name;

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