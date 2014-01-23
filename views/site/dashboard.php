<?php

use yii\helpers\Html;
use kartik\widgets\SideNav;
use kartik\icons\Icon; 

use yiidhtmlx\Grid;
use yiidhtmlx\Tabbar;

/**
 * @var yii\web\View $this
 */
$this->title = Yii::t('app','purePO - Dashboard');

//all that has to do with the grid ****************************************************************************************

//target urls
$target = Html::url(array('/purchase/purchase-order/update','id'=>''));
$targetWorkflow = Html::url(array('/purchase/purchase-order/workflow','id'=>''));
$targetEGP = Html::url(array('/purchase/purchase-order-group/purchase','id'=>''));

//grid urls
$gridURL = Html::url(['/purchase/purchase-order/dhtmlxgrid','un'=> date('Ymd')]);
$gridWorkflowURL = Html::url(['/purchase/default/dhtmlxgrid','un'=> date('Ymd')]);
$gridWorkflowURLApproved = Html::url(['/purchase/default/dhtmlxgridapproved','un'=> date('Ymd'),'status'=>'approved']);
$gridWorkflowURLPending = Html::url(['/purchase/default/dhtmlxgridapproved','un'=> date('Ymd'),'status'=>'pending']);
$gridWorkflowURLBooked = Html::url(['/purchase/default/dhtmlxgridapproved','un'=> date('Ymd'),'status'=>'booked']);

$gridJS = <<<GRIDJS
function doOnRowSelect(id,ind) {
  window.location = "$target"+id; 
};

function doOnWorkflowRowSelect(id,ind) {
  window.location = "$targetWorkflow"+id; 
};

function doOnWorkflowBookedRowSelect(id,ind) {
  window.location = "$targetEGP"+id; 
};

doOnFilterStart = function(indexes,values){
  $.ajax("$gridURL&search="+values).
  success(function(data){
      dhtmlxPurchaseOrderGrid.clearAll();
      dhtmlxPurchaseOrderGrid.parse(data,"json");
    }
  );  
}

doOnWorkflowFilterStart = function(indexes,values){
  $.ajax("$gridWorkflowURL&search="+values).
  success(function(data){
      dhtmlxPurchaseOrderWorkflowGrid.clearAll();
      dhtmlxPurchaseOrderWorkflowGrid.parse(data,"json");
    }
  );  
}
GRIDJS;
$this->registerJs($gridJS);

?>

<div class="site-index">

  <div class="row">
    <div class="col-sm-8 col-md-4">
        <a href="<?= Html::Url(['/purchase/purchase-order/create-request']); ?>" class="btn btn-success">
          <?= Icon::show('plus', ['class'=>'fa'], Icon::FA);?><?= Yii::t('app','New purchase request'); ?>                
        </a>
    </div>
    <div class="col-sm-8 col-md-4">            
      
    </div>
    <div class="col-sm-8 col-md-4">            
      
    </div>
  </div>

<?php

  $sideTabs = array();
  $sideTabs[] = ['id'=> 'tab_one','label'=>'S1 '.Yii::t('app','Requested'),'width'=>'100%','active'=>true];
  $sideTabs[] = ['id'=> 'tab_two','label'=>'S2 '.Yii::t('app','Approval'),'width'=>'100%'];
  if(\Yii::$app->user->identity->email == \Yii::$app->params['egpmail']){
    $sideTabs[] = ['id'=> 'tab_three','label'=> Yii::t('app','Procurement'),'width'=>'100%'];
  }
  else
  {
    $sideTabs[] = ['id'=> 'tab_four','label'=>'S3 '.Yii::t('app','Purchase'),'width'=>'100%']; 
  }

  $sideTabsId['tab_one'] = 'tabrequested';
  $sideTabsId['tab_two'] = 'tabapproval';
  if(\Yii::$app->user->identity->email == \Yii::$app->params['egpmail']){
    $sideTabsId['tab_three'] = 'tabbooked';
  }
  else
  {
     $sideTabsId['tab_four'] = 'tabpurchase';
  }

  echo Tabbar::widget(
    [
      'clientOptions'=>[        
        'parent'      => 'PurchaseOrderTabbar',
        'image_path'  => Yii::$app->AssetManager->getBundle('yiidhtmlx\TabbarAsset')->baseUrl."/dhtmlxTabbar/imgs/",
        'skin'        => "dhx_terrace",
        'mode'        => "top",       
        'tabs' => $sideTabs,
      ],
      'tabs'=> $sideTabsId,
      'options' => [
        'id' => 'PurchaseOrderTabbar'
      ]
    ]
  );
?>
        
<div id="tabrequested" class="dhtmlxTabcontainer">

        <div class="row">
          <div class="col-md-12">              

            <h3><?= Yii::t('app','Saved Requests'); ?></h3>
