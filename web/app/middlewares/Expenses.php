<?php
namespace App\Middlewares;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Fetch expenses data
*/

use App\Repositories\Contracts\ExpenseRepositoryInterface;

class Expenses{
	private $repo; 

	public function __construct(ExpenseRepositoryInterface $repo){
		$this->repo = $repo;
	}

	public function getBusinessExpenses($businessId){
		return $this->repo->getBusinessExpenses($businessId);
	}
	
	public function getBusinessRecurringExpenses($businessId){
		return $this->repo->getBusinessRecurringExpenses($businessId);
	}
	
	public function getBusinessNonRecurringExpenses($businessId){
		return $this->repo->getBusinessNonRecurringExpenses($businessId);
	}
}