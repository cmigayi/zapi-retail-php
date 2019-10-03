<?php
namespace App\Traits;

trait Notifications{

	public $notification;


	public function setData($notification){
		$this->notification = $notification;
	}

	public function createNotification(){}

	public function sendNotification(){}

	public function getSellerNotification(){}
}
