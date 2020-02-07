<?php
namespace App\Data;

/**
* @Author: Cecil Migayi
* @Email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* This class assist in handling any inventory data 
*/

class Inventory{
	
	private $inventoryId;
	private $businessId;
	private $title;
	private $description;
	private $amount;
	private $dateTime;
	
	public function setInventoryId($inventoryId){
		$this->inventoryId = $inventoryId;
	}
	
	public function getInventoryId(){
		return $this->inventoryId;
	}
	
	public function setBusinessId($businessid){
		$this->businessId = $businessid;
	}

	public function getBusinessId(){
		return $this->businessId;
	}
	
	public function setTitle($title){
		$this->title = $title;
	}
	
	public function getTitle(){
		return $this->title;
	}	
	
	public function setDescription($description){
		$this->description = $description;
	}
	
	public function getDescription(){
		return $this->description;
	}

	public function setAmount($amount){
		$this->amount = $amount;
	}
	
	public function getAmount(){
		return $this->amount;
	}

	public function setDateTime($dateTime){
		$this->dateTime = $dateTime;
	}
	
	public function getDateTime(){
		return $this->dateTime;
	}	
}