<?php 

use yii\grid\GridView;
use yii\helpers\Html;

$this->title = Yii::$app->name . ' - ' . \Yii::t('rights', 'Actions');
$this->params['breadcrumbs'][] = ['label' => \Yii::t('rights', 'Rights'), 'url' => ['/rights']];
$this->params['breadcrumbs'][] = ['label' => \Yii::t('rights', 'Actions')];
?>

<?= $this->render('/menu.php'); ?>

<h2>
    <?= \Yii::t('rights', 'Actions'); ?>
</h2>

<p>
    <?= \Yii::t('rights', 'Here you can view, delete and generate actions.'); ?>
</p>

<p>
    <?= Html::a(\Yii::t('rights', 'Generate actions'), ['/rights/action/generate'], ['class' => 'btn btn-success']); ?>
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
            'template' => '{view} {update} {delete}',
        ],
    ],
]); ?>