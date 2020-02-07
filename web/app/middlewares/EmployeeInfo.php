<?php
namespace App\Middlewares;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Fetch employee data
*/

use App\Repositories\Contracts\EmployeeRepositoryInterface;
use App\Data\Employee;

class EmployeeInfo{
	private $repo; 

	public function __construct(EmployeeRepositoryInterface $repo){
		$this->repo = $repo;
	}

	public function getEmployee($employeeId){
		return $this->repo->getEmployee($employeeId);
	}
	
	public function updateEmployee(Employee $employee){
		return $this->repo->updateEmployee($employee);
	}
	
	public function deleteEmployee($employeeId){
		return $this->repo->deleteEmployee($employeeId);
	}
}