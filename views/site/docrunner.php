<?php

use yii\helpers\Html;
use yii\widgets\ListView;

use kartik\widgets\SideNav;
use kartik\icons\Icon; 

use yiidhtmlx\Grid;
use yiidhtmlx\Tabbar;

/**
 * @var yii\web\View $this
 */
$this->title = Yii::t('app','DOCrunner - Dashboard');

$siteJS = <<<SITEJS

SITEJS;
$this->registerJs($siteJS);

?>

<div class="site-index">

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
        'itemView' => function ($model, $key, $index, $widget) {
          return Html::a(Html::encode($model->name), ['/dms/dmpaper/view', 'id' => $model->id]);
        },
      ]); ?>      
    </div>
  </div>

</div>
