<?php
namespace App\Models;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Handle supplied product data from mysql
*/

use App\Databases\Database;
use App\Data\SuppliedProduct;
use App\Common\ErrorLogger;

class SuppliedProductModel extends Database{
	private $suppliedProduct;
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
		$this->log = new ErrorLogger('SuppliedProductModel');
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

	public function setData(SuppliedProduct $suppliedProduct){
		$this->suppliedProduct = $suppliedProduct;
	}

	public function createSuppliedProduct(){
		$this->passedData = array(
				$this->suppliedProduct->getProductId(),
				$this->suppliedProduct->getSupplierId(),
				$this->suppliedProduct->getBusinessId(),
				$this->suppliedProduct->getQuantity(),
				$this->suppliedProduct->getUnitPrice(),
				$this->suppliedProduct->getPaymentStatus(),
				$this->dateTime
			);

		$this->suppliedProduct =  new SuppliedProduct();

		try{
			$this->pdo->beginTransaction();
			$this->sql = "INSERT INTO products_supplied VALUES(null,?,?,?,?,?,?,?)";
			$this->pdoPrepareAndExecute();
			$suppliedProductId = $this->pdo->lastInsertId();
			$this->suppliedProduct = $this->getSuppliedProduct($suppliedProductId);			
			$this->pdo->commit();

		}catch(\PDOException $e){
			//logger
			$this->log->error("Error ".$e->getMessage());
		}
		return $this->suppliedProduct;
	}

	public function getSuppliedProduct($suppliedProductId){
		$this->passedData = array($suppliedProductId);
		$this->sql = "SELECT * FROM products_supplied WHERE supplied_product_id = ?";

		$this->suppliedProduct =  new SuppliedProduct();

		try{

			$this->result = $this->pdoFetchRow();

			if($this->result == null){
				$this->suppliedProduct = null;
			}else{
				$this->suppliedProduct->setSuppliedProductId($this->result[0]['supplied_product_id']);
				$this->suppliedProduct->setProductId($this->result[0]['product_id']);
				$this->suppliedProduct->setSupplierId($this->result[0]['supplier_id']);
				$this->suppliedProduct->setBusinessId($this->result[0]['business_id']);
				$this->suppliedProduct->setQuantity($this->result[0]['quantity']);
				$this->suppliedProduct->setUnitPrice($this->result[0]['unit_price']);
				$this->suppliedProduct->setPaymentStatus($this->result[0]['payment_status']);
				$this->suppliedProduct->setDateTime($this->result[0]['date_time']);
			}
		}catch(\PDOException $e){
			// logger
			$this->log->error("Error ".$e->getMessage());
		}
		return $this->suppliedProduct;
	}

	public function getBusinessSuppliedProducts($businessId){
		$this->passedData = array($businessId);

		try{						
			$this->sql = "SELECT * FROM products_supplied LEFT JOIN products ON products_supplied.product_id = products.product_id LEFT JOIN suppliers ON products_supplied.supplier_id = suppliers.supplier_id WHERE products_supplied.business_id = ?";
			$this->result = $this->pdoFetchRows();
		}catch(\PDOException $e){
			//logger
			$this->log->error("Error ".$e->getMessage());
		}
		return $this->result;
	}
	
	public function getBusinessTotalCostOfSuppliedStockBtwnDates($businessId, $startDate, $endDate){
		$this->passedData = array(
			$businessId,
			$startDate, 
			$endDate
		);

		try{						
			$this->sql = "SELECT SUM(quantity*unit_price) AS amount FROM products_supplied WHERE business_id = ? AND (date_time BETWEEN ? AND ?)";
			$this->result = $this->pdoFetchRow();
			if($this->result === null){
				$amount = null;
			}else{
				$amount = $this->result[0]['amount'];
			}
		}catch(\PDOException $e){
			//logger
			$this->log->error("Error ".$e->getMessage());
		}
		return $amount;
	}
}