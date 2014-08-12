<?php

use yii\helpers\Html;

$this->title = Yii::$app->name . ' - ' . \Yii::t('rights', 'Create role');

$this->params['breadcrumbs'][] = ['label' => \Yii::t('rights', 'Rights'), 'url' => ['/rights']];
$this->params['breadcrumbs'][] = ['label' => \Yii::t('rights', 'Roles'), 'url' => ['/rights/role/index']];
$this->params['breadcrumbs'][] = ['label' => \Yii::t('rights', 'Create role')];
?>
<div class="role-create">

    <h1><?= \Yii::t('rights', 'Create role') ?></h1>

    <?= $this->render('_roleForm', [
        'model' => $model,
    ]) ?>

</div>
