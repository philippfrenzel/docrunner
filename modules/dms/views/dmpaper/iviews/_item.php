<?php

use \Yii;
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\web\JsExpression;
use kartik\icons\Icon;

?>

<div class="dmpaper">
  <div class="widget-header">
    <div class="row">
      <div class="col-md-7">
        <h5>DocId #<?= $model['id']; ?> <?= $model['name']; ?></h5>
      </div>
      <div class="col-md-2">
        <div class="pull-right">
          <?php 
            if(class_exists('\app\modules\comments\widgets\PortletCommentsBatch')){
              echo \app\modules\comments\widgets\PortletCommentsBatch::widget(array(
                'module'      => \app\modules\workflow\models\Workflow::MODULE_DMPAPER,
                'id'          => $model['id'],
                'title'       => \Yii::t('app','Comments'),
                'htmlOptions' => array('class'=>'nothing'),
              )); 
            }
          ?>
        </div>
      </div>
      <div class="col-md-3">
        <div class="pull-right">
          <div class="label label-warning tipster" title="<?= \Yii::t('app','incoming date') ?>">
            <?= Icon::show('arrow-circle-down', ['class'=>'fa'], Icon::FA) . ' ' . date('Y-m-d',$model['time_create']); ?>
          </div>
          &nbsp;
          <a href="<?= Html::Url(['/dms/dmpaper/update','id'=>$model['id']]); ?>" class="label label-success tipster" title="<?= Yii::t('app','update'); ?>">
            <?= Icon::show('pencil', ['class'=>'fa'], Icon::FA);?>                
          </a>
        </div>
      </div>
    </div>    
  </div>
  <div class="widget-body">
    <div class="row">
      <div class="col-md-2">
        <img src="<?php // Html::Url(['/dms/default/getthumb','id'=>$model['id']]); ?>" alt="thumb"/>
      </div>
      <div class="col-md-4">          
        <blockquote>
          <p><?= $model['description']; ?></p>
        </blockquote>
      </div>
      <div class="col-md-3">
        
      </div>
      <div class="col-md-3">
        <h6><?= \Yii::t('app','Tags') ?>:</h6>
        <?= implode('&nbsp; ',$model->tagLabels); ?>
      </div>      
    </div>
  </div>
</div>
