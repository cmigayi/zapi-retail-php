<?php
namespace App\Middlewares;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Create/add new employee
*/

use App\Repositories\Contracts\EmployeeRepositoryInterface;
use App\Data\Employee;

class AddEmployee{
	private $repo;

	public function __construct(EmployeeRepositoryInterface $repo){
		$this->repo  = $repo;
	}

	public function createEmployee(Employee $employee){
		return $this->repo->createEmployee($employee);
	}	
}