<?php
namespace app\components;

use app\models\Category;
use app\models\Customer;
use app\models\Order;
use app\models\Product;
use app\models\User;
use DateInterval;
use DateTime;
use Yii;
use yii\console\Application;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\UploadedFile;

class Model extends ActiveRecord {

	/**@var User $user */
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

	public $start_date;

	public $end_date;

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

	/**
	 *Trả về array người dùng có cùng cấp độ
	 */
	public static function getUserList($role) {
		if($role - Yii::$app->user->identity->role_id == 1) {
			$response = ArrayHelper::map($cats = User::find()->where([
				'id' => Yii::$app->user->id,
			])->all(), 'id', 'username');
		} else {
			$cats     = User::find()->where([
				'parent_id' => Yii::$app->user->id,
			])->all();
			$response = [];
			$response = self::getChildrenLv($cats, $response, $role, Yii::$app->user->identity->role_id + 1);
		}
		return $response;
	}

	public function getChildrenLv($models, $response, $level, $real_lv) {
		foreach($models as $model) {
			if($level == $model->role_id + 1) {
				$response[$model->id] = $model->username;
			} else {
				//				if($model->role_id == $level){
				//					$response[$model->id] = $model->username;
				//				}
				$children = $model->find()->where([
					'parent_id' => $model->id,
				])->all();
				if(count($children) > 0) {
					$response = self::getChildrenLv($children, $response, $level, $real_lv + 1);
				}
			}
		}
		return $response;
	}

	public static function getUserTree() {
		$model = new Model();
		if(Yii::$app->user->identity->role_id == Model::ROLE_ADMIN) {
			$cats = User::find()->where([
				'parent_id' => null,
			])->all();
		} else {
			$cats = User::find()->where([
				'parent_id' => Yii::$app->user->identity->getId(),
			])->all();
		}
		$response = [];
		foreach($cats as $cat) {
			$color    = $model->getColor($cat->role_id);
			$children = $cat->find()->where([
				'parent_id' => $cat->id,
			])->all();
			if(count($children) > 0) {
				$response[] = [
					'text'  => "<span style='color: $color;font-weight: bold;' data-toggle='modal' data-target='#myModal'>$cat->username</span>",
					'url'   => Url::to([
						'/user/admin/profile',
						'id' => $cat->id,
					]),
					'nodes' => self::getChildrenUser($children),
				];
			} else {
				$response[] = [
					'url'  => Url::to([
						'/user/admin/profile',
						'id' => $cat->id,
					]),
					'text' => "<span style='color: $color; font-weight: bold' data-toggle='modal' data-target='#myModal'>$cat->username</span>",
				];
			}
		}
		if(Yii::$app->user->identity->role_id != Model::ROLE_ADMIN) {
			$color    = $model->getColor(Yii::$app->user->identity->role_id);
			$response = [
				ArrayHelper::merge([
					'text' => "<span style='color:$color; font-weight: bold' data-toggle='modal' data-target='#myModal'>" . Yii::$app->user->identity->username . "</span>",
					'url'  => Url::to([
						'/user/admin/profile',
						'id' => Yii::$app->user->id,
					]),
				], ['nodes' => $response]),
			];
		}
		return $response;
	}

