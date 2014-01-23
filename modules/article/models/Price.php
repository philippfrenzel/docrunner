<?php

namespace app\modules\article\models;

/**
 * This is the model class for table "tbl_price".
 *
 * @property integer $id
 * @property integer $article_id
 * @property double $price
 * @property string $status
 * @property integer $creator_id
 * @property integer $time_deleted
 * @property integer $time_create
 * @property integer $party_id
 *
 * @property Article $article
 */
class Price extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'tbl_price';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['article_id', 'creator_id'], 'required'],
			[['article_id', 'creator_id', 'time_deleted', 'time_create', 'party_id'], 'integer'],
			[['price'], 'number'],
			[['status'], 'string', 'max' => 255]
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'article_id' => 'Article ID',
			'price' => 'Price',
			'status' => 'Status',
			'creator_id' => 'Creator ID',
			'time_deleted' => 'Time Deleted',
			'time_create' => 'Time Create',
			'party_id' => 'Party ID',
		];
	}

	/**
	 * @return \yii\db\ActiveRelation
	 */
	public function getArticle()
	{
		return $this->hasOne(Article::className(), ['id' => 'article_id']);
	}
}
