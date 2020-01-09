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
				$this->businessRole->getEmployeeId(),
				$this->businessRole->getBusinessId(),
				$this->businessRole->getRoleLabel(),
				$this->businessRole->getRolePrevileges(),
				$this->dateTime
			);
		$this->sql = "INSERT INTO business_roles VALUES(null,?,?,?,?,?)";

		$this->businessRole = new BusinessRole();

		try{
			$this->pdo->beginTransaction();
			$this->pdoPrepareAndExecute();
			$businessRoleId = $this->pdo->lastInsertId();;
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
				$this->businessRole = null;
			}else{
				$this->businessRole->setBusinessRoleId($this->result[0]['role_id']);				
				$this->businessRole->setEmployeeId($this->result[0]['employee_id']);				
				$this->businessRole->setBusinessId($this->result[0]['business_id']);				
				$this->businessRole->setRoleLabel($this->result[0]['label']);				
				$this->businessRole->setRolePrevileges($this->result[0]['role_privileges']);
				$this->businessRole->setDateTime($this->result[0]['date_time']);				
			}
		}catch(\PDOException $e){			
			//logger
			$this->log->error("Error ".$e->getMessage());
		}
		return $this->businessRole;
	}
	
	/**
	* Get roles in specific business
	* 
	* @param pass int($businessRoleId)
	*/
	public function getBusinessRoles($businessId){
		$this->passedData = array($businessId);

		try{						
			$this->sql = "SELECT * FROM business_roles WHERE business_id = ?";
			$this->result = $this->pdoFetchRows();
		}catch(\PDOException $e){
			//logger
			$this->log->error("Error ".$e->getMessage());
		}
		return $this->result;
	}
	
	/**
	* Get role for specific employee
	* 
	* @param pass int($employeeId)
	*/
	public function getEmployeeRole($employeeId){
		$this->passedData = array($employeeId);
		$this->sql = "SELECT * FROM business_roles WHERE employee_id = ?";
		
		$this->businessRole = new BusinessRole();

		try{
			$this->result = $this->pdoFetchRow();
			if($this->result == null){				
				$this->businessRole = null;
			}else{
				$this->businessRole->setBusinessRoleId($this->result[0]['role_id']);				
				$this->businessRole->setEmployeeId($this->result[0]['employee_id']);				
				$this->businessRole->setBusinessId($this->result[0]['business_id']);				
				$this->businessRole->setRoleLabel($this->result[0]['label']);				
				$this->businessRole->setRolePrevileges($this->result[0]['role_privileges']);
				$this->businessRole->setDateTime($this->result[0]['date_time']);				
			}
		}catch(\PDOException $e){			
			//logger
			$this->log->error("Error ".$e->getMessage());
		}
		return $this->businessRole;		
	}

	/**
	* Handle businessRole data update
	*
	* @param none
	* @return array businessRole info 
	*/
	public function updateBusinessRole(){
		$businessRoleId = $this->businessRole->getBusinessRoleId();
		$this->passedData = array(
				$this->businessRole->getRoleLabel(),
				$this->businessRole->getRolePrevileges(),
				$businessRoleId
			);

		$this->businessRole = new BusinessRole();

		try{
			$this->pdo->beginTransaction();
			$this->sql = "UPDATE business_roles SET label=?, role_privileges=? WHERE role_id=?";
			$this->pdoPrepareAndExecute();
			$this->businessRole = $this->getBusinessRole($businessRoleId);
			$this->pdo->commit();

		}catch(\PDOException $e){
			$this->pdo->rollback();
			
			//logger required!
		}
		return $this->businessRole;		
	}
	
	/**
	* Handle businessRole data delete
	*
	* @param businessRoleId
	* @return boolean 
	*/
	public function deleteBusinessRole($businessRoleId){
		$this->passedData = array($businessRoleId);
		try{
			$this->sql = "DELETE FROM business_roles WHERE role_id=?";
			$this->result = $this->pdoPrepareAndExecute();
		}catch(\PDOException $e){
			$this->pdo->rollback();
			
			//logger required!
		}
		return $this->result;		
	}
}