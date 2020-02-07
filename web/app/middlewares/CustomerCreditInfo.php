<?php
namespace App\Middlewares;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Fetch customerCredit data
*/
use App\Data\CustomerCredit;
use App\Repositories\Contracts\CustomerCreditRepositoryInterface;

class CustomerCreditInfo{
	private $repo; 

	public function __construct(CustomerCreditRepositoryInterface $repo){
		$this->repo = $repo;
	}

	public function getCustomerCredit($customerCreditId){
		return $this->repo->getCustomerCredit($customerCreditId);
	}
	
	public function updateCustomerCredit(CustomerCredit $customerCredit){
		return $this->repo->updateCustomerCredit($customerCredit);
	}
	
	public function deleteCustomerCredit($customerCreditId){
		return $this->repo->deleteCustomerCredit($customerCreditId);
	}
}