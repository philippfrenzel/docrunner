<?php

namespace app\modules\purchase\models;

use app\modules\parties\models\Contact;

use \DateTime;

/**
 * This is the model class for table "tbl_purchaseordergroup".
 *
 * @property integer $id
 * @property integer $contact_id
 * @property integer $purchaseorder_id
 * @property integer $creator_id
 * @property integer $time_deleted
 * @property integer $time_create
 *
 * @property Contact $contact
 * @property Purchaseorder $purchaseorder
 * @property Purchaseorderline[] $purchaseorderlines
 */
class PurchaseOrderGroup extends \yii\db\ActiveRecord
{

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'tbl_purchaseordergroup';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['contact_id', 'purchaseorder_id'], 'required'],
			[['contact_id', 'purchaseorder_id', 'creator_id', 'time_deleted', 'time_create'], 'integer'],
      [['status'], 'string', 'max' => 200],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'contact_id' => \Yii::t('Contact ID'),
			'purchaseorder_id' => \Yii::t('Purchaseorder ID'),
			'creator_id' => \Yii::t('Creator ID'),
			'time_deleted' => \Yii::t('Time Deleted'),
			'time_create' => \Yii::t('Time Create'),
		];
	}

	/**
	 * @return \yii\db\ActiveRelation
	 */
	public function getContact()
	{
		return $this->hasOne(Contact::className(), ['id' => 'contact_id']);
	}

	/**
	 * @return \yii\db\ActiveRelation
	 */
	public function getPurchaseorder()
	{
		return $this->hasOne(PurchaseOrder::className(), ['id' => 'purchaseorder_id']);
	}

	/**
	 * @return \yii\db\ActiveRelation
	 */
	public function getPurchaseorderlines()
	{
		return $this->hasMany(PurchaseOrderLine::className(), ['purchaseordergroup_id' => 'id']);
	}

	/**
	 * [beforeSave description]
	 * @param  [type] $insert [description]
	 * @return [type]         [description]
	 */
	public function beforeSave($insert)
  {
    $date = new DateTime('now');
    if($this->isNewRecord)
    {
      if(\Yii::$app->user->isGuest)
      {
        $this->creator_id = 0; //external system writer
      }
      else
      {
        $this->creator_id = \Yii::$app->user->identity->id;
      }      
    }
    if(is_null($this->time_create))
    {
      $this->time_create = $date->format("U");
    }
    return parent::beforeSave($insert);
  }
}
