<?php

namespace app\modules\tags\controllers;

use yii\web\Controller; 
use yii\db\Query;
use yii\helpers\Json;

class DefaultController extends Controller
{
	public function actionIndex()
	{
		return $this->render('index');
	}

  /**
   * Will return a JSON array of the matching tags, that may have a content passed over as search
   * @param  [type] $search Text for the lookuk
   * @return [type]         [description]
   */
  public function actionJsonlist($search = NULL)
  {
    header('Content-type: application/json');

    $query = new Query;
    if(!is_Null($search))
    {
      $mainQuery = $query->select('name AS id, name AS text')->distinct()
        ->from('tbl_tag')
        ->where('UPPER(name) LIKE "%'.strtoupper($search).'%"')
        ->limit(10);

      $command = $mainQuery->createCommand();
      $rows = $command->queryAll();
      $clean['results'] = array_values($rows);
    }
    $clean['results'][] = ['id'=>$search,'text'=>$search];
    echo Json::encode($clean);
    exit();
  }

}
