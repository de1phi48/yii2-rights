<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::$app->name . ' - ' . \Yii::t('rights', 'Assignments');
$this->params['breadcrumbs'][] = ['label' => \Yii::t('rights', 'Rights'), 'url' => ['/rights']];
$this->params['breadcrumbs'][] = ['label' => \Yii::t('rights', 'Assignments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $user->username];

?>

<?= $this->render('/menu.php'); ?>

<h1>
    <?= \Yii::t('rights', 'Assignments for {username}', ['username' => $user->username]); ?>
</h1>

<p>
	<?= \Yii::t('rights', 'Here you can view which permissions has been assigned to this user.'); ?>
</p>


<?= GridView::widget([
    'dataProvider' => $userRoles,
    'columns' => [
        'name',
        'description',
        [
            'class' => 'yii\grid\ActionColumn',
            'template'=>'{delete}',
            'buttons' => [
                'delete' => function ($url, $model) use ($user) {
                    return Html::a(
                        '<span class="glyphicon glyphicon-trash"></span>', 
                        \Yii::$app->getUrlManager()->createUrl(['/rights/assignment/revoke', 'userId' => $user->id, 'roleName'=>$model->name]),
                        ['title' => Yii::t('rights', 'Revoke')]
                    );
                },
            ],
        ],
    ],
]); ?>

<h3>
    <?= \Yii::t('rights', 'Assign role to user'); ?>
</h3>

<?php $form = ActiveForm::begin(); ?>

    <?= $form->field($assingnForm, 'name')->dropDownList($rolesList, ['promt' => \Yii::t('rights', 'Select role')]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('rights', 'Assign'), ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>


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