<?php
namespace App\Models;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Handle business role data from mysql
*/

use App\Databases\Database;
use App\Data\BusinessRole;
use App\Common\ErrorLogger;

class BusinessRoleModel extends Database{
	private $businessRole;
	private $dateTime;
	private $result;

	public function __construct(){
		/**
		* Date and time generated for date and time record creation 
		*/		
		$this->dateTime = date("Y-m-d h:i:sa");

		/**
		* initialize logger
		*/
		$this->log = new ErrorLogger('BusinessRoleModel');
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

	public function setData(BusinessRole $businessRole){
		$this->businessRole = $businessRole;
	}

	/**
	* create business role
	*
	* The user is sometimes referred to as a business agent
	*
	* Only when the user is assigned a business role that they qualify 
	* to be business agents 
	*
	* @param int ($userId) and int (businessId) 
	* @return  
	*/
	public function CreateBusinessRole(){
		$this->passedData = array(
				$this->businessRole->getUserId(),
				$this->businessRole->getBusinessId(),
				$this->businessRole->getBusinessRole(),
				$this->dateTime
			);
		$this->sql = "INSERT INTO business_roles VALUES(null,?,?,?,?)";

		$this->businessRole = new BusinessRole();

		try{
			$this->pdo->beginTransaction();
			$this->pdoPrepareAndExecute();
			$businessRoleId = $this->pdo->lastInsertId();
			$this->businessRole = $this->getBusinessRole($businessRoleId);
			$this->pdo->commit();

		}catch(\PDOException $e){
			$this->pdo->rollback();

			//logger
			$this->log->error("Error ".$e->getMessage());
		}
		return $this->businessRole;
	}

	public function getBusinessRole($businessRoleId){
		$this->passedData = array($businessRoleId);
		$this->sql = "SELECT * FROM business_roles WHERE role_id = ?";
		
		$this->businessRole = new BusinessRole();

		try{
			$this->result = $this->pdoFetchRow();

			if($this->result == null){
				$this->business = null;
			}else{
				$this->businessRole->setBusinessRoleId($this->result[0]['role_id']);
				$this->businessRole->setUserId($this->result[0]['user_id']);
				$this->businessRole->setBusinessId($this->result[0]['business_id']);
				$this->businessRole->setBusinessRole($this->result[0]['role']);
				$this->businessRole->setDateTime($this->result[0]['date_time']);
			}
		}catch(\PDOException $e){			
			//logger
			$this->log->error("Error ".$e->getMessage());
		}
		return $this->businessRole;
	}

	public function getBusinessAgent($businessId,$userId){
		$this->passedData = array($businessId,$userId);

		try{						
			$this->sql = "SELECT * FROM business_roles LEFT JOIN users ON business_roles.user_id = users.user_id WHERE business_id = ? AND business_roles.user_id = ?";
			$this->result = $this->pdoFetchRow();
		}catch(\PDOException $e){
			//logger
			$this->log->error("Error ".$e->getMessage());
		}
		return $this->result;
	}

	public function getBusinessAgents($businessId){
		$this->passedData = array($businessId);

		try{						
			$this->sql = "SELECT * FROM business_roles LEFT JOIN users ON business_roles.user_id = users.user_id WHERE business_id = ?";
			$this->result = $this->pdoFetchRows();
		}catch(\PDOException $e){
			//logger
			$this->log->error("Error ".$e->getMessage());
		}
		return $this->result;
	}
}