<?php
namespace App\Models;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Handle supplier data from mysql
*/

use App\Databases\Database;
use App\Data\Supplier;
use App\Common\ErrorLogger;

class SupplierModel extends Database{
	private $supplier;
	private $dateTime;
	private $result;
	private $log;

	public function __construct(){
		/**
		* Date and time generated for date and time record creation 
		*/		
		$this->dateTime = date("Y-m-d h:i:sa");

		/**
		* Initialize logger
		*/
		$this->log = new ErrorLogger('SupplierModel');
		$this->log = $this->log->initLog();

		try{
			/**
			* Connect to PDO database 
			*/
			$this->pdoConfig();
		}catch(\Exception $e){
			return $e->getMessage();
		}
	}

	public function setData(Supplier $supplier){
		$this->supplier = $supplier;
	}

	public function createSupplier(){
		$this->passedData = array(
				$this->supplier->getBusinessId(),
				$this->supplier->getSupplierName(),
				$this->supplier->getPhone(),
				$this->supplier->getEmail(),
				$this->dateTime
			);

		$this->supplier =  new Supplier();

		try{
			$this->pdo->beginTransaction();
			$this->sql = "INSERT INTO suppliers VALUES(null,?,?,?,?,?)";
			$this->pdoPrepareAndExecute();
			$supplierId = $this->pdo->lastInsertId();
			$this->supplier = $this->getSupplier($supplierId);			
			$this->pdo->commit();

		}catch(\PDOException $e){
			//logger
			$this->log->error("Error ".$e->getMessage());
		}
		return $this->supplier;
	}

	public function getSupplier($supplierId){
		$this->passedData = array($supplierId);
		$this->sql = "SELECT * FROM suppliers WHERE supplier_id = ?";

		$this->supplier =  new Supplier();

		try{

			$this->result = $this->pdoFetchRow();

			if($this->result == null){
				$this->supplier = null;
			}else{
				$this->supplier->setSupplierId($this->result[0]['supplier_id']);
				$this->supplier->setBusinessId($this->result[0]['business_id']);
				$this->supplier->setSupplierName($this->result[0]['supplier_name']);
				$this->supplier->setPhone($this->result[0]['phone']);
				$this->supplier->setEmail($this->result[0]['email']);
				$this->supplier->setDateTime($this->result[0]['date_time']);
			}
		}catch(\PDOException $e){
			// logger
			$this->log->error("Error ".$e->getMessage());
		}
		return $this->supplier;
	}

	public function getBusinessSupplier($businessId){
		$this->passedData = array($businessId);

		try{
			$this->sql = "SELECT * FROM suppliers WHERE business_id = ?";
			$this->result = $this->pdoFetchRow();
			
		}catch(\PDOException $e){
			// logger
			$this->log->error("Error ".$e->getMessage());
		}
		return $this->result;
	}

	public function getBusinessSuppliers($businessId){
		$this->passedData = array($businessId);

		try{
			$this->sql = "SELECT * FROM suppliers WHERE business_id = ?";
			$this->result = $this->pdoFetchRows();

		}catch(\PDOException $e){
			// logger
			$this->log->error("Error ".$e->getMessage());
		}
		return $this->result;
	}
	
	/**
	* Handle supplier data update
	*
	* @param none
	* @return array supplier info 
	*/
	public function updateSupplier(){
		$supplierId = $this->supplier->getSupplierId();
		
		$this->passedData = array(
				$this->supplier->getSupplierName(),
				$this->supplier->getPhone(),
				$this->supplier->getEmail(),
				$supplierId
			);

		$this->supplier = new Supplier();

		try{
			$this->pdo->beginTransaction();
			$this->sql = "UPDATE suppliers SET supplier_name=?, phone=?, email=? WHERE supplier_id=?";
			$this->pdoPrepareAndExecute();
			$this->supplier = $this->getSupplier($supplierId);
			$this->pdo->commit();

		}catch(\PDOException $e){
			$this->pdo->rollback();
			
			//logger required!
		}
		return $this->supplier;		
	}
	
	/**
	* Handle supplier data delete
	*
	* @param supplier_id
	* @return boolean 
	*/
	public function deleteSupplier($supplierId){
		$this->passedData = array($supplierId);
		try{
			$this->sql = "DELETE FROM suppliers WHERE supplier_id=?";
			$this->result = $this->pdoPrepareAndExecute();
		}catch(\PDOException $e){
			$this->pdo->rollback();
			
			//logger required!
		}
		return $this->result;		
	}
}