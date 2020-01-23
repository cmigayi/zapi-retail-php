<?php
namespace App\Models;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Handle customer data from mysql
*/

use App\Databases\Database;
use App\Data\Customer;

class CustomerModel extends Database{
	private $customer;
	private $dateTime;
	private $result;

	public function __construct(){
		/**
		* Date and time generated for date and time record creation 
		*/		
		$this->dateTime = date("Y-m-d h:i:sa");

		try{
			/**
			* Connect to PDO database 
			*/
			$this->pdoConfig();
		}catch(\Exception $e){
			echo $e->getMessage();
			return $e->getMessage();
		}
	}

	public function setData($customer){
		$this->customer = $customer;
	}

	/**
	* Handle customer account creation
	* PDO transaction used because one query depends on another
	*
	* @return cutomer data (Customer)
	*/
	public function createCustomer(){
		$this->passedData = array(
				$this->customer->getBusinessId(),
				$this->customer->getFname(),
				$this->customer->getLname(),
				$this->customer->getNationalId(),
				$this->customer->getPhone(),
				$this->customer->getEmail(),
				$this->dateTime
			);

		$this->customer = new Customer();

		try{
			$this->pdo->beginTransaction();
			$this->sql = "INSERT INTO customers VALUES(null,?,?,?,?,?,?,?)";
			$this->pdoPrepareAndExecute();
			$customerId = $this->pdo->lastInsertId();
			$this->customer = $this->getCustomer($customerId);

			$this->pdo->commit();

		}catch(\PDOException $e){
			$this->pdo->rollback();
			
			// logger required
		}
		return $this->customer; 
	}

	public function getCustomer($customerId){
		$this->sql = "SELECT * FROM customers WHERE customer_id = ?";
		$this->passedData = array($customerId);

		$this->customer = new Customer();

		try{
			$this->result = $this->pdoFetchRow();

			if($this->result == null){
				$this->customer = null;
			}else{
				$this->customer->setCustomerId($this->result[0]['customer_id']);
				$this->customer->setFname($this->result[0]['fname']);
				$this->customer->setLname($this->result[0]['lname']);
				$this->customer->setNationalId($this->result[0]['national_id']);
				$this->customer->setPhone($this->result[0]['phone']);
				$this->customer->setEmail($this->result[0]['email']);
				$this->customer->setDateTime($this->result[0]['date_time']);
			}

		}catch(\PDOException $e){
			// logger required
		}
		return $this->customer;
	}
	
	public function getBusinessCustomers($businessId){
		$this->passedData = array($businessId);
		try{
			$this->sql = "SELECT * FROM customers WHERE business_id=?";
			$this->result = $this->pdoFetchRows();
		}catch(\PDOException $e){
			//logger
			$this->log->error("Error ".$e->getMessage());
		}
		return $this->result;
	}
	
	public function updateCustomer(){
		$customerId = $this->customer->getCustomerId();
		$this->passedData = array(
				$this->customer->getFname(),
				$this->customer->getLname(),
				$this->customer->getNationalId(),
				$this->customer->getPhone(),
				$this->customer->getEmail(),
				$customerId
			);

		$this->customer = new Customer();

		try{
			$this->pdo->beginTransaction();
			$this->sql = "UPDATE customers SET fname=?,lname=?,national_id=?,phone=?,email=? WHERE customer_id=?";
			$this->pdoPrepareAndExecute();
			$this->customer = $this->getCustomer($customerId);
			$this->pdo->commit();

		}catch(\PDOException $e){
			$this->pdo->rollback();
			
			//logger required!
		}
		return $this->customer;		
	}
	
	public function deleteCustomer($customerId){
		$this->passedData = array($customerId);
		try{
			$this->sql = "DELETE FROM customers WHERE customer_id=?";
			$this->result = $this->pdoPrepareAndExecute();
		}catch(\PDOException $e){
			$this->pdo->rollback();
			
			//logger required!
		}
		return $this->result;		
	}
}