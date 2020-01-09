<?php
namespace App\Middlewares;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Fetch customer data
*/

use App\Repositories\Contracts\CustomerRepositoryInterface;
use App\Data\Customer;

class CustomerInfo{
	private $repo; 

	public function __construct(CustomerRepositoryInterface $repo){
		$this->repo = $repo;
	}

	public function getCustomer($eustomerId){
		return $this->repo->getCustomer($customerId);
	}
	
	public function updateCustomer(Customer $customer){
		return $this->repo->updateCustomer($customer);
	}
	
	public function deleteCustomer($customerId){
		return $this->repo->deleteCustomer($customerId);
	}
}