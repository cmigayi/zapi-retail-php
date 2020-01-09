<?php
namespace App\Middlewares;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Fetch expense data
*/
use App\Data\Expense;
use App\Repositories\Contracts\ExpenseRepositoryInterface;

class ExpenseInfo{
	private $repo; 

	public function __construct(ExpenseRepositoryInterface $repo){
		$this->repo = $repo;
	}

	public function getExpense($expenseId){
		return $this->repo->getExpense($expenseId);
	}
	
	public function updateExpense(Expense $expense){
		return $this->repo->updateExpense($expense);
	}
	
	public function deleteExpense($expenseId){
		return $this->repo->deleteExpense($expenseId);
	}
}