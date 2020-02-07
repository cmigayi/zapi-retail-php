<?php
namespace App\Middlewares;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Fetch customers data
*/

use App\Repositories\Contracts\CustomerRepositoryInterface;

class Customers{
	private $repo; 

	public function __construct(CustomerRepositoryInterface $repo){
		$this->repo = $repo;
	}

	public function getBusinessCustomers($businessId){
		return $this->repo->loadBusinessCustomers($businessId);
	}
}