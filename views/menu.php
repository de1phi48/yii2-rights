<?php

use yii\widgets\Menu;
use de1phi\rights\RightsAsset;

RightsAsset::register($this);

?>

<div class="rights-menu">
	<?= Menu::widget([
	    'items' => [
	        ['label' => \Yii::t('rights', 'Assignments'), 'url' => ['/rights']],
	        ['label' => \Yii::t('rights', 'Roles'), 'url' => ['/rights/role/index']],
	        ['label' => \Yii::t('rights', 'Actions'), 'url' => ['/rights/action/index']],
	        ['label' => \Yii::t('rights', 'Permissions'), 'url' => ['/rights/permission/index']],
	    ],
	]); ?>
</div>