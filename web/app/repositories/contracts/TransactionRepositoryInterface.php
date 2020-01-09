<?php
namespace App\Repositories\Contracts;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Contract to transaction repository
*/

use App\Data\Transaction;

interface TransactionRepositoryInterface{

	/**	
	* Create new Transaction
	*
	* @param $transaction object
	* @return Transaction object
	*/
	public function createTransaction(Transaction $transaction);

	/**	
	* Fetch transaction
	*
	* @param int($saleId)
	* @return Transaction
	*/
	public function getTransaction($transactionNumber);
	
	/**
	* Handle transaction data retrieval
	*
	* @param int($businessId)
	* @return array transactions info 
	*/
	public function getBusinessTransactions($businessId);
	
	/**
	* Handle transaction data retrieval
	*
	* @param string($businessId, $startDate, $endDate)
	* @return array transactions info 
	*/
	public function getBusinessTransactionsBtwnDates($businessId, $startDate, $endDate);
	
	/**
	* Handle transaction data retrieval
	*
	* @param string($businessId, $startDate, $endDate)
	* @return array transactions info 
	*/
	public function getBusinessTotalRevenueBtwnDates($businessId, $startDate, $endDate);
	
	/**
	* Handle transaction data update
	*
	* @param none
	* @return array transaction info 
	*/
	public function updateTransaction(Transaction $transaction);
	
	/**
	* Handle transaction data delete
	*
	* @param transactionNumber
	* @return boolean 
	*/
	public function deleteTransaction($transactionNumber);

}