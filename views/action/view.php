<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var de1phi\user\models\Office $model
 */

$this->title = Yii::$app->name . ' - ' . \Yii::t('rights', 'View action');
$this->params['breadcrumbs'][] = ['label' => \Yii::t('rights', 'Rights'), 'url' => ['/rights']];
$this->params['breadcrumbs'][] = ['label' => \Yii::t('rights', 'Actions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = \Yii::t('rights', 'View action');
?>

<h1>
	<?= \Yii::t('rights', 'View action {name}', ['name' => $action->name]) ?>
</h1>

<?= DetailView::widget([
    'model' => $action,
    'attributes' => [
    	'name',
    	'description',
    	'ruleName',
    	'data',
    	[
            'label' => \Yii::t('rights', 'Created at'),
            'value' => \Yii::t('app', '{0, date, HH:MM dd.MM.yyyy}', $action->createdAt),
        ],
        [
            'label' => \Yii::t('rights', 'Updated at'),
            'value' => \Yii::t('app', '{0, date, HH:MM dd.MM.yyyy}', $action->updatedAt),
        ],
    ],
]) ?>

<h3>
	<?= \Yii::t('rights', 'Permissions'); ?>
</h3>