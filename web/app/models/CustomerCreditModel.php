<?php
namespace App\Models;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Handle customer credit data from mysql
*/

use App\Databases\Database;
use App\Data\CustomerCredit;
use App\Common\ErrorLogger;

class CustomerCreditModel extends Database{
	private $customerCredit;
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
		$this->log = new ErrorLogger('CustomerCreditModel');
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

	public function setData(CustomerCredit $customerCredit){
		$this->customerCredit = $customerCredit;
	}

	/**
	* Handle CustomerCredit creation	*
	* PDO transaction used because one query depends on another
	*
	* @return CustomerCredit data (CustomerCredit)
	*/
	public function createCustomerCredit(){
		$this->passedData = array(
				$this->customerCredit->getCustomerId(),
				$this->customerCredit->getBusinessId(),
				$this->customerCredit->getTransactionNumber(),
				$this->customerCredit->getAmount(),
				$this->dateTime
			);

		$this->customerCredit = new CustomerCredit();

		try{
			$this->pdo->beginTransaction();
			$this->sql = "INSERT INTO customer_credits VALUES(null,?,?,?,?,?)";
			$this->pdoPrepareAndExecute();
			$customerCreditId = $this->pdo->lastInsertId();
			$this->customerCredit = $this->getCustomerCredit($customerCreditId);
			$this->pdo->commit();

		}catch(\PDOException $e){
			$this->pdo->rollback();
			echo $e;
			//logger required!
		}
		return $this->customerCredit;		
	}	

	/**
	* Handle individual CustomerCredit data retrieval based on customerCreditId
	*
	* @param int($customerCreditId) 
	* @return customerCredit data (CustomerCredit)
	*/
	public function getCustomerCredit($customerCreditId){
		$this->passedData = array($customerCreditId);
		$this->sql = "SELECT * FROM customer_credits WHERE credit_id=?";
		$this->result = $this->pdoFetchRow();

		$this->customerCredit = new CustomerCredit();
		
		if($this->result == null){
			$this->customerCredit = null;
		}else{
			$this->customerCredit->setCustomerCreditId($this->result[0]['credit_id']);
			$this->customerCredit->setCustomerId($this->result[0]['customer_id']);
			$this->customerCredit->setBusinessId($this->result[0]['business_id']);
			$this->customerCredit->setTransactionNumber($this->result[0]['transaction_number']);
			$this->customerCredit->setAmount($this->result[0]['amount']);
			$this->customerCredit->setDateTime($this->result[0]['date_time']);
		}
		return $this->customerCredit;
	}

	/**
	* Handle customer customerCredit data retrieval based on customerId
	*
	* @param int($customerId) 
	* @return array customerCredits info
	*/
	public function getCustomerCredits($customerId){
		$this->passedData = array($customerId);
		try{
			$this->sql = "SELECT * FROM customer_credits WHERE customer_id=?";
			$this->result = $this->pdoFetchRows();
		}catch(\PDOException $e){
			//logger
			$this->log->error("Error ".$e->getMessage());
		}
		return $this->result;
	}
	
	/**
	* Handle customerCredits data retrieval
	*
	* @param int($businessId)
	* @return array customerCredits info 
	*/
	public function getBusinessCustomerCredits($businessId){
		$this->passedData = array($businessId);

		try{						
			$this->sql = "SELECT * FROM customer_credits WHERE business_id=?";
			$this->result = $this->pdoFetchRows();
		}catch(\PDOException $e){
			//logger
			$this->log->error("Error ".$e->getMessage());
		}
		return $this->result;
	}
	
	/**
	* Handle customerCredit data update
	*
	* @param none
	* @return array customerCredit info 
	*/
	public function updateCustomerCredit(){
		$customerCreditId = $this->customerCredit->getCustomerCreditId();
		$this->passedData = array(
				$this->customerCredit->getAmount(),
				$customerCreditId
			);

		$this->customerCredit = new CustomerCredit();

		try{
			$this->pdo->beginTransaction();
			$this->sql = "UPDATE customer_credits SET amount=? WHERE credit_id=?";
			$this->pdoPrepareAndExecute();
			$this->customerCredit = $this->getCustomerCredit($customerCreditId);
			$this->pdo->commit();

		}catch(\PDOException $e){
			$this->pdo->rollback();
			
			//logger required!
		}
		return $this->customerCredit;		
	}
	
	/**
	* Handle customerCredit data delete
	*
	* @param customerId
	* @return boolean 
	*/
	public function deleteCustomerCredit($customerCreditId){
		$this->passedData = array($customerCreditId);
		try{
			$this->sql = "DELETE FROM customer_credits WHERE credit_id=?";
			$this->result = $this->pdoPrepareAndExecute();
		}catch(\PDOException $e){
			$this->pdo->rollback();
			
			//logger required!
		}
		return $this->result;		
	}
}