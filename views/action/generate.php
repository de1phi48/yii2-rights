<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var de1phi\user\models\Office $model
 */

$this->title = Yii::$app->config->name . ' - ' . \Yii::t('rights', 'Action generator');
$this->params['breadcrumbs'][] = ['label' => \Yii::t('rights', 'Rights'), 'url' => ['/rights']];
$this->params['breadcrumbs'][] = ['label' => \Yii::t('rights', 'Actions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = \Yii::t('rights', 'Generator');

?>

<h1>
	<?= \Yii::t('rights', 'Generator') ?>
</h1>

<p>
    <?= \Yii::t('rights', 'Please select which actions you wish to generate.'); ?>
</p>

<div class="form">
	<?php $form = ActiveForm::begin(); ?>
		<div class="row">
			<table class="items generate-item-table" border="0" cellpadding="0" cellspacing="0">
				<tbody>
					<tr class="heading-row">
						<th colspan="2">
							<?= \Yii::t('rights', 'Found actions') ?>
						</th>
					</tr>
					<?php $i=0; foreach($actions as $action): ?>
						<?php $actionExists = in_array($action, $existingItems); ?>
						<?php if(!$actionExists): ?>
							<tr class="action-row<?= ($i++ % 2) === 0 ? ' odd' : ' even'; ?>">
								<td class="checkbox-column"><?= $form->field($model, 'items[' . $action . ']')->checkBox(); ?></td>
								<td class="name-column"><?= $action ?></td>
							</tr>
						<?php endif; ?>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>

		<div class="row">
			<?php echo Html::a(\Yii::t('rights', 'Select all'), '#', array(
	   			'onclick'=>"jQuery('.generate-item-table').find(':checkbox').attr('checked', 'checked');",
	   			'class'=>'selectAllLink')); ?>
	   		/
			<?php echo Html::a(\Yii::t('rights', 'Select none'), '#', array(
				'onclick'=>"jQuery('.generate-item-table').find(':checkbox').removeAttr('checked');",
				'class'=>'selectNoneLink')); ?>
		</div>

   		<div class="row">

			<?php echo Html::submitButton(\Yii::t('rights', 'Generate'), ['class' => 'btn btn-primary']); ?>

		</div>

	<?php ActiveForm::end(); ?>
</div>