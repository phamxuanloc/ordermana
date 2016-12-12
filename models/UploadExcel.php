<?php
/**
 * @project PhpStorm
 * @created Navatech.
 * @author  LocPX
 * @email loc.xuanphama1t1@gmail.com
 * @date    12/05/2016
 * @time    2:48 CH
 */
namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;

class UploadExcel extends ActiveRecord {

	/**
	 * @var UploadedFile
	 */
	public $excel;

	public function rules() {
		return [
			[
				['excel'],
				'file',
				'skipOnEmpty' => true,
				'extensions'  => 'xlsx',
			],
			[
				['excel'],
				'required',
			],
		];
	}

	function rand_string($length) {
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$size  = strlen($chars);
		$str   = substr(str_shuffle($chars), 0, $length);
		for($i = 0; $i < $length; $i ++) {
			$str .= $chars[rand(0, $size - 1)];
		}
		return $str;
	}

	public function uploadExcel() {
		$dir = Yii::getAlias('@app/web') . '/uploads/' . 'excel' . '/';
		if(!is_dir($dir)) {
			@mkdir($dir, 0777, true);
		}
		if($this->excel !== null) {
			$name = $this->rand_string(5);
			$path = Yii::getAlias('@app/web') . '/uploads/' . 'excel' . '/' . $name . '.' . $this->excel->getExtension();
			$this->excel->saveAs($path);
			return 'uploads/' . 'excel' . '/' . $name . '.' . $this->excel->getExtension();
		} else {
			return null;
		}
	}

	public function attributeLabels() {
		return [
			'excel' => 'File import',
		];
	}
}