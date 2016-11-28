<?php
namespace app\components;

use app\models\Category;
use app\models\User;
use Yii;
use yii\console\Application;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;

class Model extends ActiveRecord {

	/**@var User */
	public $user;

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

	public function uploadPicture($picture = '',$attribute) {
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
		$this->$picture = $this->getPrimaryKey() . '_'."$picture" . ".{$ext}";
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
}