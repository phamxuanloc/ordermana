<?php
namespace app\components;

use app\models\Category;
use app\models\Product;
use app\models\User;
use Yii;
use yii\console\Application;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

class Model extends ActiveRecord {

	/**@var User */
	public $user;

	const ROLE       = [
		1 => 'Admin',
		'Đại diện',
		'Đại lí bán buôn',
		'Đại lí bán lẻ',
		'Điểm phân phối',
	];

	const ROLE_ADMIN = 1;

	const ROLE_PRE   = 2;

	const ROLE_BIGA  = 3;

	const ROLE_A     = 4;

	const ROLE_D     = 5;

	/**
	 *  * Khởi tạo người dùng đã đăng nhập
	 */
	/**
	 * {@inheritDoc}
	 */
	public function __construct($config = []) {
		parent::__construct($config);
		if(!\Yii::$app instanceof Application) {
			$this->user = \Yii::$app->user->identity;
		}
	}

	public function uploadPicture($picture = '', $attribute) {
		// get the uploaded file instance. for multiple file uploads
		// the following data will return an array (you may need to use
		// getInstances method)
		$img = UploadedFile::getInstance($this, $attribute);
		// if no image was uploaded abort the upload
		if(empty($img)) {
			return false;
		}
		// generate a unique file name
		$dir = Yii::getAlias('@app/web') . '/uploads/' . $this->tableName() . '/';
		if(!is_dir($dir)) {
			@mkdir($dir, 0777, true);
		}
		$ext            = $img->getExtension();
		$this->$picture = $this->getPrimaryKey() . '_' . "$picture" . ".{$ext}";
		// the uploaded image instance
		return $img;
	}

	public function getPictureUrl($picture = '') {
		Yii::$app->params['uploadUrl'] = Yii::$app->urlManager->baseUrl . '/uploads/' . $this->tableName() . '/';
		$image                         = !empty($this->$picture) ? $this->$picture : Yii::$app->urlManager->baseUrl . '/uploads/no_image_thumb.gif';
		clearstatcache();
		if(is_file(Yii::getAlias("@app/web") . '/uploads/' . $this->tableName() . '/' . $image)) {
			return Yii::$app->params['uploadUrl'] . $image;
		} else {
			return $image;
		}
	}

	public function getPictureFile($picture = '') {
		$dir = Yii::getAlias('@app/web') . '/uploads/' . $this->tableName() . '/';
		return isset($this->$picture) ? $dir . $this->$picture : null;
	}

	public static function getCategoryOrder() {
		$cats     = Category::find()->where([
			'parent_id' => 0,
			'status'    => 1,
		])->all();
		$response = [];
		foreach($cats as $cat) {
			$response[$cat->id] = $cat->name;
			$children           = $cat->find()->where([
				'parent_id' => $cat->id,
				'status'    => 1,
			])->all();
			if(count($children) > 0) {
				$response = self::getChildrenCat($children, $response, 1);
			}
		}
		return $response;
	}

	public function getChildrenCat($models, $response, $level) {
		$prefix = '';
		for($i = 0; $i < $level; $i ++) {
			$prefix .= "-";
		}
		foreach($models as $model) {
			$response[$model->id] = $prefix . $model->name;
			$children             = $model->find()->where([
				'parent_id' => $model->id,
				'status'    => 1,
			])->all();
			if(count($children) > 0) {
				$response = self::getChildrenCat($children, $response, $level + 1);
			}
		}
		return $response;
	}

	public function getPrice($role, $id) {
		$product = Product::findOne($id);
		if($role == self::ROLE_ADMIN) {
			$price = $product->base_price;
		} elseif($role == self::ROLE_PRE) {
			$price = $product->representative_sale;
		} elseif($role == self::ROLE_BIGA) {
			$price = $product->big_agent_sale;
		} elseif($role == self::ROLE_A) {
			$price = $product->agent_sale;
		} elseif($role == self::ROLE_D) {
			$price = $product->distribute_sale;
		} else {
			$price = $product->retail_sale;
		}
		return $price;
	}
	/**
	 * @param       $parent_id
	 * @param array $array_children
	 *Trả về tổng số tuyến dưới
	 *
	 * @return array
	 */
	public function getTotalChildren($parent_id, $array_children = []) {
		$tree = $this->getTotal($parent_id);
		if(count($tree) > 0 && is_array($tree)) {
			$array_children = ArrayHelper::merge($array_children, $tree);
		}
		foreach($tree as $item => $id) {
			$array_children = $this->getTotalChildren($id, $array_children);
		}
		return $array_children;
	}

	/**
	 * @param $id
	 *
	 * @return array
	 */
	public function getTotal($id) {
		/**@var self[] $lv1s */
		$array_children = [];
		$lv1s           = User::find()->where([
			'parent_id' => $id,
		])->all();
		foreach($lv1s as $lv1) {
			$array_children[] = $lv1->id;
		}
		return $array_children;
	}
}