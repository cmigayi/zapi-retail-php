<?php
namespace App\Models;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Handle transaction data from mysql
*/

use App\Databases\Database;
use App\Data\Transaction;
use App\Data\TransactionSale;
use App\Common\ErrorLogger;

class TransactionModel extends Database{
	private $transaction;
	private $transactedItems;
	private $transactionSale;
	private $businessId;
	private $dateTime;
	private $result;
	private $log;

	public function __construct(){
		/**
		* Date and time generated for date and time record creation 
		*/		
		$this->dateTime = date("Y-m-d h:i:sa");

		/**
		* initialize logger
		*/
		$this->log = new ErrorLogger('TransactionModel');
		$this->log = $this->log->initLog();

		try{
			/**
			* Connect to PDO database 
			*/
			$this->pdoConfig();
		}catch(\Exception $e){
			//logger
			$this->log->error("Error ".$e->getMessage());
		}
	}

	public function setData(Transaction $transaction){
		$this->transaction = $transaction;
	}

	/**
	* Handle Transaction creation	*
	* PDO transaction used because one query depends on another
	*
	* @return Transaction data (Transaction)
	*/
	public function createTransaction(){
		$this->transactedItems = $this->transaction->getTransactedItems();
		$transactionNumber = $this->transaction->getTransactionNumber();
		$this->businessId = $this->transaction->getBusinessId();
		
		$this->passedData = array(				
				$this->businessId,
				$this->transaction->getEmployeeId(),
				$transactionNumber,
				$this->transaction->getCost(),
				$this->transaction->getAmountPaid(),
				$this->transaction->getBalance(),
				$this->transaction->getPaymentMode(),
				$this->transaction->getReceipt(),
				$this->dateTime
			);

		$transaction = new Transaction();

		try{
			$this->pdo->beginTransaction();
			$this->sql = "INSERT INTO transactions VALUES(null,?,?,?,?,?,?,?,?,?)";
			$this->pdoPrepareAndExecute();
			$transactionId = $this->pdo->lastInsertId();
			$this->transactedItemsIds = $this->createTransactionSale($transactionNumber, $this->transactedItems);
			if(count($this->transactedItemsIds) > 0){
				$transaction = $this->getTransaction($transactionNumber);
			}
			$this->pdo->commit();
		}catch(\PDOException $e){
			$this->pdo->rollback();
			//logger required!
		}
		return $transaction;		
	}	
	
	/**
	* Handle TransactionSale creation	*
	* PDO transaction used because one query depends on another
	*
	* @return TransactionSale data (TransactionSale)
	*/
	public function createTransactionSale($transactionNumber, $transactedItems){
		$this->transactedItemsIds = array();
		foreach($transactedItems as $transactedItem){
			$itemId = $transactedItem['item_id'];
			$itemType = $transactedItem['item_type'];
			$quantity = $transactedItem['quantity'];
			$items_cost = $transactedItem['items_cost'];
			
			$this->passedData = array(
				$transactionNumber,
				$itemId,
				$itemType,
				$quantity,
				$items_cost,
				$this->dateTime
			);
			
			try{
				$this->sql = "INSERT INTO transaction_sales VALUES(null,?,?,?,?,?,?)";
				$this->pdoPrepareAndExecute();
				$transactionSaleId = $this->pdo->lastInsertId();
				if($itemType == "Product"){
					// Product sold
					$this->createProductSold($this->businessId,$itemId,$quantity,$items_cost);
				}else{
					// Service sold
					$this->createServiceSold($this->businessId,$itemId,$items_cost);
				}
				
				if(!empty($transactionSaleId) && $transactionSaleId != null){
					array_push($this->transactedItemsIds,$transactionSaleId);
				}
			}catch(\PDOException $e){
				//logger required!
			}				
		}
		return $this->transactedItemsIds;
	}
	
	public function createProductSold($businessId,$itemId,$quantity,$items_cost){
		//$this->business = new Business();
		$this->passedData = array(
				$businessId,
				$itemId,
				$quantity,
				$items_cost,
				$this->dateTime
			);

		try{
			//$this->pdo->beginTransaction();
			$this->sql = "INSERT INTO products_sold VALUES(null,?,?,?,?,?)";
			$this->pdoPrepareAndExecute();
			//$businessId = $this->pdo->lastInsertId();
			//$this->business = $this->getBusiness($businessId);

			//$this->pdo->commit();

		}catch(\PDOException $e){
			//$this->pdo->rollback();
			echo $e;
			//logger
			$this->log->error("Error ".$e->getMessage());
		}
		//return $this->business;
	}
	
