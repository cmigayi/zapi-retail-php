<?php
namespace App\Models;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Handle service cartegory data from mysql
*/

use App\Databases\Database;
use App\Data\ServiceCartegory;
use App\Common\ErrorLogger;

class ServiceCartegoryModel extends Database{
	private $serviceCartegory;
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
		$this->log = new ErrorLogger('ProductCartegoryModel');
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

	public function setData(ServiceCartegory $serviceCartegory){
		$this->serviceCartegory = $serviceCartegory;
	}

	public function createServiceCartegory(){
		$this->passedData = array(
				$this->serviceCartegory->getBusinessId(),
				$this->serviceCartegory->getCartegoryName(),
				$this->serviceCartegory->getCartegoryDesc(),
				$this->serviceCartegory->getCreatedBy(),
				$this->dateTime
			);

		$this->serviceCartegory =  new ServiceCartegory();

		try{
			$this->pdo->beginTransaction();
			$this->sql = "INSERT INTO service_cartegory VALUES(null,?,?,?,?,?)";
			$this->pdoPrepareAndExecute();
			$serviceCartegoryId = $this->pdo->lastInsertId();
			$this->serviceCartegoryy = $this->getServiceCartegory($serviceCartegoryId);			
			$this->pdo->commit();

		}catch(\PDOException $e){
			//logger
			$this->log->error("Error ".$e->getMessage());
		}
		return $this->serviceCartegory;
	}

	public function getServiceCartegory($serviceCartegoryId){
		$this->passedData = array($serviceCartegoryId);
		$this->sql = "SELECT * FROM service_cartegory WHERE service_cartegory_id = ?";

		$this->serviceCartegory =  new ServiceCartegory();

		try{

			$this->result = $this->pdoFetchRow();

			if($this->result == null){
				$this->serviceCartegory = null;
			}else{
				$this->serviceCartegory->setServiceCartegoryId($this->result[0]['service_cartegory_id']);
				$this->serviceCartegory->setBusinessId($this->result[0]['business_id']);
				$this->serviceCartegory->setCartegoryName($this->result[0]['cartegory_name']);
				$this->serviceCartegory->setCartegoryDesc($this->result[0]['cartegory_desc']);
				$this->serviceCartegory->setCreatedBy($this->result[0]['created_by']);
				$this->serviceCartegory->setDateTime($this->result[0]['date_time']);
			}
		}catch(\PDOException $e){
			// logger
			$this->log->error("Error ".$e->getMessage());
		}
		return $this->serviceCartegory;
	}

	public function getBusinessServiceCartegories($businessId){
		$this->passedData = array($businessId);

		try{
			$this->sql = "SELECT * FROM service_cartegory WHERE business_id = ?";
			$this->result = $this->pdoFetchRows();

		}catch(\PDOException $e){
			// logger
			$this->log->error("Error ".$e->getMessage());
		}
		return $this->result;
	}
}