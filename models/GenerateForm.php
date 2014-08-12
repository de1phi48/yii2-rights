<?php

namespace de1phi\rights\models;

use yii\base\Model;

class GenerateForm extends Model
{
    public $items;
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // rule na,e is required
            [['items'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'items' => '',
        ];
    }
}