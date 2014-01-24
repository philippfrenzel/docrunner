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

		<?= $form->field($model, 'id') ?>

		<?= $form->field($model, 'party_id') ?>

		<?= $form->field($model, 'description') ?>

		<?= $form->field($model, 'name') ?>

		<?= $form->field($model, 'status') ?>

		<?php // echo $form->field($model, 'creator_id') ?>

		<?php // echo $form->field($model, 'time_deleted') ?>

		<?php // echo $form->field($model, 'time_create') ?>

		<div class="form-group">
			<?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
			<?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
		</div>

	<?php ActiveForm::end(); ?>

</div>
