<?php
namespace app\modules\pages\widgets;

use Yii;
use yii\helpers\Html;
use yii\data\ActiveDataProvider;

use app\modules\pages\models\Page;

class PortletSinglePage extends Portlet
{
	public $title='Content';
	
	/**
	 * here we set the id of the current page, to which we will fetch all children
	 * @var integer the pk of the currently displayed record
	 */
	public $id = 1;

	/**
	 * here we set the model, which will be viewed inside the single page portlet
	 * @var object the model containing the page record
	 */
	private $_model;

	/**
	 * @var string the CSS class for the portlet title tag. Defaults to 'portlet-title'.
	 */
	public $titleCssClass='fg-color-white bg-color-orangepic smallspace';

	public $contentCssClass='fg-color-white footer-box';

	public $htmlOptions=array();

	public function init() {		
		$this->_model = Page::find($this->id);
		if(!is_null($this->_model)){
			$this->title = $this->_model->title;
			$this->adminActions[] = array(
					'action'=>Html::url(array('/pages/page/onlineview','id'=>$this->_model->id)),
					'content'=>"<i class='icon icon-eye-open icon-1x tipster' title='anzeigen'> </i>"
			);
			$this->adminActions[] = array(
					'action'=>Html::url(array('/pages/page/update','id'=>$this->_model->id)),
					'content'=>"<i class='icon icon-pencil icon-1x tipster' title='bearbeiten'> </i>"
			);
		}
		parent::init();
	}

	protected function renderContent()
	{
 		//here we don't return the view, here we just echo it!
		echo $this->render('@app/modules/pages/widgets/views/_page',array('model'=>$this->_model));
	}

	/**
	 * Renders the decoration for the portlet.
	 * The default implementation will render the title if it is set.
	 */
	protected function renderDecoration()
	{
		if($this->title!==null)
		{
			$this->title = Yii::t('app',$this->title);
			echo "<h3 class=\"{$this->titleCssClass}\"><i class='icon-star-empty'></i> {$this->title}</h3>\n";
		}
	}
}