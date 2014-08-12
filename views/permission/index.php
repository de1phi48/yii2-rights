<?php 

use yii\grid\GridView;
use yii\helpers\Html;

$this->title = Yii::$app->name . ' - ' . \Yii::t('rights', 'Permissions');
$this->params['breadcrumbs'][] = ['label' => \Yii::t('rights', 'Rights'), 'url' => ['/rights']];
$this->params['breadcrumbs'][] = ['label' => \Yii::t('rights', 'Permissions')];
?>

<?= $this->render('/menu.php'); ?>

<h2>
    <?= \Yii::t('rights', 'Permissions'); ?>
</h2>

<p>
    <?= \Yii::t('rights', 'Here you can view and manage the permissions assigned to each role.'); ?>
</p>

<?php if(empty($roles)): ?>
    <p class="text-danger">
        <?= \Yii::t('rights', 'First you must to add roles.'); ?>
    </p>
<?php else: ?>
    <p>
        <?= Html::dropDownList(
            'roles', 
            $roles[$id], 
            $roles,
            ['onchange'=>"location = location.pathname + '?id=' + this.options[this.selectedIndex].value;"]
        ); ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $actions,
        'columns' => [
            'name',
            [
                'label' => '',
                'format' => 'html',
                'value' => function ($model, $index, $widget) use ($id,  $childrens) {
                    $url = Html::a(
                        \Yii::t('rights', 'Assign'), 
                        ['/rights/permission/assign', 'id' => $id, 'name' => $model->name], 
                        ['class' => 'btn btn-success']
                    );
                    if(!empty($childrens)) {
                        return in_array($model->name, $childrens) ? '' : $url;
                    } else {
                        return $url;
                    }
                },
            ],
            [
                'label' => '',
                'format' => 'html',
                'value' => function ($model, $index, $widget) use ($id,  $childrens) {
                    $url = Html::a(
                        \Yii::t('rights', 'Revoke'), 
                        ['/rights/permission/revoke', 'id' => $id, 'name' => $model->name], 
                        ['class' => 'btn btn-info']
                    );
                    if(!empty($childrens)) {
                        return in_array($model->name, $childrens) ? $url : '';
                    } else {
                        return '';
                    }
                },
            ],
        ],
    ]); ?>

<?php endif; ?>
