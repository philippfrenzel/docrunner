<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\modules\revision\models\Revision $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="revision-form">

	<?php $form = ActiveForm::begin(); ?>

		<?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

		<?= $form->field($model, 'revision_table')->textInput() ?>

		<?= $form->field($model, 'revision_id')->textInput() ?>

		<?= $form->field($model, 'creator_id')->textInput() ?>

		<?= $form->field($model, 'status')->textInput(['maxlength' => 255]) ?>

		<div class="form-group">
			<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		</div>

	<?php ActiveForm::end(); ?>

</div>
