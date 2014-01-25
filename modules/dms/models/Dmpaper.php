<?php

namespace app\modules\dms\models;

use \DateTime;
use app\modules\tags\models\Tag;
use app\modules\parties\models\Contact;
use app\modules\comments\models\Comment;

use yii\helpers\Html;

/**
 * This is the model class for table "tbl_dmpaper".
 *
 * @property integer $id
 * @property integer $party_id
 * @property string $description
 * @property string $name
 * @property string $tags
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

  public $recipients = NULL;

	/**
	 * storing the old tags into this variable
	 * @var [type]
	 */
	private $_oldTags;
  private $_oldRecipients;

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['party_id', 'creator_id', 'time_deleted', 'time_create'], 'integer'],
			[['description'], 'string'],
			//[['creator_id'], 'required'], not requiered as it will be filled automatically before save
			[['name', 'status'], 'string', 'max' => 255],
			['tags', 'match', 'pattern'=>'/^[\w\s,]+$/', 'message'=>'Tags can only contain word characters.'],
			['tags', 'normalizeTags'],
      ['recipients', 'normalizeRecipients'],
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
			'tags'         => \Yii::t('app','Tags'),
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

  /**
   * everything that has todo with the tags to this paper
   */
  
  /**
	 * @return array a list of links that point to the post list filtered by every tag of this post
	 */
	public function getTagLinks()
	{
		$links=array();
		foreach(Tag::string2array($this->tags) as $tag)
			$links[]=Html::a(Html::encode($tag), array('post/index', 'tag'=>$tag), array('class'=>'label'));
		return $links;
	}

  /**
   * @return array a list of links that point to the post list filtered by every tag of this post
   */
  public function getTagLabels()
  {
    $labels=array();
    foreach(Tag::string2array($this->tags) as $tag)
      $labels[] = Html::tag('div', Html::encode($tag),['class'=>'label label-info']);
    return $labels;
  }

	/**
	 * Normalizes the user-entered tags.
	 */
	public function normalizeTags($attribute,$params)
	{
		$this->tags=Tag::array2string(array_unique(Tag::string2array($this->tags)));
	}

  /**
   * Normalizes the user-entered recipients.
   */
  public function normalizeRecipients($attribute,$params)
  {
    $this->recipients = Contact::array2string(array_unique(Contact::string2array($this->recipients)));
  }

	/**
	 * This is invoked when a record is populated with data from a find() call.
	 */
	public function afterFind()
	{
		parent::afterFind();
		$this->_oldTags=$this->tags;
    $this->_oldRecipients=$this->recipients;
	}

	/**
	 * This is invoked after the record is saved.
	 */
	public function afterSave($insert)
	{
		parent::afterSave($insert);
		Tag::updateFrequency($this->_oldTags, $this->tags);
	}

}
