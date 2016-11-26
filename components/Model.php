<?php
namespace app\components;

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

	public function uploadPicture($picture = '') {
		// get the uploaded file instance. for multiple file uploads
		// the following data will return an array (you may need to use
		// getInstances method)
		$img = UploadedFile::getInstance($this, $picture);
		// if no image was uploaded abort the upload
		if(empty($img)) {
			return false;
		}
		// generate a unique file name
		$dir = Yii::getAlias('@app') . '/uploads/' . $this->tableName() . '/';
		if(!is_dir($dir)) {
			@mkdir($dir, 0777, true);
		}
		$ext            = $img->getExtension();
		$this->$picture = $this->getPrimaryKey() . '_image' . ".{$ext}";
		// the uploaded image instance
		return $img;
	}

	public function getPictureUrl($picture = '') {
		Yii::$app->params['uploadUrl'] = Yii::$app->urlManager->baseUrl . '/uploads/' . $this->tableName() . '/';
		$image                         = !empty($this->$picture) ? $this->$picture : Yii::$app->urlManager->baseUrl . '/uploads/no_image_thumb.gif';
		clearstatcache();
		if(is_file(Yii::getAlias("@app") . '/uploads/' . $this->tableName() . '/' . $image)) {
			return Yii::$app->params['uploadUrl'] . $image;
		} else {
			return $image;
		}
	}

	public function getPictureFile($picture = '') {
		$dir = Yii::getAlias('@app') . '/uploads/' . $this->tableName() . '/';
		return isset($this->$picture) ? $dir . $this->$picture : null;
	}

	public function getCategory() {
	}
}