	public function createServiceSold($businessId,$itemId,$items_cost){
		//$this->business = new Business();
		$this->passedData = array(
				$businessId,
				$itemId,
				$items_cost,
				$this->dateTime
			);

		try{
			//$this->pdo->beginTransaction();
			$this->sql = "INSERT INTO services_sold VALUES(null,?,?,?,?)";
			$this->pdoPrepareAndExecute();
			//$businessId = $this->pdo->lastInsertId();
			//$this->business = $this->getBusiness($businessId);

			//$this->pdo->commit();

		}catch(\PDOException $e){
			//$this->pdo->rollback();
			echo $e;
			//logger
			$this->log->error("Error ".$e->getMessage());
		}
		//return $this->business;
	}
	
	public function getTransactionSale($transactionSaleId){
		$this->passedData = array($transactionSaleId); 
			
		$this->sql = "SELECT * FROM transaction_sales WHERE sale_id=?";
		$this->result = $this->pdoFetchRow();
		
		$this->transactionSale = new TransactionSale();
			
		if($this->result == null){
			$this->transactionSale = null;
		}else{
			$this->transactionSale->setTransactionSaleId($this->result[0]['sale_id']);
			$this->transactionSale->setTransactionNumber($this->result[0]['transaction_number']);
			$this->transactionSale->setItemId($this->result[0]['item_id']);
			$this->transactionSale->setItemType($this->result[0]['item_type']);
			$this->transactionSale->setQuantity($this->result[0]['quantity']);
			$this->transactionSale->setDateTime($this->result[0]['date_time']);			
		}
		return $this->transactionSale;	
	}
	
	public function getTransactionSalesByTransactionNumber($transactionNumber){
		$this->passedData = array($transactionNumber);		
		
		try{						
			$this->sql = "SELECT * FROM transaction_sales WHERE transaction_number=?";
			$this->result = $this->pdoFetchRows();
		}catch(\PDOException $e){
			//logger
			$this->log->error("Error ".$e->getMessage());
		}
		return $this->result;
	}

	/**
	* Handle individual Transaction data retrieval based on $transactionNumber
	*
	* @param int($transactionNumber) 
	* @return Transaction data (Transaction)
	*/
	public function getTransaction($transactionNumber){
		$this->passedData = array($transactionNumber);
		$this->sql = "SELECT * FROM transactions WHERE transaction_number = ?";
		$this->result = $this->pdoFetchRow();

		$this->transaction = new Transaction();
		$this->transactedItems = array();
		$this->transactionSale = new TransactionSale();
		
		if($this->result == null){
			$this->transaction = null;
		}else{			
			$this->transaction->setTransactionId($this->result[0]['transaction_id']);
			$this->transaction->setEmployeeId($this->result[0]['employee_id']);
			$this->transaction->setTransactionNumber($this->result[0]['transaction_number']);
			$this->transaction->setBusinessId($this->result[0]['business_id']);
			$this->transaction->setCost($this->result[0]['cost']);
			$this->transaction->setAmountPaid($this->result[0]['amount_paid']);
			$this->transaction->setBalance($this->result[0]['balance']);
			$this->transaction->setPaymentMode($this->result[0]['payment_mode']);
			$this->transaction->setReceipt($this->result[0]['receipt']);
			$this->transaction->setDateTime($this->result[0]['date_time']);
			
			foreach($this->transactedItemsIds as $id){
				$this->transactionSale = $this->getTransactionSale($id);
				$data['item_id'] = $this->transactionSale->getItemId();
				$data['item_type'] = $this->transactionSale->getItemType();
				$data['quantity'] = $this->transactionSale->getQuantity();
				
				array_push($this->transactedItems, $data);
			} 
			$this->transaction->setTransactedItems($this->transactedItems);
		}		
		return $this->transaction;
	}
	
	/**
	* Handle transaction data retrieval
	*
	* @param string($businessId, $startDate, $endDate)
	* @return array transactions info 
	*/
	public function getBusinessTransactionsBtwnDates($businessId, $startDate, $endDate){
		//$startDate = new \DateTime($startDate);
		//$endDate = new \DateTime($endDate);
		
		$this->passedData = array(
			$businessId,
			$startDate, 
			$endDate
		);		
		
		try{						
			$this->sql = "SELECT * FROM transactions WHERE business_id=? AND (date_time BETWEEN ? AND ?)";
			$this->result = $this->pdoFetchRows();
		}catch(\PDOException $e){
			echo $e;
			//logger
			$this->log->error("Error ".$e->getMessage());
		}
		return $this->result;
	}
	
