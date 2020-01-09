<?php
namespace App\Models;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Handle sale transaction data from mysql
*/

use App\Databases\Database;
use App\Data\SaleTransaction;
use App\Common\ErrorLogger;

class SaleTransactionModel extends Database{
	private $saleTransaction;
	private $dateTime;
	private $result;
	private $log;

	public function __construct(){
		/**
		* Date and time generated for date and time record creation 
		*/		
		$this->dateTime = date("Y-m-d h:i:sa");

		/**
		* Initialize logger
		*/
		$this->log = new ErrorLogger('SaleTransactionModel');
		$this->log = $this->log->initLog();

		try{
			/**
			* Connect to PDO database 
			*/
			$this->pdoConfig();
		}catch(\Exception $e){
			return $e->getMessage();
		}
	}

	public function setData(SaleTransaction $saleTransaction){
		$this->saleTransaction = $saleTransaction;
	}

	public function createSaleTransaction(){
		$this->passedData = array(
				$this->saleTransaction->getBusinessId(),
				$this->saleTransaction->getTransactionNumber(),
				$this->saleTransaction->getPaymentAmount(),
				$this->saleTransaction->getAmountPaid(),
				$this->saleTransaction->getBalance(),
				$this->saleTransaction->getPaymentMode(),
				$this->dateTime
			);

		$this->saleTransaction =  new SaleTransaction();

		try{
			$this->pdo->beginTransaction();
			$this->sql = "INSERT INTO sales_transactions VALUES(null,?,?,?,?,?,?,?)";
			$this->pdoPrepareAndExecute();
			$saleTransactionId = $this->pdo->lastInsertId();
			$this->saleTransaction = $this->getSaleTransaction($saleTransactionId);			
			$this->pdo->commit();

		}catch(\PDOException $e){
			//logger
			$this->log->error("Error ".$e->getMessage());
		}
		return $this->saleTransaction;
	}

	public function getSaleTransaction($saleTransactionId){
		$this->passedData = array($saleTransactionId);
		$this->sql = "SELECT * FROM sales_transactions WHERE sales_transaction_id = ?";

		$this->saleTransaction =  new SaleTransaction();

		try{

			$this->result = $this->pdoFetchRow();

			if($this->result == null){
				$this->saleTransaction = null;
			}else{
				$this->saleTransaction->setSaleTransactionId($this->result[0]['sales_transaction_id']);
				$this->saleTransaction->setBusinessId($this->result[0]['business_id']);
				$this->saleTransaction->setTransactionNumber($this->result[0]['transaction_number']);
				$this->saleTransaction->setPaymentAmount($this->result[0]['payment_amount']);
				$this->saleTransaction->setAmountPaid($this->result[0]['amount_paid']);
				$this->saleTransaction->setBalance($this->result[0]['balance']);
				$this->saleTransaction->setPaymentMode($this->result[0]['payment_mode']);
				$this->saleTransaction->setDateTime($this->result[0]['date_time']);
			}
		}catch(\PDOException $e){
			// logger
			$this->log->error("Error ".$e->getMessage());
		}
		return $this->saleTransaction;
	}

	public function getBusinessSalesTransactions($businessId){
		$this->passedData = array($businessId);

		try{						
			$this->sql = "SELECT * FROM sales_transactions LEFT JOIN sales_credit ON sales_transactions.transaction_number = sales_credit.transaction_number LEFT JOIN businesses ON sales_transactions.business_id = businesses.business_id WHERE sales_transactions.business_id = ?";
			$this->result = $this->pdoFetchRows();
		}catch(\PDOException $e){
			//logger
			$this->log->error("Error ".$e->getMessage());
		}
		return $this->result;
	}
}