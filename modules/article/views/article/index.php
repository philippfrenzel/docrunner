<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\modules\article\models\ArticleSearch $searchModel
 */

$this->title = 'Articles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-index">

	<h1><?= Html::encode($this->title) ?></h1>

	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<p>
		<?= Html::a('Create Article', ['create'], ['class' => 'btn btn-success']) ?>
	</p>

	<?php echo GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],

			'id',
			'article',
			'article_number',
			'status',
			'system_key',
			// 'system_name',
			// 'system_upate',
			// 'creator_id',
			// 'time_deleted:datetime',
			// 'time_create:datetime',

			['class' => 'yii\grid\ActionColumn'],
		],
	]); ?>

</div>
