<?php
namespace App\Data;

/**
* @Author: Cecil Migayi
* @Email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* This class assist in handling any transactionsale data 
*/

class TransactionSale{
	private $transactionSaleId;
	private $transactionNumber;	
	private $itemId;
	private $itemType;
	private $quantity;
	private $dateTime;	
	
	public function setTransactionSaleId($transactionSaleId){
		$this->transactionSaleId = $transactionSaleId;
	}
	
	public function getTransactionSaleId(){
		return $this->transactionSaleId;
	}
		
	public function setTransactionNumber($transactionNumber){
		$this->transactionNumber = $transactionNumber;
	}
	
	public function getTransactionNumber(){
		return $this->transactionNumber;
	}
	
	public function setItemId($itemId){
		$this->itemId = $itemId;
	}
	
	public function getItemId(){
		return $this->itemId;
	}
	
	public function setItemType($itemType){
		$this->itemType = $itemType;
	}
	
	public function getItemType(){
		return $this->itemType;
	}
	
	public function setQuantity($quantity){
		$this->quantity = $quantity;
	}
	
	public function getQuantity(){
		return $this->quantity;
	}
	
	public function setDateTime($dateTime){
		$this->dateTime = $dateTime;
	}
	
	public function getDateTime(){
		return $this->dateTime;
	}	
}