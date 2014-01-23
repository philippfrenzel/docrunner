<?php

use yii\helpers\Html;

use yiidhtmlx\Grid;

/**
 * @var yii\web\View $this
 */

?>

<?php
  $gridURL = Html::url(['/purchase/default/dhtmlxgrid','un'=> date('Ymd')]);
?>

<div id="tabapproval" class="dhtmlxTabcontainer">

  <div class="row">
    <div class="col-md-12">              

      <h3><?= Yii::t('app','Needs to be approved by you'); ?>...</h3>
<?php
  echo Grid::widget(
    [
    'clientOptions'=>[
        'parent'      => 'PurchaseOrderWorkflowGrid',
        'image_path'  => Yii::$app->AssetManager->getBundle('yiidhtmlx\GridObjectAsset')->baseUrl."/dhtmlxGrid/imgs/",
        'auto_height' => false,
        'auto_width'  => false,
        'smart'       => true,
        'skin'        => "dhx_terrace",       
        'columns' => [
          ['label'=>'id','width'=>'40','type'=>'ro'],
          ['label'=>[Yii::t('app','status')],'type'=>'ro','width'=>'100'],
          ['label'=>[Yii::t('app','Requested By')],'type'=>'ro'],
          ['label'=>[Yii::t('app','Request Date')],'type'=>'ro','width'=>'170'],
          ['label'=>[Yii::t('app','Lines')],'type'=>'ro','width'=>'40'],
          ['label'=>[Yii::t('app','Approved')],'type'=>'ro','width'=>'40'],
          ['label'=>[Yii::t('app','Rejected')],'type'=>'ro','width'=>'40'],
        ],
      ],
      'enableSmartRendering' => true,
      'options'=>[
        'id'    => 'PurchaseOrderWorkflowGrid',
        'height' => '250px', 
        'width'  => '100%',               
      ],
      'clientDataOptions'=>[
        'type'=>'json',
        'url'=> $gridURL
      ],
      'clientEvents'=>[
        'onRowDblClicked'=>'doOnWorkflowRowSelect',
        'onEnter' => 'doOnWorkflowRowSelect',
        'onFilterStart' => 'doOnWorkflowFilterStart'
      ]   
    ]
  );
?>
    </div>
  </div>

</div><!--end of tabapproval/-->
