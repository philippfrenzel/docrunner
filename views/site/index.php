<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 */
$this->title = Yii::t('app','PUREpo - Purchase Request Order System - Home');
?>
<div class="site-index">

	<div class="row">
			<div class="col-lg-4">
				
				<?php
					echo app\modules\pages\widgets\PortletSinglePage::widget(array(
	        		'id'=>1,
	    		));
				?>

			</div>
			<div class="col-lg-8">
				<div class="jumbotron">
					<h1>Welcome!</h1>

					<p class="lead">to purchase request - purchase order</p>

					<p><a class="btn btn-lg btn-success" href="<?php echo Html::Url(array('/user/auth/login')); ?>">Login PUREpo!</a></p>
				</div>
			</div>
	</div>

	<div class="body-content">

	</div>
</div>