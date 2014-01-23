<?php


use yii\helpers\Html;
use yii\widgets\ActiveForm;

use dosamigos\fileinput\FileInput;

?>


<?php $form = ActiveForm::begin([
  'action' => Html::Url(['/dms/default/attachfile']),
  'method' => 'post',
  'options' => [
   'enctype' => 'multipart/form-data',
  ]
]); ?>

<?= FileInput::widget([
  'model' => $model,
  'attribute' => 'fileattachement', // image is the attribute
  // using STYLE_IMAGE allows me to display an image. Cool to display previously
  'style' => FileInput::STYLE_BUTTON
]);?>

<?= Html::activeHiddenInput($model,'dms_module'); ?>

<?= Html::activeHiddenInput($model,'dms_id'); ?>

<?= Html::submitButton(\Yii::t('app','Upload'), ['class' => 'btn btn-info pull-right']) ?>

<?php ActiveForm::end(); ?>
