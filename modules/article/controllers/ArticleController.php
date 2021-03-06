<?php

namespace app\modules\article\controllers;

use app\modules\article\models\Article;
use app\modules\article\models\ArticleSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\VerbFilter;

/**
 * ArticleController implements the CRUD actions for Article model.
 */
class ArticleController extends Controller
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
			'AccessControl' => [
				'class' => '\yii\web\AccessControl',
				'rules' => [
					[
						'allow'=>true,
						'actions'=>['importer'],
						'roles'=>['?'],
					],
					array(
						'allow'=>true,
						'actions'=>array('update','create','index','view','delete'),
				    'roles'=>array('@'),
					)
				]
			],
			'disableCSRF' => [
        // required to disable csrf validation on OpenID requests
        'class' => \app\behaviours\CSRFdisableBehaviour::className(),
        'only' => array('importer'),
      ],
		];
	}

	/**
	 * Lists all Article models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$searchModel = new ArticleSearch;
		$dataProvider = $searchModel->search($_GET);

		return $this->render('index', [
			'dataProvider' => $dataProvider,
			'searchModel' => $searchModel,
		]);
	}

	/**
	 * Displays a single Article model.
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
	 * Creates a new Article model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{
		$model = new Article;

		if ($model->load($_POST) && $model->save()) {
			return $this->redirect(['view', 'id' => $model->id]);
		} else {
			return $this->render('create', [
				'model' => $model,
			]);
		}
	}

	/**
	 * Updates an existing Article model.
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
	 * Deletes an existing Article model.
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
	 * Finds the Article model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return Article the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if (($model = Article::find($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}

	/**
	 * [actionImporter description]
	 * @return [type] [description]
	 */
	public function actionImporter(){
		$model = $this->checkExisting($_POST['Article']['system_name'],$_POST['Article']['system_key']);
		$model->load($_POST);
		$model->countryCode = \app\modules\parties\models\Country::getCountryIdByCode($model->countryCode);
		$model->save();
		exit();
	}

	/**
	 * checks if a record already exists so it will be updated
	 * @param  [type] $system_name [description]
	 * @param  [type] $system_key  [description]
	 * @return [type]              [description]
	 */
	private function checkExisting($system_name,$system_key)
	{
		$testModel = Article::find()->where(['system_name' => $system_name, 'system_key' => $system_key])->One();
		if(is_object($testModel))
		{
			return $testModel;
		}
		$model = new Article;
		return $model;	
	}
}
