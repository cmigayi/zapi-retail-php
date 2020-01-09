<?php
namespace App\Models;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Handle service data from mysql
*/

use App\Databases\Database;
use App\Data\Service;
use App\Common\ErrorLogger;

class ServiceModel extends Database{
	private $service;
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
		$this->log = new ErrorLogger('ServiceModel');
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

	public function setData(Service $service){
		$this->service = $service;
	}

	public function createService(){
		$this->passedData = array(
				$this->service->getServiceCartegoryId(),
				$this->service->getEmployeeId(),
				$this->service->getBusinessId(),
				$this->service->getServiceName(),
				$this->service->getServiceDesc(),
				$this->service->getFee(),
				$this->dateTime
			);

		$this->service =  new Service();

		try{
			$this->pdo->beginTransaction();
			$this->sql = "INSERT INTO services VALUES(null,?,?,?,?,?,?,?)";
			$this->pdoPrepareAndExecute();
			$serviceId = $this->pdo->lastInsertId();
			$this->service = $this->getService($serviceId);			
			$this->pdo->commit();

		}catch(\PDOException $e){
			//logger
			$this->log->error("Error ".$e->getMessage());
		}
		return $this->service;
	}

	public function getService($serviceId){
		$this->passedData = array($serviceId);
		$this->sql = "SELECT * FROM services WHERE service_id = ?";

		$this->service =  new Service();

		try{

			$this->result = $this->pdoFetchRow();

			if($this->result == null){
				$this->service = null;
			}else{
				$this->service->setServiceId($this->result[0]['service_id']);
				$this->service->setServiceCartegoryId($this->result[0]['service_cartegory_id']);
				$this->service->setEmployeeId($this->result[0]['employee_id']);
				$this->service->setBusinessId($this->result[0]['business_id']);
				$this->service->setServiceName($this->result[0]['service_name']);
				$this->service->setServiceDesc($this->result[0]['service_desc']);
				$this->service->setFee($this->result[0]['service_fee']);
				$this->service->setDateTime($this->result[0]['date_time']);
			}
		}catch(\PDOException $e){
			// logger
			$this->log->error("Error ".$e->getMessage());
		}
		return $this->service;
	}

	public function getBusinessCartegoryService($serviceId){
		$this->passedData = array($serviceId);

		try{
			$this->sql = "SELECT * FROM services WHERE service_id = ?";
			$this->result = $this->pdoFetchRows();

		}catch(\PDOException $e){
			// logger
			$this->log->error("Error ".$e->getMessage());
		}
		return $this->result;
	}

	public function getBusinessCartegoryServices($serviceCartegoryId){
		$this->passedData = array($serviceCartegoryId);

		try{
			$this->sql = "SELECT * FROM services WHERE service_cartegory_id = ?";
			$this->result = $this->pdoFetchRows();

		}catch(\PDOException $e){
			// logger
			$this->log->error("Error ".$e->getMessage());
		}
		return $this->result;
	}
	
	public function getBusinessServices($businessId){
		$this->passedData = array($businessId);

		try{
			$this->sql = "SELECT * FROM services WHERE business_id = ?";
			$this->result = $this->pdoFetchRows();

		}catch(\PDOException $e){
			// logger
			$this->log->error("Error ".$e->getMessage());
		}
		return $this->result;
	}
	
	public function updateBusinessService(){
		$serviceId = $this->service->getServiceId();
		$this->passedData = array(
				$this->service->getServiceCartegoryId(),
				$this->service->getServiceName(),
				$this->service->getServiceDesc(),
				$this->service->getFee(),
				$serviceId
			);

		$this->service = new Service();

		try{
			$this->pdo->beginTransaction();
			$this->sql = "UPDATE services SET service_cartegory_id=?, service_name=?, service_desc=?, service_fee=? WHERE service_id=?";
			$this->pdoPrepareAndExecute();
			$this->service = $this->getService($serviceId);
			$this->pdo->commit();

		}catch(\PDOException $e){
			$this->pdo->rollback();
			
			//logger required!
		}
		return $this->service;	
	}
	
	public function deleteBusinessService($serviceId){
		$this->passedData = array($serviceId);
		try{
			$this->sql = "DELETE FROM services WHERE service_id=?";
			$this->result = $this->pdoPrepareAndExecute();
		}catch(\PDOException $e){
			$this->pdo->rollback();
			
			//logger required!
		}
		return $this->result;
	}
}