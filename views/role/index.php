<?php 

use yii\grid\GridView;
use yii\helpers\Html;

$this->title = Yii::$app->name . ' - ' . \Yii::t('rights', 'Assignments');
$this->params['breadcrumbs'][] = ['label' => \Yii::t('rights', 'Rights'), 'url' => ['/rights']];
$this->params['breadcrumbs'][] = ['label' => \Yii::t('rights', 'Roles')];
?>

<?= $this->render('/menu.php'); ?>

<h2>
    <?= \Yii::t('rights', 'Roles'); ?>
</h2>

<p>
    <?= \Yii::t('rights', 'A role is group of permissions to perform a variety of actions, for example the authenticated user.'); ?><br />
    <?= \Yii::t('rights', 'Roles exist at the top of the authorization hierarchy and can therefore inherit from other roles.'); ?>
</p>

<p>
    <?= Html::a(\Yii::t('rights', 'Create role'), ['/rights/role/create'], ['class' => 'btn btn-success']); ?>
</p>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'name',
        'description',
        'ruleName',
        'data',
        [
            'label' => \Yii::t('rights', 'Created at'),
            'value' => function ($model, $index, $widget) {
                return \Yii::t('app', '{0, date, HH:MM dd.MM.yyyy}', $model->createdAt);
            },
        ],
        [
            'label' => \Yii::t('rights', 'Updated at'),
            'value' => function ($model, $index, $widget) {
                return \Yii::t('app', '{0, date, HH:MM dd.MM.yyyy}', $model->updatedAt);
            },
        ],
        [
            'class' => 'yii\grid\ActionColumn',
        ],
    ],
]); ?>