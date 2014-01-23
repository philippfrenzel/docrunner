<?php

namespace app\modules\purchase\controllers;

use app\modules\purchase\models\PurchaseOrderGroup;
use app\modules\purchase\models\PurchaseOrderLine;
use app\modules\purchase\models\PurchaseOrderGroupSearch;
use app\modules\workflow\models\Workflow;
use app\modules\parties\models\Contact;

use app\controllers\AppController;
use yii\web\NotFoundHttpException;
use yii\web\VerbFilter;

/**
 * PurchaseOrderGroupController implements the CRUD actions for PurchaseOrderGroup model.
 */
class PurchaseOrderGroupController extends AppController
{
	public function behaviors()
	{
		return [
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'delete' => ['post'],
				],
			],
		];
	}

	/**
	 * Lists all PurchaseOrderGroup models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$searchModel = new PurchaseOrderGroupSearch;
		$dataProvider = $searchModel->search($_GET);

		return $this->render('index', [
			'dataProvider' => $dataProvider,
			'searchModel' => $searchModel,
		]);
	}

	/**
	 * Displays a single PurchaseOrderGroup model.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionView($id)
	{
		return $this->render('view', [
			'model' => $this->findModel($id),
		]);
	}

	/**
	 * Creates a new PurchaseOrderGroup model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{
		$model = new PurchaseOrderGroup;

		if ($model->load($_POST) && $model->save()) {
			return $this->redirect(['view', 'id' => $model->id]);
		} else {
			return $this->render('create', [
				'model' => $model,
			]);
		}
	}

	/**
	 * Updates an existing PurchaseOrderGroup model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionUpdate($id)
	{
		$model = $this->findModel($id);

		if ($model->load($_POST) && $model->save()) {
			return $this->redirect(['view', 'id' => $model->id]);
		} else {
			return $this->render('update', [
				'model' => $model,
			]);
		}
	}

	/**
   * [actionWindow description]
   * @param  [type] $id  [description]
   * @param  [type] $win [description]
   * @return [type]      [description]
   */
  public function actionWindow($win, $id=NULL)
  {
    $message = NULL;
    $winparams = explode('_',$win);
    $modelClassName = '\\app\\modules\\purchase\\models\\'.ucfirst($winparams[0]);
    $model = new $modelClassName;

    if($winparams[1]=='submit' || $winparams[1]=='purchasesubmit')
    {
      $model = $model->find($id);
    }

    $showform = 'windows/_'.$winparams[1];

    return $this->renderPartial('windows/base_window',[
        'model' => $model,
        'showform' => $showform
    ]);
  }

	/**
	 * [actionSubmit description]
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function actionSubmit($id)
	{
		$model = $this->findModel($id);
		$userContact = Contact::find()->where(['email' => \Yii::$app->params->egpmail])->one();
    $workflow = Workflow::addRecordIntoWorkflow(Workflow::MODULE_PURCHASE,$model->id,Workflow::STATUS_BOOKED,$userContact->id);
    $model->status = Workflow::STATUS_BOOKED;
    $model->save();

    $OrderLines = PurchaseOrderLine::find()->where(['purchaseordergroup_id'=>$model->id])->all();
    foreach($OrderLines AS $OrderLine)
    {
      $OrderLine->status = $OrderLine->status=="accepted"?Workflow::STATUS_BOOKED:Workflow::STATUS_REJECTED;
      $OrderLine->save();
    }

		return $this->redirect(['/site/index']);
	}

  /**
   * This function will submit the purchase request and allow the user to print out the approved items as purchase order
   * it is going to set the group status to purchased
   * @param  INTERGER $id Primary Key of the PurchaseOrderGroup
   * @return HTML     [description]
   */
  public function actionPurchasesubmit($id)
  {
    $model = $this->findModel($id);
    $workflow = Workflow::addRecordIntoWorkflow(Workflow::MODULE_PURCHASE,$model->id,Workflow::STATUS_PURCHASED,$model->contact_id);
    $model->status = Workflow::STATUS_PURCHASED;
    $model->save();
    return $this->redirect(['/site/index']);
  }

	/**
	 * Deletes an existing PurchaseOrderGroup model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionDelete($id)
	{
		$this->findModel($id)->delete();
		return $this->redirect(['index']);
	}

	/**
	 * Finds the PurchaseOrderGroup model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return PurchaseOrderGroup the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if (($model = PurchaseOrderGroup::find($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}

  /**
   * [actionPurchase description]
   * @param  [type] $id [description]
   * @return [type]     [description]
   */
  public function actionPurchase($id)
  {
    //change layout
    $this->layout = '/main';
    $model = $this->findModel($id);
    return $this->render('@app/modules/purchase/views/purchase-order/purchase', [
      'model' => $model,
    ]);
  }
  
}
