<?php
/**
 * Created by PhpStorm.
 * User: Yamon-PC
 * Date: 28-Dec-16
 * Time: 12:01 PM
 */
namespace app\models;

use app\components\Form;

class ReportForm extends Form {

	public $start_date;

	public $end_date;

	public function rules() {
		return [
			[
				[
					'start_date',
					'end_date',
				],
				'safe',
			],
			[
				'start_date',
				'required',
			],
		];
	}
}