	/**
	* Handle transaction data retrieval
	*
	* @param string($businessId, $startDate, $endDate)
	* @return array transactions info 
	*/
	public function getBusinessTotalRevenueBtwnDates($businessId, $startDate, $endDate){
		
		$this->passedData = array(
			$businessId,
			$startDate, 
			$endDate
		);		
		
		try{						
			$this->sql = "SELECT SUM(cost) AS cost FROM transactions WHERE business_id=? AND (date_time BETWEEN ? AND ?)";
			$this->result = $this->pdoFetchRow();
			
			if($this->result === null){
				$totalRevenue = null;
			}else{
				$totalRevenue = $this->result[0]['cost'];
			}
		}catch(\PDOException $e){
			echo $e;
			//logger
			$this->log->error("Error ".$e->getMessage());
		}
		return $totalRevenue;
	}
	
	/**
	* Handle transaction data retrieval
	*
	* @param int($businessId)
	* @return array transactions info 
	*/
	public function getBusinessTransactions($businessId){
		$this->passedData = array(
			$businessId
		);		
		
		try{						
			$this->sql = "SELECT * FROM transactions WHERE business_id=?";
			$this->result = $this->pdoFetchRows();
		}catch(\PDOException $e){
			echo $e;
			//logger
			$this->log->error("Error ".$e->getMessage());
		}
		return $this->result;
	}
	
	/**
	* Handle sale data update
	*
	* @param none
	* @return array sale info 
	*/
	/* public function updateSale(){
		$transactionNumber = $this->sale->getTransactionNumber();
		$this->passedData = array(
				$this->sale->getItemId(),
				$this->sale->getItemType(),
				$this->sale->getQuantity(),
				$transactionNumber
			);

		try{
			$this->pdo->beginTransaction();
			$this->sql = "UPDATE sales SET item_id=?, item_type=?, quantity=? WHERE transaction_number=?";
			$this->pdoPrepareAndExecute();
			$transaction = new Sale();
			$transaction = $this->updateTransaction();
			$this->pdo->commit();

		}catch(\PDOException $e){
			$this->pdo->rollback();
			
			//logger required!
		}
		return $transaction;		
	} */

	/**
	* Handle transaction data update
	*
	* @param none
	* @return array transaction info 
	*/
	/* public function updateTransaction(){
		$transactionNumber = $this->sale->getTransactionNumber();
		$this->passedData = array(
				$this->sale->getCost(),
				$this->sale->getAmountPaid(),
				$this->sale->getBalance(),
				$this->sale->getPaymentMode(),
				$this->sale->getReceipt(),
				$transactionNumber
			);

		try{
			$this->pdo->beginTransaction();
			$this->sql = "UPDATE transactions SET cost=?, amount_paid=?, balance=?, payment_mode=?, receipt=? WHERE transaction_number=?";
			$this->pdoPrepareAndExecute();
			$saleTransactions = $this->getSalesTransaction($saleId);
			$this->pdo->commit();

		}catch(\PDOException $e){
			$this->pdo->rollback();
			
			//logger required!
		}
		return $saleTransactions;		
	}
	 */
	/**
	* Handle sale data delete
	*
	* @param $transactionNumber
	* @return boolean 
	*/
	/* public function deleteSale($transactionNumber){
		$this->passedData = array($transactionNumber);
		try{
			$this->pdo->beginTransaction();
			$this->sql = "DELETE FROM sales WHERE transaction_id=?";
			$this->pdoPrepareAndExecute();
			$this->deleteTransaction($transactionNumber);
			$this->result = true;
			$this->pdo->commit();
		}catch(\PDOException $e){
			$this->pdo->rollback();
			$this->result = false;
			//logger required!
		}
		return $this->result;		
	}
	 */
	/**
	* Handle sale data delete
	*
	* @param $transactionNumber
	* @return boolean 
	*/
	/* public function deleteTransaction($transactionNumber){
		$this->passedData = array($transactionNumber);
		try{
			$this->sql = "DELETE FROM transactions WHERE transaction_number=?";
			$this->result = $this->pdoPrepareAndExecute();
		}catch(\PDOException $e){
			$this->pdo->rollback();
			
			//logger required!
		}
		return $this->result;		
	} */
}