<?php
  echo Grid::widget(
    [
    'clientOptions'=>[
        'parent'      => 'PurchaseOrderGrid',
        'image_path'  => Yii::$app->AssetManager->getBundle('yiidhtmlx\GridObjectAsset')->baseUrl."/dhtmlxGrid/imgs/",
        'auto_height' => false,
        'auto_width'  => false,
        'smart'       => true,
        'skin'        => "dhx_terrace",       
        'columns' => [
          ['label'=>'id','width'=>'40','type'=>'ro'],          
          ['label'=>[Yii::t('app','status')],'type'=>'ro','width'=>'100'],
          ['label'=>[Yii::t('app','Order ID')],'type'=>'ro','width'=>'100'],
          ['label'=>[Yii::t('app','Request Entity')],'type'=>'ed'],
          ['label'=>[Yii::t('app','Requested By')],'type'=>'ed'],
          ['label'=>[Yii::t('app','Request Date')],'type'=>'ro','width'=>'170'],
          ['label' => [Yii::t('app','Delete')],'type'=>'modaldeletebutton','width'=>'70'],
        ],
      ],
      'enableSmartRendering' => true,
      'options'=>[
        'id'    => 'PurchaseOrderGrid',
        'height' => '250px', 
        'width'  => '100%',               
      ],
      'clientDataOptions'=>[
        'type'=>'json',
        'url'=> $gridURL
      ],
      'clientEvents'=>[
        'onRowDblClicked'=>'doOnRowSelect',
        'onEnter' => 'doOnRowSelect',
      ]   
    ]
  );
?>
    			</div>
        </div>

         <div class="row">
          <div class="col-md-12">              

            <h3><?= Yii::t('app','Pending Requests'); ?></h3>
<?php
  echo Grid::widget(
    [
    'clientOptions'=>[
        'parent'      => 'PurchasePendingOrderGrid',
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
        'id'    => 'PurchasePendingOrderGrid',
        'height' => '250px', 
        'width'  => '100%',               
      ],
      'clientDataOptions'=>[
        'type'=>'json',
        'url'=> $gridWorkflowURLPending
      ] 
    ]
  );
?>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">              

            <h3><?= Yii::t('app','Approved Requests'); ?></h3>
            <p><?= Yii::t('app','Waiting for procurement approval.'); ?></p>
<?php
  echo Grid::widget(
    [
    'clientOptions'=>[
        'parent'      => 'PurchaseOrderWorkflowGridApproved',
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
        ],
      ],
      'enableSmartRendering' => true,
      'options'=>[
        'id'    => 'PurchaseOrderWorkflowGridApproved',
        'height' => '250px', 
        'width'  => '100%',               
      ],
      'clientDataOptions'=>[
        'type'=>'json',
        'url'=> $gridWorkflowURLBooked
      ],
      'clientEvents'=>[
        'onRowSelect'=>'doOnWorkflowRowSelect',
        'onEnter' => 'doOnWorkflowRowSelect',
        'onFilterStart' => 'doOnWorkflowFilterStart'
      ]   
    ]
  );
?>
          </div>
        </div>

</div><!--end of tabrequested/-->

<?= $this->render('tabs/_tab_approval', [
  //none parameters
]); ?>

<?php if(\Yii::$app->user->identity->email == \Yii::$app->params['egpmail']): ?>

<?php
  $gridEGPURL = Html::url(['/purchase/default/dhtmlxgridegp','un'=> date('Ymd')]);  
?>

<div id="tabbooked" class="dhtmlxTabcontainer">

  <div class="row">
    <div class="col-md-12">

      <h3><?= Yii::t('app','Needs to be approved by EGP'); ?>...</h3>
<?php
  echo Grid::widget(
    [
    'clientOptions'=>[
        'parent'      => 'PurchaseOrderBookedWorkflowGrid',
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
          ['label'=>[Yii::t('app','Lines')],'type'=>'ro','width'=>'50'],
          ['label'=>[Yii::t('app','Approved')],'type'=>'ro','width'=>'50'],
          ['label'=>[Yii::t('app','Rejected')],'type'=>'ro','width'=>'50'],
          ['label'=>[Yii::t('app','Purchased')],'type'=>'ro','width'=>'50'],
        ],
      ],
      'enableSmartRendering' => true,
      'options'=>[
        'id'    => 'PurchaseOrderBookedWorkflowGrid',
        'height' => '500px', 
        'width'  => '100%',               
      ],
      'clientDataOptions'=>[
        'type'=>'json',
        'url'=> $gridEGPURL
      ],
      'clientEvents'=>[
        'onRowDblClicked'=>'doOnWorkflowBookedRowSelect',
        'onEnter' => 'doOnWorkflowBookedRowSelect'        
      ]   
    ]
  );
?>
    </div>
  </div>

</div><!--end of tabbooked/-->
<?php else: ?>

<?= $this->render('tabs/_tab_purchase', [
  //none parameters
]); ?>

<?php endif; ?>

</div>
