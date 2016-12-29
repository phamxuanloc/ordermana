<?php
/**
 * Created by PhpStorm.
 * User: Yamon-PC
 * Date: 28-Dec-16
 * Time: 12:01 PM
 */
namespace app\models;

use app\components\Form;
use app\components\Model;
use DateInterval;
use DateTime;

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
				'end_date',
				'compare',
				'compareAttribute' => 'start_date',
				'operator'         => '>=',
				'message'          => 'Start Date must be less than End Date',
			],
			[
				'start_date',
				'required',
			],
		];
	}

	public function getProfitChart($params) {
		$number = array();
		$this->load($params);
		if($this->start_date != null) {
			if($this->end_date != null) {
				$oStart = new DateTime($this->start_date);
				$oEnd   = new DateTime($this->end_date);
			} else {
				$oStart = new DateTime($this->start_date);
				$oEnd   = new DateTime(date('Y-m-d'));
			}
		} else {
			$oStart = new DateTime(date('Y-m-d', strtotime('monday this week')));
			$oEnd   = new DateTime(date('Y-m-d', strtotime('sunday this week')));
		}
		while($oStart->getTimestamp() <= $oEnd->getTimestamp()) {
			$value    = Order::find();
			$customer = OrderCustomer::find();
			if($this->user->role_id == Model::ROLE_ADMIN) {
				$value->joinWith('parent');
				$value->andFilterWhere(['user.role_id' => Model::ROLE_ADMIN])->andFilterWhere([
					'between',
					'created_date',
					$oStart->format('Y-m-d') . ' 00:00:00',
					$oStart->format('Y-m-d') . ' 23:59:59',
				]);
				$order = $value->sum('total_amount');
				$customer->joinWith('users');
				$customer->andFilterWhere(['user.role_id' => Model::ROLE_ADMIN])->andFilterWhere([
					'between',
					'created_date',
					$oStart->format('Y-m-d') . ' 00:00:00',
					$oStart->format('Y-m-d') . ' 23:59:59',
				]);
				$order_customer = $customer->sum('total_amount');
				$total          = $order_customer + $order;
			} else {
				$order          = $value->where(['parent_id' => $this->user->id])->andWhere([
					'between',
					'created_date',
					$oStart->format('Y-m-d') . ' 00:00:00',
					$oStart->format('Y-m-d') . ' 23:59:59',
				])->sum('total_amount');
				$order_customer = $customer->where(['user_id' => $this->user->id])->andWhere([
					'between',
					'created_date',
					$oStart->format('Y-m-d') . ' 00:00:00',
					$oStart->format('Y-m-d') . ' 23:59:59',
				])->sum('total_amount');
				$total          = $order + $order_customer;
			}
			$number[] = [
				$oStart->format('d'),
				$total != null ? (int) $total : 0,
			];
			$oStart->add(new DateInterval("P1D"));
		}
		return $number;
		//		}
	}
}