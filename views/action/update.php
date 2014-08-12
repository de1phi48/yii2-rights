<?php

use yii\helpers\Html;

$this->title = Yii::$app->name . ' - ' . \Yii::t('rights', 'Update action');

$this->params['breadcrumbs'][] = ['label' => \Yii::t('rights', 'Rights'), 'url' => ['/rights']];
$this->params['breadcrumbs'][] = ['label' => \Yii::t('rights', 'Actions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => \Yii::t('rights', 'Update Update action')];
?>
<div class="role-update">

    <h1><?= \Yii::t('rights', 'Update action {name}', ['name' => $model->name]) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
