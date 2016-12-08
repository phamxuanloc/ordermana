<?php
/**
 * Created by Navatech.
 * @project ordermana
 * @author  LocPX
 * @email   loc.xuanphama1t1[at]gmail.com
 * @date    12/7/2016
 * @time    11:30 PM
 */
namespace app\components;
class ModelTrail extends Model {

	public function behaviors() {
		return [
			'bedezign\yii2\audit\AuditTrailBehavior',
		];
	}
}