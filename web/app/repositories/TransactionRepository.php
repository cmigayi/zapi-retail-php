<?php
namespace App\Repositories;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Manage Transaction data from data source
*/

use App\Repositories\Contracts\TransactionRepositoryInterface;
use App\Data\Transaction;
use App\Models\TransactionModel;

class TransactionRepository implements TransactionRepositoryInterface{
	private $transactionModel;	

	public function __construct(){
		$this->transactionModel = new TransactionModel();
	}

	/**	
	* Create new Transaction
	*
	* @param $transaction object
	* @return Transaction object
	*/
	public function createTransaction(Transaction $transaction){
		$this->transactionModel->setData($transaction);
		return $this->transactionModel->createTransaction();
	}

	/**	
	* Fetch Transaction
	*
	* @param int($transactionId)
	* @return Transaction
	*/
	public function getTransaction($transactionNumber){
		return $this->transactionModel->getTransaction($transactionNumber);
	}
	
	/**
	* Handle transaction data retrieval
	*
	* @param int($businessId)
	* @return array transaction info 
	*/
	public function getBusinessTransactions($businessId){
		return $this->transactionModel->getBusinessTransactions($businessId);	
	}
	
	/**
	* Handle transaction data retrieval
	*
	* @param string($businessId, $startDate, $endDate)
	* @return array transactions info 
	*/
	public function getBusinessTransactionsBtwnDates($businessId, $startDate, $endDate){
		return $this->transactionModel->getBusinessTransactionsBtwnDates($businessId, $startDate, $endDate);
	}
	
	/**
	* Handle transaction data retrieval
	*
	* @param string($businessId, $startDate, $endDate)
	* @return array transactions info 
	*/
	public function getBusinessTotalRevenueBtwnDates($businessId, $startDate, $endDate){
		return $this->transactionModel->getBusinessTotalRevenueBtwnDates($businessId, $startDate, $endDate);
	}
	
	/**
	* Handles transaction data update
	*
	* @param none
	* @return array transaction info 
	*/
	public function updateTransaction(Transaction $transaction){
		$this->transactionModel->setData($transaction);
		return $this->transactionModel->updateTransaction();
	}
	
	/**
	* Handle transaction data delete
	*
	* @param transactionNumber
	* @return boolean 
	*/
	public function deleteTransaction($transactionNumber){
		return $this->transactionModel->deleteTransaction($transactionNumber);
	}
}