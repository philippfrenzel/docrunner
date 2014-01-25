<?php

use \Yii;
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\web\JsExpression;
use kartik\icons\Icon;

use \phpthumb;

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
        <div class="pull-left">
          <?php
            //testing the pdf thumb generator
            $filename = "http://www.education.gov.yk.ca/pdf/pdf-test.pdf";
            
            $thumbler = new phpthumb();
            $thumbler->setSourceData(file_get_contents($filename));
            $thumbler->setParameter('w', '100');
            
            $output_filename = \Yii::$app->basePath."/attachements/thumb_small.jpg";
            if ($thumbler->GenerateThumbnail()) { // this line is VERY important, do not remove it!
                if ($thumbler->RenderToFile($output_filename)) {
                        // do something on success
                        echo 'Successfully rendered to "'.$output_filename.'"';
                } else {
                        // do something with debug/error messages
                        echo 'Failed:<pre>'.implode("\n\n", $thumbler->debugmessages).'</pre>';
                }
                $thumbler->purgeTempFiles();
            }
          ?>
        </div>
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
