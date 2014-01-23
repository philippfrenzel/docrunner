<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;


class AppController extends Controller
{

  /**
   * [init description]
   * @return [type] [description]
   */
  public function init()
  {
    parent::init();

    if (isset($_POST['_lang']))
    {
        Yii::$app->language = $_POST['_lang'];
        Yii::$app->session['_lang'] = Yii::$app->language;
    }
    else if (isset(Yii::$app->session['_lang']))
    {
        Yii::$app->language = Yii::$app->session['_lang'];
    } 
  }

}
