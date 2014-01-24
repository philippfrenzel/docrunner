<?php

namespace app\modules\dms\models;

/**
 * This is the model class for table "tbl_dmpaper".
 *
 * @property integer $id
 * @property integer $party_id
 * @property string $description
 * @property string $name
 * @property string $status
 * @property integer $creator_id
 * @property integer $time_deleted
 * @property integer $time_create
 *
 * @property Party $party
 */
class Dmpaper extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'tbl_dmpaper';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['party_id', 'creator_id', 'time_deleted', 'time_create'], 'integer'],
			[['description'], 'string'],
			[['creator_id'], 'required'],
			[['name', 'status'], 'string', 'max' => 255]
		];
	}

	/**
	 * @inheritdoc
	 * @todo translate the labels so they will look correct
	 */
	public function attributeLabels()
	{
		return [
			'id'           => \Yii::t('app','ID'),
			'party_id'     => \Yii::t('app','Document Supplier'),
			'description'  => \Yii::t('app','Description'),
			'name'         => \Yii::t('app','Name'),
			'status'       => \Yii::t('app','Status'),
			'creator_id'   => \Yii::t('app','Creator ID'),
			'time_deleted' => \Yii::t('app','Time Deleted'),
			'time_create'  => \Yii::t('app','Time Create'),
		];
	}

	/**
	 * This will return the party from whom the document was send in
	 * @return \yii\db\ActiveRelation
	 */
	public function getParty()
	{
		return $this->hasOne(Party::className(), ['id' => 'party_id']);
	}
}
