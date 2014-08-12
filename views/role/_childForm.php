<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="child-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->dropDownList($authItems) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('rights', 'Add child'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
