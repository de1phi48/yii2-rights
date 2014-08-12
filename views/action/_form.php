<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="role-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 64]) ?>

    <?= $form->field($model, 'description')->textInput() ?>

    <?= $form->field($model, 'ruleName')->textInput(['maxlength' => 64]) ?>

    <?= $form->field($model, 'data')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('rights', 'Update'), ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
