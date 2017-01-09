<?php
/**
 * Created by PhpStorm.
 * User: Yamon-PC
 * Date: 09-Jan-17
 * Time: 1:47 PM
 */
use yii\helpers\Html;

$this->title                   = 'Danh sách thông báo';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>

<?php foreach($models as $model) { ?>
	<div>
		<a href="<?= $model->url ?>">
			<span class="details" style="float: left; margin: 10px 15px;background-color: <?= $model->status == $model::NOT_SEEN ? '#f3d8d8' : '#fff' ?>">
				<span class="label label-sm label-icon label-success">
					<i class="fa fa-plus"></i>
				</span>
				<?= $model->content ?>
			</span>
			<span class="time" style="float: left; margin: 10px 15px;"><?= $model::STATUS[$model->status] ?></span>

		</a>
	</div>
<?php } ?>
<div style="float: left; clear: both">
	<?php
	echo \yii\widgets\LinkPager::widget([
		'pagination' => $pagination,
	]);
	?>
</div>
