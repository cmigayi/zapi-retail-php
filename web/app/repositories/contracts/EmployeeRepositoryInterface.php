<?php
namespace App\Repositories\Contracts;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Contract to employee repository
*/

use App\Data\Employee;

interface EmployeeRepositoryInterface{

	/**
	* Create a new employee
	*
	* @param pass employee data to be stored
	*/
	public function createEmployee(Employee $employee);

	/**
	* Get specific employee
	* 
	* @param pass int($employeeId) to identify employee
	*/
	public function getEmployee($employeeId);

	/**
	* Get specific employee
	* 
	* @param pass String($email) and String($password) to identify employee
	*/
	public function getEmployeeByUsernameAndPwd(String $email, String $password);
	
	/**
	* Get all employees
	* 
	* @param null
	*/
	public function getEmployees();
	
	/**
	* Handle employee data update
	*
	* @param none
	* @return array employee info 
	*/
	public function updateEmployee(Employee $employee);
	
	/**
	* Handle employee data delete
	*
	* @param employee_id
	* @return boolean 
	*/
	public function deleteEmployee($employeeId);
}