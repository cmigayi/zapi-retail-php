<?php
namespace App\Models;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Handle product stock data from mysql
*/

use App\Databases\Database;
use App\Data\ProductStock;
use App\Common\ErrorLogger;

class StockModel extends Database{
	private $productStock;
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
		$this->log = new ErrorLogger('StockModel');
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

	public function setData(ProductStock $productStock){
		$this->productStock = $productStock;
	}

	public function createStock(){
		$this->passedData = array(
				$this->productStock->getBusinessId(),
				$this->productStock->getProductId(),
				$this->productStock->getQuantity(),
				$this->dateTime
			);

		$this->productStock =  new ProductStock();

		try{
			$this->pdo->beginTransaction();
			$this->sql = "INSERT INTO product_stocks VALUES(null,?,?,?,?)";
			$this->pdoPrepareAndExecute();
			$productStockId = $this->pdo->lastInsertId();
			$this->productStock = $this->getStock($productStockId);			
			$this->pdo->commit();

		}catch(\PDOException $e){
			//logger
			$this->log->error("Error ".$e->getMessage());
		}
		return $this->productStock;
	}

	public function getStock($productStockId){
		$this->passedData = array($productStockId);
		$this->sql = "SELECT * FROM product_stocks WHERE stock_id = ?";

		$this->productStock =  new ProductStock();

		try{

			$this->result = $this->pdoFetchRow();

			if($this->result == null){
				$this->productStock = null;
			}else{
				$this->productStock->setStockId($this->result[0]['stock_id']);
				$this->productStock->setBusinessId($this->result[0]['business_id']);
				$this->productStock->setProductId($this->result[0]['product_id']);
				$this->productStock->setQuantity($this->result[0]['quantity']);
				$this->productStock->setDateTime($this->result[0]['date_time']);
			}
		}catch(\PDOException $e){
			// logger
			$this->log->error("Error ".$e->getMessage());
		}
		return $this->productStock;
	}

	public function getBusinessProductsStocks($businessId){
		$this->passedData = array($businessId);

		try{
			$this->sql = "SELECT * FROM product_stocks LEFT JOIN products ON product_stocks.product_id = products.product_id WHERE product_stocks.business_id = ?";
			$this->result = $this->pdoFetchRows();
		}catch(\PDOException $e){
			//logger
			$this->log->error("Error ".$e->getMessage());
		}
		return $this->result;
	}
}