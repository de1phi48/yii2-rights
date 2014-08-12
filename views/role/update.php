<?php

use yii\helpers\Html;

$this->title = Yii::$app->name . ' - ' . \Yii::t('rights', 'Create role');

$this->params['breadcrumbs'][] = ['label' => \Yii::t('rights', 'Rights'), 'url' => ['/rights']];
$this->params['breadcrumbs'][] = ['label' => \Yii::t('rights', 'Roles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => \Yii::t('rights', 'Update role {name}', ['name' => $model->name])];
?>
<div class="role-update">

    <h1><?= \Yii::t('rights', 'Update role {name}', ['name' => $model->name]) ?></h1>

    <?= $this->render('_roleForm', [
        'model' => $model,
    ]) ?>

</div>
