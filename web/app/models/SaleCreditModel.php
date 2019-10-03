<?php
namespace App\Models;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Handle sale credit data from mysql
*/

use App\Databases\Database;
use App\Data\SaleCredit;
use App\Common\ErrorLogger;

class SaleCreditModel extends Database{
	private $saleCredit;
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
		$this->log = new ErrorLogger('SaleCreditModel');
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

	public function setData(SaleCredit $saleCredit){
		$this->saleCredit = $saleCredit;
	}

	public function createSaleCredit(){
		$this->passedData = array(
				$this->saleCredit->getCreditorId(),
				$this->saleCredit->getSaleId(),
				$this->saleCredit->getBusinessId(),
				$this->saleCredit->getTransactionNumber(),
				$this->saleCredit->getItemType(),
				$this->saleCredit->getAmount(),
				$this->dateTime
			);

		$this->saleCredit =  new SaleCredit();

		try{
			$this->pdo->beginTransaction();
			$this->sql = "INSERT INTO sales_credit VALUES(null,?,?,?,?,?,?,?)";
			$this->pdoPrepareAndExecute();
			$saleCreditId = $this->pdo->lastInsertId();
			$this->saleCredit = $this->getSaleCredit($saleCreditId);			
			$this->pdo->commit();

		}catch(\PDOException $e){
			//logger
			$this->log->error("Error ".$e->getMessage());
		}
		return $this->saleCredit;
	}

	public function getSaleCredit($saleCreditId){
		$this->passedData = array($saleCreditId);
		$this->sql = "SELECT * FROM sales_credit WHERE credit_id = ?";

		$this->saleCredit =  new SaleCredit();

		try{

			$this->result = $this->pdoFetchRow();

			if($this->result == null){
				$this->saleCredit = null;
			}else{
				$this->saleCredit->setCreditId($this->result[0]['credit_id']);
				$this->saleCredit->setCreditorId($this->result[0]['creditor_id']);
				$this->saleCredit->setSaleId($this->result[0]['sale_id']);
				$this->saleCredit->setBusinessId($this->result[0]['business_id']);
				$this->saleCredit->setTransactionNumber($this->result[0]['transaction_number']);
				$this->saleCredit->setItemType($this->result[0]['item_type']);
				$this->saleCredit->setAmount($this->result[0]['amount']);
				$this->saleCredit->setDateTime($this->result[0]['date_time']);
			}
		}catch(\PDOException $e){
			// logger
			$this->log->error("Error ".$e->getMessage());
		}
		return $this->saleCredit;
	}

	public function getBusinessSalesCredits($businessId){
		$this->passedData = array($businessId);

		try{						
			$this->sql = "SELECT * FROM sales_credit LEFT JOIN sales_creditor ON sales_credit.creditor_id = sales_creditor.creditor_id LEFT JOIN customers ON sales_creditor.customer_id = customers.customer_id WHERE sales_credit.business_id = ?";
			$this->result = $this->pdoFetchRows();
		}catch(\PDOException $e){
			//logger
			$this->log->error("Error ".$e->getMessage());
		}
		return $this->result;
	}
}