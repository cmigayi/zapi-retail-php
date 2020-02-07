<?php
namespace App\Repositories\Contracts;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Contract to expense repository
*/

use App\Data\Expense;

interface ExpenseRepositoryInterface{

	/**	
	* Create new Expense
	*
	* @param $expense object
	* @return Expense object
	*/
	public function createExpense(Expense $expense);

	/**	
	* Fetch Expense
	*
	* @param int($expenseId)
	* @return expense
	*/
	public function getExpense($expenseId);
	
	/**
	* Handle expenses data retrieval
	*
	* @param int($expenseId)
	* @return array business expenses info 
	*/
	public function getBusinessExpenses($businessId);
	
	/**
	* Handle recurring expenses data retrieval
	*
	* @param int($businessId)
	* @return array expenses info 
	*/
	public function getBusinessRecurringExpenses($businessId);
	
	/**
	* Handle non-recurring expenses data retrieval
	*
	* @param int($businessId)
	* @return array expenses info 
	*/
	public function getBusinessNonRecurringExpenses($businessId);
	
	/**
	* Handle expense data update
	*
	* @param none
	* @return array expense info 
	*/
	public function updateExpense(Expense $expense);
	
	/**
	* Handle expense data delete
	*
	* @param expenseId
	* @return boolean 
	*/
	public function deleteExpense($expenseId);

}