<?php
namespace app\models;

use app\components\Model;
use Yii;

/**
 * This is the model class for table "alert".
 *
 * @property integer $id
 * @property string  $content
 * @property integer $role_id
 * @property string  $created_date
 */
class Alert extends Model {

	/**
	 * @inheritdoc
	 */
	public static function tableName() {
		return 'alert';
	}

	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [
			[
				['content'],
				'required',
			],
			[
				['role_id'],
				'integer',
			],
			[
				['created_date'],
				'safe',
			],
			[
				['content'],
				'string',
				'max' => 255,
			],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return [
			'id'           => 'ID',
			'content'      => 'Nội dung',
			'role_id'      => 'Gửi tới',
			'created_date' => 'Ngày tạo',
		];
	}
}
