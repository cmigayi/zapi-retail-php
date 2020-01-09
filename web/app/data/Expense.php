<?php
namespace App\Data;

/**
* @Author: Cecil Migayi
* @Email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* This class assist in handling any business expense data 
*/

class Expense{
	private $expenseId;
	private $businessId;
	private $expenseItem;
	private $expenseType;
	private $amount;
	private $dateTime;
	
	/**
	* setter method
	*
	* @param int($expenseId) 
	*/
	public function setExpenseId($expenseId){
		$this->expenseId = $expenseId;
	}
	
	/**
	* getter method
	*
	* @return int
	*/
	public function getExpenseId(){
		return $this->expenseId;
	}

	/**
	* setter method
	*
	* @param int($businessId) 
	*/
	public function setBusinessId($businessId){
		$this->businessId = $businessId;
	}	

	/**
	* getter method
	*
	* @return int
	*/
	public function getBusinessId(){
		return $this->businessId;
	}	
	
	/**
	* setter method
	*
	* @param string($expenseItem) 
	*/
	public function setExpenseItem($expenseItem){
		$this->expenseItem = $expenseItem;
	}	

	/**
	* getter method
	*
	* @return string
	*/
	public function getExpenseItem(){
		return $this->expenseItem;
	}
	
	/**
	* getter method
	*
	* @return String
	*/
	public function getExpenseType(){
		return $this->expenseType;
	}
	
	/**
	* setter method
	*
	* @param string($expenseType) 
	*/
	public function setExpenseType($expenseType){
		$this->expenseType = $expenseType;
	}
	
	/**
	* getter method
	*
	* @return String
	*/
	public function getAmount(){
		return $this->amount;
	}
	
	/**
	* setter method
	*
	* @param string($amount) 
	*/
	public function setAmount($amount){
		$this->amount = $amount;
	}
	
	/**
	* setter method
	*
	* @param String($type) Date and time the business was inserted to app db
	*/
	public function setDateTime($dateTime){
		$this->dateTime = $dateTime;
	}

	/**
	* getter method
	*
	* @return String
	*/
	public function getDateTime(){
		return $this->dateTime;
	}
}