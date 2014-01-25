<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\modules\dms\models\Dmpaper $model
 */

$this->title = \Yii::t('app','Add Paper');
$this->params['breadcrumbs'][] = ['label' => 'Dmpapers', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
//$this->params['breadcrumbs'][] = 'Update';
?>
<div class="dmpaper-update">

	<h1><?= Html::encode($this->title) ?></h1>

	<?php echo $this->render('_form', [
		'model' => $model,
	]); ?>

</div>
