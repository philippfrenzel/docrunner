<?php

namespace app\modules\dms\controllers;

use app\modules\dms\models\Dmsys;
use yii\web\Controller;
use yii\web\VerbFilter;

use yii\helpers\Json;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

use \phpthumb;


class DefaultController extends Controller
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
            'actions'=>array('index','form','attachfile','downloadattachement','window','delete','getthumb'),
            'roles'=>array('@'),
          ]
        ]
      ]
    ];
  } 	

  public function actionIndex()
	{
		return $this->render('index');
	}

  public function actionForm()
  {
      $model = new Dmsys;

      if ($model->load($_POST)) {
          $model->attachement=UploadedFile::getInstance($model,'attachement');
          if ($model->validate()) {
              // form inputs are valid, do something here
              return;
          }
      }
      return $this->render('_form', [
          'model' => $model,
      ]);
  }

  /**
   * Will create and attach a new file to the related model
   * @return [type] [description]
   */
  public function actionAttachfile(){
    $model = new Dmsys;
    if($model->load($_POST)) {
        $model->fileattachement=UploadedFile::getInstance($model,'fileattachement');
        if ($model->validate()) {
            $model->filename = $model->fileattachement->name;
            $model->filetype = $model->fileattachement->type;
            $model->used_space = $model->getReadableFileSize($model->fileattachement->size);
            
            //create dir if not exists
            $FHelper = new FileHelper;
            $FHelper->createDirectory(\Yii::$app->basePath."/attachements/".$model->dms_module);

            if($model->save() && $model->fileattachement->saveAs(\Yii::$app->basePath."/attachements/".$model->dms_module."/".$model->id))
            {
              //generate the preview of the uploaded file
              $thumbler = new phpthumb();
              $thumbler->setSourceData(file_get_contents(\Yii::$app->basePath."/attachements/".$model->dms_module."/".$model->id));
              $thumbler->setParameter('w', '150');
              
              $output_filename = \Yii::$app->basePath."/attachements/".$model->dms_module."/".$model->id."_thumb_sm.jpg";
              if ($thumbler->GenerateThumbnail()) { // this line is VERY important, do not remove it!
                  if ($thumbler->RenderToFile($output_filename)) {
                          // do something on success
                          //echo 'Successfully rendered to "'.$output_filename.'"';
                  } else {
                          // do something with debug/error messages
                          echo 'Failed:<pre>'.implode("\n\n", $thumbler->debugmessages).'</pre>';                          
                  }
                  $thumbler->purgeTempFiles();
              }
              return $this->redirect([$model::getModuleAsController($model->dms_module), 'id' => $model->dms_id]);
            }
            else
            {
              echo "upload failed";
            }
        }
        exit;
    }
    return $this->render('_form', [
        'model' => $model,
    ]);
  }

  /**
   * As files are not accessible directly, they can only be viewd by allowed users, so this will forward it...
   * @param  [type] $id [description]
   * @return [type]     [description]
   */
  public function actionDownloadattachement($id){
    $model = Dmsys::find($id);

    // open the file in a binary mode
    $name = \Yii::$app->basePath."/attachements/".$model->dms_module."/".$model->id;
    $fp = fopen($name, 'rb');

    // send the right headers
    header("Content-Type: ".$model->filetype);
    header("Content-Length: " . filesize($name));

    // dump the picture and stop the script
    fpassthru($fp);
    exit;
  }

  /**
   * [actionGetthumb description]
   * @param  [type] $id   [description]
   * @param  string $size can be sm for small or lg for large
   * @return [type]       [description]
   */
  public function actionGetthumb($id,$size='sm'){
    $model = Dmsys::find($id);

    // open the file in a binary mode
    $name = \Yii::$app->basePath."/attachements/".$model->dms_module."/".$model->id."_thumb_".$size.".jpg";
    $fp = fopen($name, 'rb');

    // send the right headers
    header("Content-Type: ".$model->filetype);
    header("Content-Length: " . filesize($name));

    // dump the picture and stop the script
    fpassthru($fp);
    exit;
  }

  /**
   * This will create a new Form, based upon the passed parameters.
   * Inside base window, we only have the "light" version of the needed stuff
   * @param  [type] $id  [description]
   * @param  [type] $win [description]
   * @return [type]      [description]
   */
  public function actionWindow($win, $id=NULL,  $mainid=NULL)
  {
    $winparams = explode('_',$win);
    $modelClassName = '\\app\\modules\\dms\\models\\'.ucfirst($winparams[0]);
    $model = new $modelClassName;

    if ($model->load($_POST) && $model->save()) {
      return $this->redirect(['view', 'id' => $mainid]);
    } 
    else 
    {
      $showform = 'windows/_'.$winparams[1];
      return $this->renderPartial('windows/base_window',[
          'model' => $model,
          'showform' => $showform
      ]);
    }
  }

}
