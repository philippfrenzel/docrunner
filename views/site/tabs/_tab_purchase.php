<?php

use yii\helpers\Html;

use yiidhtmlx\Grid;

/**
 * @var yii\web\View $this
 */

$target = Html::url(['/purchase/default/generatepo','id'=>'']);

$gridJS = <<<GRIDJS

function doOnRowSelectPurchaseOrderPrintGrid(id,ind) {
  window.location = "$target"+id;
};

GRIDJS;
$this->registerJs($gridJS);

?>

<?php
  $gridURL = Html::url(['/purchase/default/dhtmlxgridegp','un'=> date('Ymd'),'status'=>'purchased']);
?>

<div id="tabpurchase" class="dhtmlxTabcontainer">

  <div class="row">
    <div class="col-md-12">

      <h3><?= Yii::t('app','Print Purchaseorder'); ?>...</h3>
<?php
  echo Grid::widget(
    [
    'clientOptions'=>[
        'parent'      => 'PurchaseOrderPrintGrid',
        'image_path'  => Yii::$app->AssetManager->getBundle('yiidhtmlx\GridObjectAsset')->baseUrl."/dhtmlxGrid/imgs/",
        'auto_height' => false,
        'auto_width'  => false,
        'smart'       => true,
        'skin'        => "dhx_terrace",       
        'columns' => [
          ['label'=>'id','width'=>'40','type'=>'ro'],
          ['label'=>[Yii::t('app','status')],'type'=>'ro','width'=>'100'],
          ['label'=>[Yii::t('app','Requested By')],'type'=>'ed'],
          ['label'=>[Yii::t('app','Request Date')],'type'=>'ro','width'=>'170'],
          ['label'=>[Yii::t('app','Lines')],'type'=>'ro','width'=>'40'],
          ['label'=>[Yii::t('app','Approved')],'type'=>'ro','width'=>'40'],
          ['label'=>[Yii::t('app','Rejected')],'type'=>'ro','width'=>'40'],
          ['label'=>[Yii::t('app','Purchased')],'type'=>'ro','width'=>'40'],
        ],
      ],
      'enableSmartRendering' => true,
      'options'=>[
        'id'    => 'PurchaseOrderPrintGrid',
        'height' => '500px', 
        'width'  => '100%',               
      ],
      'clientDataOptions'=>[
        'type'=>'json',
        'url'=> $gridURL
      ],
      'clientEvents'=>[
        'onRowDblClicked'=>'doOnRowSelectPurchaseOrderPrintGrid',
        //'onEnter' => 'doOnWorkflowBookedRowSelect'        
      ]   
    ]
  );
?>
    </div>
  </div>

</div><!--end of tabpurchase/-->
