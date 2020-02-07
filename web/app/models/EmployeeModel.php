<?php
namespace App\Models;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Handle employee data from mysql
*/

use App\Databases\Database;
use App\Data\Employee;
use App\Common\ErrorLogger;

class EmployeeModel extends Database{
	private $employee;
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
		$this->log = new ErrorLogger('EmployeeModel');
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

	public function setData(Employee $employee){
		$this->employee = $employee;
	}

	/**
	* Handle employee account creation	*
	* PDO transaction used because one query depends on another
	*
	* @return employee data (Employee)
	*/
	public function createEmployee(){
		$this->passedData = array(
				$this->employee->getFname(),
				$this->employee->getLname(),
				$this->employee->getEmail(),
				$this->employee->getPhone(),
				$this->employee->getNationalId(),
				$this->employee->getUsername(),
				$this->employee->getPassword(),
				$this->dateTime
			);

		$this->employee = new Employee();

		try{
			$this->pdo->beginTransaction();
			$this->sql = "INSERT INTO employees VALUES(null,?,?,?,?,?,?,?,?)";
			$this->pdoPrepareAndExecute();
			$employeeId = $this->pdo->lastInsertId();
			$this->employee = $this->getEmployee($employeeId);
			$this->pdo->commit();

		}catch(\PDOException $e){
			$this->pdo->rollback();
			
			//logger required!
		}
		return $this->employee;		
	}	

	/**
	* Handle individual employee data retrieval based on employee_id
	*
	* @param int($employeeId) 
	* @return employee data (Employee)
	*/
	public function getEmployee($employeeId){
		$this->passedData = array($employeeId);
		$this->sql = "SELECT * FROM employees WHERE employee_id=?";
		$this->result = $this->pdoFetchRow();

		$this->employee = new Employee();

		if($this->result == null){
			$this->employee = null;
		}else{
			$this->employee->setEmployeeId($this->result[0]['employee_id']);
			$this->employee->setFname($this->result[0]['firstname']);
			$this->employee->setLname($this->result[0]['lastname']);
			$this->employee->setEmail($this->result[0]['email']);
			$this->employee->setPhone($this->result[0]['phone']);
			$this->employee->setUsername($this->result[0]['username']);
			$this->employee->setPassword($this->result[0]['password']);
			$this->employee->setNationalId($this->result[0]['national_id']);
			$this->employee->setDateTime($this->result[0]['date_time']);
		}
		return $this->employee;
	}

	/**
	* Handle individual employee data retrieval based on username and password
	*
	* @return employee data (Employee)
	*/
	public function getEmployeeByUsernameAndPassword(){
		$this->passedData = array(
				$this->employee->getUsername()
			);		

		try{
			$this->sql = "SELECT * FROM employees WHERE username=?";
			$this->result = $this->pdoFetchRow();

			if($this->result == null){
				$this->employee = null;
			}else{
				/**
				* Verify encrypted password (pashword_hash) 
				*/
				if(\password_verify($this->employee->getPassword(), 
					$this->result[0]['password'])){

					$this->employee = new Employee();	

					$this->employee->setEmployeeId($this->result[0]['employee_id']);
					$this->employee->setFname($this->result[0]['firstname']);
					$this->employee->setLname($this->result[0]['lastname']);
					$this->employee->setEmail($this->result[0]['email']);
					$this->employee->setPhone($this->result[0]['phone']);
					$this->employee->setUsername($this->result[0]['username']);
					$this->employee->setPassword($this->result[0]['password']);
					$this->employee->setNationalId($this->result[0]['national_id']);
					$this->employee->setDateTime($this->result[0]['date_time']);
				}else{
					$this->employee = null;
				}
			}
		}catch(\PDOException $e){
			$this->pdo->rollback();
			
			//logger
			$this->log->error("Error ".$e->getMessage());
		}
		return $this->employee;
	}
	
	/**
	* Handle employees data retrieval
	*
	* @param null
	* @return array employees info 
	*/
	public function getEmployees(){
		$this->passedData = array();

		try{						
			$this->sql = "SELECT * FROM employees";
			$this->result = $this->pdoFetchRows();
		}catch(\PDOException $e){
			//logger
			$this->log->error("Error ".$e->getMessage());
		}
		return $this->result;
	}
	
	/**
	* Handle employee data update
	*
	* @param none
	* @return array employee info 
	*/
	public function updateEmployee(){
		$employeeId = $this->employee->getEmployeeId();
		$this->passedData = array(
				$this->employee->getFname(),
				$this->employee->getLname(),
				$this->employee->getEmail(),
				$this->employee->getPhone(),
				$this->employee->getNationalId(),
				$employeeId
			);

		$this->employee = new Employee();

		try{
			$this->pdo->beginTransaction();
			$this->sql = "UPDATE employees SET firstname=?, lastname=?, email=?, phone=?, national_id=? WHERE employee_id=?";
			$this->pdoPrepareAndExecute();
			$this->employee = $this->getEmployee($employeeId);
			$this->pdo->commit();

		}catch(\PDOException $e){
			$this->pdo->rollback();
			
			//logger required!
		}
		return $this->employee;		
	}
	
	/**
	* Handle employee data delete
	*
	* @param employee_id
	* @return boolean 
	*/
	public function deleteEmployee($employeeId){
		$this->passedData = array($employeeId);
		try{
			$this->sql = "DELETE FROM employees WHERE employee_id=?";
			$this->result = $this->pdoPrepareAndExecute();
		}catch(\PDOException $e){
			$this->pdo->rollback();
			
			//logger required!
		}
		return $this->result;		
	}
}