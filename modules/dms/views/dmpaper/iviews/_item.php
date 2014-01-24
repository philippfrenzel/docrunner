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
      <div class="col-md-9">
        <h5><?= $model['name']; ?></h5>
      </div>
      <div class="col-md-3">
        <div class="pull-right">
          <div class="label label-default tipster" title="<?= \Yii::t('app','incoming date') ?>">
            <?= Icon::show('arrow-circle-down', ['class'=>'fa'], Icon::FA) . ' ' . date('Y-m-d',$model['time_create']); ?>
          </div>
        </div>
      </div>
    </div>    
  </div>
  <div class="widget-body">
    <div class="row">
      <div class="col-md-6">
        <blockquote>
          <?= $model['description']; ?>
        </blockquote>
      </div>
      <div class="col-md-4">
        
      </div>
      <div class="col-md-2">
        <?= \Yii::t('app','Tags') ?>:
        <?= implode('&nbsp; ',$model->tagLabels); ?>
      </div>      
    </div>
  </div>
</div>
