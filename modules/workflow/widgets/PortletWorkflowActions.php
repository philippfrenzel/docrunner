<?php
namespace app\modules\workflow\widgets;

use yii\helpers\Html;
use app\modules\workflow\models\Workflow;

class PortletWorkflowActions extends Portlet
{

	public $title=NULL;
	public $id = NULL;

	//disable the admin panel
	public $enableAdmin = false;

	public $contentCssClass='panel-body bg-color-actions';

	public function init() {
		parent::init();
	}

	protected function renderContent()
	{
		$model = Workflow::find($this->id);
		//here we don't return the view, here we just echo it!
		echo $this->render('@app/modules/workflow/widgets/views/_workflowactions',array('model'=>$model));
	}
}