	/**
	 * @param $models
	 * @param $response
	 * @param $level
	 *
	 * @return mixed
	 */
	public function getChildrenUser($models) {
		$i        = 0;
		$response = [];
		$data     = new Model();
		foreach($models as $model) {
			$color    = $data->getColor($model->role_id);
			$children = $model->find()->where([
				'parent_id' => $model->id,
			])->all();
			if(count($children) > 0) {
				$response[$i] = [
					'text'  => "<span style='color:$color;font-weight: 800' data-toggle='modal' data-target='#myModal'>" . $model->username . "</span>",
					'url'   => Url::to([
						'/user/admin/profile',
						'id' => $model->id,
					]),
					'nodes' => self::getChildrenUser($children),
				];
			} else {
				$response [$i] = [
					'text' => "<span style='color:$color;font-weight: 800' data-toggle='modal' data-target='#myModal'>" . $model->username . "</span>",
					'url'  => Url::to([
						'/user/admin/profile',
						'id' => $model->id,
					]),
				];
			}
			$i ++;
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

	public function getColor($role) {
		if($role == $this::ROLE_ADMIN) {
			$color = '#F3565D';
		} elseif($role == $this::ROLE_PRE) {
			$color = '#dfba49';
		} elseif($role == $this::ROLE_BIGA) {
			$color = '#5d2d77';
		} elseif($role == $this::ROLE_A) {
			$color = '#428bca';
		} else {
			$color = '#333';
		}
		return $color;
	}

	/**
	 * Hàm trả về mảng người dùng có lv nhỏ hơn lv người dùng hiện tại, lv lớn hơn lv đang tạo
	 */
	public static function getUserLv($role) {
		if($role - Yii::$app->user->identity->role_id == 1) {
			$response = ArrayHelper::map($cats = User::find()->where([
				'id' => Yii::$app->user->id,
			])->all(), 'id', 'username');
		} else {
			$cats     = User::find()->where([
				'parent_id' => Yii::$app->user->id,
			])->andWhere('role_id!=' . Model::ROLE_A)->andWhere('role_id!=' . Model::ROLE_D)->all();
			$response = [Yii::$app->user->id => Yii::$app->user->identity->username];
			$response = self::getChildrenList($cats, $response, $role, Yii::$app->user->identity->role_id);
		}
		return $response;
	}

	public function getChildrenList($models, $response, $level, $real_lv) {
		foreach($models as $model) {
			if($level > $real_lv) {
				$response[$model->id] = $model->username;
				$children             = $model->find()->where([
					'parent_id' => $model->id,
				])->andWhere('role_id!=' . Model::ROLE_A)->andWhere('role_id!=' . Model::ROLE_D)->all();
				if(count($children) > 0) {
					$response = self::getChildrenList($children, $response, $level, $real_lv + 1);
				}
			}
		}
		return $response;
	}

	/**
	 *Hàm trả về mảng khách hàng mà người dùng sở hữu.
	 */
	public function getOwnerCustomer() {
		$customer = [];
		if($this->user->role_id == self::ROLE_ADMIN) {
			foreach(Customer::find()->all() as $cus) {
				$customer[$cus->id] = $cus->name . '-' . $cus->phone;
			}
		} else {
			foreach(Customer::find()->where(['parent_id' => $this->user->id])->andWhere('is_move<2')->all() as $cus) {
				$customer[$cus->id] = $cus->name . '-' . $cus->phone;
			}
		}
		return $customer;
	}

	/**
	 *Hàm trả về mảng các ngày trong tháng hiện tại
	 */
	public function getDay() {
		$oStart = new DateTime(date('Y') . '-' . date('m') . '-1');
		$oEnd   = clone $oStart;
		$oEnd->add(new DateInterval("P1M"));
		$number = array();
		while($oStart->getTimestamp() < $oEnd->getTimestamp()) {
			$number[] = $oStart->format('d');
			$oStart->add(new DateInterval("P1D"));
		}
		return $number;
	}

	public function getPreArray() {
		$array_pres = User::find()->select('user.id,user.username,sum(order.total_amount) AS total')->innerJoinWith('orders', 'user.id=order.parent_id')->asArray()->groupBy('user.id')->orderBy('total DESC')->all();
		$pre        = [];
		foreach($array_pres as $array_pre) {
			$pre[] = [
				$array_pre['username'],
				(int)$array_pre['total'],
			];
		}
		$pre = ArrayHelper::merge([
			[
				'Doanh số bán ra',
				'VNĐ',
			],
		], $pre);
		return $pre;
	}
}