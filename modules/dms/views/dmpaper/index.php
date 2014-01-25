<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use kartik\icons\Icon;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\modules\dms\models\DmpaperSearch $searchModel
 */

$this->title = 'Dmpapers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dmpaper-index">

	<h1><?= Html::encode($this->title) ?></h1>

	<div class="row">
    <div class="col-sm-8 col-md-4">
        <a href="<?= Html::Url(['/dms/dmpaper/create']); ?>" class="btn btn-success">
          <?= Icon::show('plus', ['class'=>'fa'], Icon::FA);?><?= Yii::t('app','Register Paper'); ?>                
        </a>
    </div>
    <div class="col-sm-8 col-md-4">            
      
    </div>
    <div class="col-sm-8 col-md-4">            
      
    </div>
  </div>

  <div class="row">
    <div class="col-md-10">
      <?php echo $this->render('@app/modules/dms/views/dmpaper/_search', ['model' => $searchModel]); ?>
      <hr>
      <?php echo ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => '@app/modules/dms/views/dmpaper/iviews/_item',
      ]); ?>      
    </div>
  </div>

</div>
