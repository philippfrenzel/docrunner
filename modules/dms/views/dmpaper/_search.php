<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\modules\dms\models\DmpaperSearch $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="dmpaper-search">

	<?php $form = ActiveForm::begin([
		'action' => ['index'],
		'method' => 'get',
	]); ?>

	<div class="row">
		<div class="col-md-4"><?= $form->field($model, 'party_id') ?></div>
		<div class="col-md-4"><?= $form->field($model, 'name') ?></div>
		<div class="col-md-4"><?= $form->field($model, 'status') ?></div>
	</div>		

		<div class="form-group">
			<?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
			<?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
		</div>

	<?php ActiveForm::end(); ?>

</div>
