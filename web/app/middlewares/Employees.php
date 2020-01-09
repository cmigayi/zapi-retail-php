<?php
namespace App\Middlewares;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Fetch employees data
*/

use App\Repositories\Contracts\EmployeeRepositoryInterface;

class Employees{
	private $repo; 

	public function __construct(EmployeeRepositoryInterface $repo){
		$this->repo = $repo;
	}

	public function getEmployees(){
		return $this->repo->getEmployees();
	}
}