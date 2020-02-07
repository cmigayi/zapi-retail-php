<?php
namespace App\Repositories;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Manage employee data from data source
*/

use App\Data\Employee;
use App\Repositories\Contracts\EmployeeRepositoryInterface;
use App\Models\EmployeeModel;

class EmployeeRepository implements EmployeeRepositoryInterface{
	private $employeeModel;
	private $employee;

	public function __construct(){
		$this->employeeModel = new EmployeeModel();		
		$this->employee = new Employee();
	} 

	/**
	* Create a new Employee
	*
	* @param pass employee data to be stored
	* @return employee data (Employee)
	*/
	public function createEmployee(Employee $employee){
		$this->employeeModel->setData($employee);
		return $this->employeeModel->createEmployee();
	}

	/**
	* Get specific Employee
	* 
	* @param pass int($employeeId) to identify employee
	*@return employee data (Employee)
	*/
	public function getEmployee($employeeId){
		return $this->employeeModel->getEmployee($employeeId);
	}

	/**
	* Get specific Employee
	* 
	* @param pass String($email) and String($password) to identify employee
	* @return employee data (Employee)
	*/
	public function getEmployeeByUsernameAndPwd(String $username, String $password){
		$this->employee->setUsername($username);
		$this->employee->setPassword($password);
		$this->employeeModel->setData($this->employee);
		return $this->employeerModel->getEmployeeByUsernameAndPassword();
	}
	
	/**
	* Get all employees
	* 
	* @param null
	*/
	public function getEmployees(){		
		return $this->employeeModel->getEmployees();		
	}
	
	/**
	* Handle employee data update
	*
	* @param none
	* @return array employee info 
	*/
	public function updateEmployee(Employee $employee){
		$this->employeeModel->setData($employee);
		return $this->employeeModel->updateEmployee();
	}
	
	/**
	* Handle employee data delete
	*
	* @param employee_id
	* @return boolean 
	*/
	public function deleteEmployee($employeeId){
		return $this->employeeModel->deleteEmployee($employeeId);
	}
}