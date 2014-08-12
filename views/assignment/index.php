<?php

use yii\grid\GridView;
use yii\helpers\Html;

$this->title = Yii::$app->name . ' - ' . \Yii::t('rights', 'Assignments');
$this->params['breadcrumbs'][] = ['label' => \Yii::t('rights', 'Rights'), 'url' => ['/rights']];
$this->params['breadcrumbs'][] = ['label' => \Yii::t('rights', 'Assignments')];

?>

<?= $this->render('/menu.php'); ?>

<h2>
    <?= \Yii::t('rights', 'Assignments'); ?>
</h2>

<p>
	<?= \Yii::t('rights', 'Here you can view which permissions has been assigned to each user.'); ?>
</p>

<?= GridView::widget([
    'dataProvider' => $users,
    'columns' => [
        'username',
        [
            'label' => \Yii::t('rights', 'Roles'),
            'value' => function ($model, $index, $widget) {
                $row = '';
                $roles = \Yii::$app->authManager->getRolesByUser($model->id);
                foreach ($roles as $role) {
                    $row[] = $role->name;
                }
                $row = implode('<br />', $row);
                return $row;
            },
            'format' => 'html',
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'buttons' => [
                'view' => function ($url, $model) {
                    return Html::a(
                        '<span class="glyphicon glyphicon-eye-open"></span>', 
                        \Yii::$app->getUrlManager()->createUrl(['rights/assignment/view', 'id'=>$model->id]),
                        ['title' => Yii::t('rights', 'View')]
                    );
                },
            ],
            'template'=>'{view}',
        ],
    ],
]); ?>
<?php /*
<?= GridView::widget([
    'dataProvider' => $dataProvider,
]); ?>


	<?php /*$this->widget('zii.widgets.grid.CGridView', [
	    'dataProvider'=>$dataProvider,
	    'template'=>"{items}\n{pager}",
	    'emptyText'=>\Yii::t('rights', 'No users found.'),
	    'htmlOptions'=> ['class'=>'grid-view assignment-table'],
	    'columns'=>[
    		array(
    			'name'=>'name',
    			'header'=>\Yii::t('rights', 'Name'),
    			'type'=>'raw',
    			'htmlOptions'=>array('class'=>'name-column'),
    			'value'=>'$data->getAssignmentNameLink()',
    		),
    		array(
    			'name'=>'assignments',
    			'header'=>\Yii::t('rights', 'Roles'),
    			'type'=>'raw',
    			'htmlOptions'=>array('class'=>'role-column'),
    			'value'=>'$data->getAssignmentsText(CAuthItem::TYPE_ROLE)',
    		),
			array(
    			'name'=>'assignments',
    			'header'=>\Yii::t('rights', 'Tasks'),
    			'type'=>'raw',
    			'htmlOptions'=>array('class'=>'task-column'),
    			'value'=>'$data->getAssignmentsText(CAuthItem::TYPE_TASK)',
    		),
	    ]
	]); */?>