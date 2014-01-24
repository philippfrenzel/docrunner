<?php

use yii\helpers\Html;
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

</div>
