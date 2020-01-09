<?php
namespace App\Models;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Handle business credit data from mysql
*/

use App\Databases\Database;
use App\Data\BusinessCredit;
use App\Common\ErrorLogger;

class BusinessCreditModel extends Database{
	private $businessCredit;
	private $dateTime;
	private $result;
	private $log;

	public function __construct(){
		/**
		* Date and time generated for date and time record creation 
		*/		
		$this->dateTime = date("Y-m-d h:i:sa");

		/**
		* initialize logger
		*/
		$this->log = new ErrorLogger('BusinessCreditModel');
		$this->log = $this->log->initLog();

		try{
			/**
			* Connect to PDO database 
			*/
			$this->pdoConfig();
		}catch(\Exception $e){
			//logger
			$this->log->error("Error ".$e->getMessage());
		}
	}

	public function setData(BusinessCredit $businessCredit){
		$this->businessCredit = $businessCredit;
	}

	/**
	* Handle BusinessCredit creation	*
	* PDO transaction used because one query depends on another
	*
	* @return BusinessCredit data (BusinessCredit)
	*/
	public function createBusinessCredit(){
		$this->passedData = array(
				$this->businessCredit->getBusinessId(),
				$this->businessCredit->getOwedPersonId(),
				$this->businessCredit->getCreditType(),
				$this->businessCredit->getAmount(),
				$this->businessCredit->getReason(),
				$this->dateTime
			);

		$this->businessCredit = new BusinessCredit();

		try{
			$this->pdo->beginTransaction();
			$this->sql = "INSERT INTO business_credits VALUES(null,?,?,?,?,?,?)";
			$this->pdoPrepareAndExecute();
			$businessCreditId = $this->pdo->lastInsertId();
			$this->businessCredit = $this->getBusinessCredit($businessCreditId);
			$this->pdo->commit();

		}catch(\PDOException $e){
			$this->pdo->rollback();
			echo $e;
			//logger required!
		}
		return $this->businessCredit;		
	}	

	/**
	* Handle individual BusinessCredit data retrieval based on businessCreditId
	*
	* @param int($businessCreditId) 
	* @return businessCredit data (BusinessCredit)
	*/
	public function getBusinessCredit($businessCreditId){
		$this->passedData = array($businessCreditId);
		$this->sql = "SELECT * FROM business_credits WHERE credit_id=?";
		$this->result = $this->pdoFetchRow();

		$this->businessCredit = new BusinessCredit();
		
		if($this->result == null){
			$this->businessCredit = null;
		}else{
			$this->businessCredit->setBusinessCreditId($this->result[0]['credit_id']);
			$this->businessCredit->setBusinessId($this->result[0]['business_id']);
			$this->businessCredit->setOwedPersonId($this->result[0]['owed_person_id']);
			$this->businessCredit->setCreditType($this->result[0]['credit_type']);
			$this->businessCredit->setAmount($this->result[0]['amount']);
			$this->businessCredit->setReason($this->result[0]['reason']);
			$this->businessCredit->setDateTime($this->result[0]['date_time']);
		}
		return $this->businessCredit;
	}

	/**
	* Handle supplier businessCredit data retrieval based on businessCreditId
	*
	* @param int($supplierId) 
	* @return businessCredit data (BusinessCredit)
	*/
	public function getSupplierBusinessCredit($supplierId){
		$this->passedData = array(
			$supplierId,
			"Supplier"
		);
		$this->sql = "SELECT * FROM business_credits WHERE owed_person_id=? && credit_type=?";
		$this->result = $this->pdoFetchRow();

		$this->businessCredit = new BusinessCredit();
		
		if($this->result == null){
			$this->businessCredit = null;
		}else{
			$this->businessCredit->setBusinessCreditId($this->result[0]['credit_id']);
			$this->businessCredit->setBusinessId($this->result[0]['business_id']);
			$this->businessCredit->setOwedPersonId($this->result[0]['owed_person_id']);
			$this->businessCredit->setCreditType($this->result[0]['credit_type']);
			$this->businessCredit->setAmount($this->result[0]['amount']);
			$this->businessCredit->setReason($this->result[0]['reason']);
			$this->businessCredit->setDateTime($this->result[0]['date_time']);
		}
		return $this->businessCredit;
	}
	
	/**
	* Handle customer businessCredit data retrieval based on businessCreditId
	*
	* @param int($customerId) 
	* @return businessCredit data (BusinessCredit)
	*/
	public function getCustomerBusinessCredit($customerId){
		$this->passedData = array(
			$customerId,
			"Customer"
		);
		$this->sql = "SELECT * FROM business_credits WHERE owed_person_id=? && credit_type=?";
		$this->result = $this->pdoFetchRow();

		$this->businessCredit = new BusinessCredit();
		
		if($this->result == null){
			$this->businessCredit = null;
		}else{
			$this->businessCredit->setBusinessCreditId($this->result[0]['credit_id']);
			$this->businessCredit->setBusinessId($this->result[0]['business_id']);
			$this->businessCredit->setOwedPersonId($this->result[0]['owed_person_id']);
			$this->businessCredit->setCreditType($this->result[0]['credit_type']);
			$this->businessCredit->setAmount($this->result[0]['amount']);
			$this->businessCredit->setReason($this->result[0]['reason']);
			$this->businessCredit->setDateTime($this->result[0]['date_time']);
		}
		return $this->businessCredit;
	}
	
	/**
	* Handle businessCredits data retrieval
	*
	* @param int($businessId)
	* @return array businessCredits info 
	*/
	public function getBusinessCredits($businessId){
		$this->passedData = array($businessId);

		try{						
			$this->sql = "SELECT * FROM business_credits WHERE business_id=?";
			$this->result = $this->pdoFetchRows();
		}catch(\PDOException $e){
			//logger
			$this->log->error("Error ".$e->getMessage());
		}
		return $this->result;
	}
	
	/**
	* Handle businessCredit data update
	*
	* @param none
	* @return array businessCredit info 
	*/
	public function updateBusinessCredit(){
		$businessCreditId = $this->businessCredit->getBusinessCreditId();
		$this->passedData = array(
				$this->businessCredit->getAmount(),
				$businessCreditId
			);

		$this->businessCredit = new BusinessCredit();

		try{
			$this->pdo->beginTransaction();
			$this->sql = "UPDATE business_credits SET amount=? WHERE credit_id=?";
			$this->pdoPrepareAndExecute();
			$this->businessCredit = $this->getBusinessCredit($businessCreditId);
			$this->pdo->commit();

		}catch(\PDOException $e){
			$this->pdo->rollback();
			
			//logger required!
		}
		return $this->businessCredit;		
	}
	
	/**
	* Handle businessCredit data delete
	*
	* @param businessCreditId
	* @return boolean 
	*/
	public function deleteBusinessCredit($businessCreditId){
		$this->passedData = array($businessCreditId);
		try{
			$this->sql = "DELETE FROM business_credits WHERE credit_id=?";
			$this->result = $this->pdoPrepareAndExecute();
		}catch(\PDOException $e){
			$this->pdo->rollback();
			
			//logger required!
		}
		return $this->result;		
	}
}