<?php
namespace App\Middlewares;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Create/add new expense
*/

use App\Repositories\Contracts\ExpenseRepositoryInterface;
use App\Data\Expense;

class AddExpense{
	private $repo;

	public function __construct(ExpenseRepositoryInterface $repo){
		$this->repo = $repo;
	}	

	public function createExpense(Expense $expense){
		return $this->repo->createExpense($expense);
	}
}
