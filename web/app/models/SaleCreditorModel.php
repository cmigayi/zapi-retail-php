<?php
namespace App\Models;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Handle sale creditor data from mysql
*/

use App\Databases\Database;
use App\Data\SaleCreditor;
use App\Common\ErrorLogger;

class SaleCreditorModel extends Database{
	private $saleCreditor;
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

	public function setData(SaleCreditor $saleCreditor){
		$this->saleCreditor = $saleCreditor;
	}

	public function createSaleCreditor(){
		$this->passedData = array(
				$this->saleCreditor->getBusinessId(),
				$this->saleCreditor->getCustomerId(),
				$this->saleCreditor->getAmount(),
				$this->dateTime
			);

		$this->saleCreditor =  new SaleCreditor();

		try{
			$this->pdo->beginTransaction();
			$this->sql = "INSERT INTO sales_creditor VALUES(null,?,?,?,?)";
			$this->pdoPrepareAndExecute();
			$saleCreditorId = $this->pdo->lastInsertId();
			$this->saleCreditor = $this->getSaleCreditor($saleCreditorId);			
			$this->pdo->commit();

		}catch(\PDOException $e){
			//logger
			$this->log->error("Error ".$e->getMessage());
		}
		return $this->saleCreditor;
	}

	public function getSaleCreditor($saleCreditorId){
		$this->passedData = array($saleCreditorId);
		$this->sql = "SELECT * FROM sales_creditor WHERE creditor_id = ?";

		$this->saleCreditor =  new SaleCreditor();

		try{

			$this->result = $this->pdoFetchRow();

			if($this->result == null){
				$this->saleCreditor = null;
			}else{
				$this->saleCreditor->setCreditorId($this->result[0]['creditor_id']);
				$this->saleCreditor->setBusinessId($this->result[0]['business_id']);
				$this->saleCreditor->setCustomerId($this->result[0]['customer_id']);
				$this->saleCreditor->setAmount($this->result[0]['amount']);
				$this->saleCreditor->setDateTime($this->result[0]['date_time']);
			}
		}catch(\PDOException $e){
			// logger
			$this->log->error("Error ".$e->getMessage());
		}
		return $this->saleCreditor;
	}

	public function getBusinessSalesCreditors($businessId){
		$this->passedData = array($businessId);

		try{						
			$this->sql = "SELECT * FROM sales_creditor LEFT JOIN customers ON sales_creditor.customer_id = customers.customer_id WHERE sales_creditor.business_id = ?";
			$this->result = $this->pdoFetchRows();
		}catch(\PDOException $e){
			//logger
			$this->log->error("Error ".$e->getMessage());
		}
		return $this->result;
	}
}
