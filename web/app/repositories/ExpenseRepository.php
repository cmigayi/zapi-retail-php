<?php
namespace App\Repositories;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Manage Expense data from data source
*/

use App\Repositories\Contracts\ExpenseRepositoryInterface;
use App\Data\Expense;
use App\Models\ExpenseModel;

class ExpenseRepository implements ExpenseRepositoryInterface{
	private $ExpenseModel;	

	public function __construct(){
		$this->expenseModel = new expenseModel();
	}

	/**	
	* Create new Expense
	*
	* @param $expense object
	* @return Expense object
	*/
	public function createExpense(Expense $expense){
		$this->expenseModel->setData($expense);
		return $this->expenseModel->createExpense();
	}

	/**	
	* Fetch Expense
	*
	* @param int($expenseId)
	* @return expense
	*/
	public function getExpense($expenseId){
		return $this->expenseModel->getExpense($expenseId);
	}
	
	/**
	* Handle expenses data retrieval
	*
	* @param int($expenseId)
	* @return array expenses info 
	*/
	public function getBusinessExpenses($businessId){
		return $this->expenseModel->getBusinessExpenses($businessId);	
	}
	
	/**
	* Handle recurring expenses data retrieval
	*
	* @param int($businessId)
	* @return array expenses info 
	*/
	public function getBusinessRecurringExpenses($businessId){
		return $this->expenseModel->getBusinessRecurringExpenses($businessId);
	}
	
	/**
	* Handle non-recurring expenses data retrieval
	*
	* @param int($businessId)
	* @return array expenses info 
	*/
	public function getBusinessNonRecurringExpenses($businessId){
		return $this->expenseModel->getBusinessNonRecurringExpenses($businessId);
	}
	
	/**
	* Handle Expense data update
	*
	* @param none
	* @return array Expense info 
	*/
	public function updateExpense(Expense $expense){
		$this->expenseModel->setData($expense);
		return $this->expenseModel->updateExpense();
	}
	
	/**
	* Handle Expense data delete
	*
	* @param expenseId
	* @return boolean 
	*/
	public function deleteExpense($expenseId){
		return $this->expenseModel->deleteExpense($expenseId);
	}
}