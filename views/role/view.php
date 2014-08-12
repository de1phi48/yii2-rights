<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var de1phi\user\models\Office $model
 */

$this->title = Yii::$app->name . ' - ' . $role->name;
$this->params['breadcrumbs'][] = ['label' => \Yii::t('rights', 'Rights'), 'url' => ['/rights']];
$this->params['breadcrumbs'][] = ['label' => \Yii::t('rights', 'Roles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $role->name;
?>

<?= $this->render('/menu.php'); ?>

<h1>
	<?= \Yii::t('rights', 'View role {name}', ['name' => $role->name]) ?>
</h1>

<?= DetailView::widget([
    'model' => $role,
    'attributes' => [
    	'name',
    	'description',
    	'ruleName',
    	'data',
    	[
            'label' => \Yii::t('rights', 'Created at'),
            'value' => \Yii::t('app', '{0, date, HH:MM dd.MM.yyyy}', $role->createdAt),
        ],
        [
            'label' => \Yii::t('rights', 'Updated at'),
            'value' => \Yii::t('app', '{0, date, HH:MM dd.MM.yyyy}', $role->updatedAt),
        ],
    ],
]) ?>

<h3>
	<?= \Yii::t('rights', 'Parents'); ?>
</h3>

    <?= GridView::widget([
        'dataProvider' => $parents,
        'emptyText' => Yii::t('rights', 'This item has no parents.'),
        'columns' => [
            'parent',
        ],
    ]); ?>

<h3>
	<?= \Yii::t('rights', 'Childrens'); ?>
</h3>

<p>
    <?= GridView::widget([
        'dataProvider' => $childrens,
        'columns' => [
            'name',
            [
                'class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) use ($role) {
                        return Html::a(
                            '<span class="glyphicon glyphicon-trash"></span>', 
                            \Yii::$app->getUrlManager()->createUrl(['rights/role/revoke', 'id' => $role->name, 'name' => $model->name]),
                            ['title' => Yii::t('rights', 'Revoke')]
                        );
                    },
                ],
                'template'=>'{delete}',
            ],
        ],
    ]); ?>
</p>

<p>
    <?= $this->render('_childForm.php', [
        'model' => $model,
        'authItems' => $authItems,
    ]); ?>
</p>