<?php

namespace app\components;

use Yii;
use yii\db\Query;

class User extends \dektrium\user\components\User
{

	public $role = 0;
	
	/**
	 * [getisAdmin description]
	 * @return boolean [description]
	 */
	public function getisAdmin()
	{
		if(Yii::$app->user->role < 2 AND !Yii::$app->user->isGuest){
			return true;
		}
		return false;
	}

	/**
	 * [getisAdvanced description]
	 * @return boolean [description]
	 */
	public function getisAdvanced()
	{
		if(Yii::$app->user->role < 3 AND !Yii::$app->user->isGuest){
			return true;
		}
		return false;
	}

	/**
	 * [getisUser description]
	 * @return boolean [description]
	 */
	public function getisUser()
	{
		if(Yii::$app->user->role < 4 AND !Yii::$app->user->isGuest){
			return true;
		}
		return false;
	}

	/**
	 * [getCurrentEntityId description]
	 * @return integer the primary party key of the user that will log in
	 */
	public function getCurrentEntityId()
	{
		$query = new Query;
		$query->select('tbl_party.id AS id')
			->from('tbl_user')
      ->innerJoin('tbl_contact', 'tbl_contact.email = tbl_user.email')
      ->innerJoin('tbl_party','tbl_party.id = tbl_contact.party_id')
			->where('tbl_user.id = '.\Yii::$app->user->identity->id)
			->one();
		
		$command = $query->createCommand();
		$row = $command->queryOne();

		if(!is_null($row['id']))
		{
			return $row['id'];
		}
		return NULL;
	}

	/**
	 * [getCurrentContactId description]
	 * @return integer the primary contact key of the user that will log in
	 */
	public function getCurrentContactId()
	{
		$query = new Query;
		$query->select('tbl_contact.id AS id')
			->from('tbl_user')
      ->innerJoin('tbl_contact', 'tbl_contact.email = tbl_user.email')
      ->where('tbl_user.id = '.\Yii::$app->user->identity->id)
			->one();
		
		$command = $query->createCommand();
		$row = $command->queryOne();

		if(!is_null($row['id']))
		{
			return $row['id'];
		}
		return NULL;
	}
}
