<?php
namespace App\Middlewares;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Create/add new cutomerCredit
*/

use App\Repositories\Contracts\CustomerCreditRepositoryInterface;
use App\Data\CustomerCredit;

class AddCustomerCredit{
	private $repo;

	public function __construct(CustomerCreditRepositoryInterface $repo){
		$this->repo = $repo;
	}	

	public function createCustomerCredit(CustomerCredit $customerCredit){
		return $this->repo->createCustomerCredit($customerCredit);
	}
}
