<?php
namespace App\Middlewares;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Create/add new customer
*/

use App\Repositories\Contracts\CustomerRepositoryInterface;

class AddCustomer{
	private $repo;

	public function __construct(CustomerRepositoryInterface $repo){
		$this->repo = $repo;
	}

	public function createCustomer($customer){
		return $this->repo->createCustomer($customer); 
	}
}