<?php
namespace App\Models;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Handle product sale data from mysql
*/

use App\Databases\Database;
use App\Data\ProductSale;
use App\Common\ErrorLogger;

class ProductSaleModel extends Database{
	private $productSale;
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
		$this->log = new ErrorLogger('ProductSaleModel');
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

	public function setData(ProductSale $productSale){
		$this->productSale = $productSale;
	}

	/**
	* Handle product sale creation
	*
	* @return product sale data 
	*/
	public function createProductSale(){
		$this->passedData = array(
				$this->productSale->getProductId(),
				$this->productSale->getSellerId(),
				$this->productSale->getBusinessId(),
				$this->productSale->getTransactionNumber(),
				$this->productSale->getQuantity(),
				$this->productSale->getCost(),
				$this->productSale->getPayment(),
				$this->productSale->getReceipt(),
				$this->dateTime
			);

		$this->productSale =  new ProductSale();

		try{
			$this->pdo->beginTransaction();
			$this->sql = "INSERT INTO product_sales VALUES(null,?,?,?,?,?,?,?,?,?)";
			$this->pdoPrepareAndExecute();
			$productSaleId = $this->pdo->lastInsertId();
			$this->productSale = $this->getProductSale($productSaleId);			
			$this->pdo->commit();

		}catch(\PDOException $e){
			//logger
			$this->log->error("Error ".$e->getMessage());
		}
		return $this->productSale;
	}

	/**
	* Handle individual product sale data retrieval based on product_sale_id
	*
	* @param int($productSaleId) 
	* @return product sale data
	*/
	public function getProductSale($productSaleId){
		$this->passedData = array($productSaleId);
		$this->sql = "SELECT * FROM product_sales WHERE product_sale_id = ?";

		$this->productSale =  new ProductSale();

		try{

			$this->result = $this->pdoFetchRow();

			if($this->result == null){
				$this->productSale = null;
			}else{
				$this->productSale->setProductSaleId($this->result[0]['product_sale_id']);
				$this->productSale->setBusinessId($this->result[0]['business_id']);
				$this->productSale->setProductId($this->result[0]['product_id']);
				$this->productSale->setSellerId($this->result[0]['seller_id']);
				$this->productSale->setTransactionNumber($this->result[0]['transaction_number']);
				$this->productSale->setQuantity($this->result[0]['quantity']);
				$this->productSale->setCost($this->result[0]['cost']);
				$this->productSale->setPayment($this->result[0]['payment']);
				$this->productSale->setReceipt($this->result[0]['receipt']);
				$this->productSale->setDateTime($this->result[0]['date_time']);
			}
		}catch(\PDOException $e){
			// logger
			$this->log->error("Error ".$e->getMessage());
		}
		return $this->productSale;
	}

	/**
	* Handle products sales data retrieval based on business_id
	*
	* @param int($businessId) 
	* @return products sales array data
	*/
	public function getBusinessProductsSales($businessId){
		$this->passedData = array($businessId);

		try{
			$this->sql = "SELECT * FROM product_sales LEFT JOIN products ON product_sales.product_id = products.product_id LEFT JOIN users ON product_sales.seller_id = users.user_id WHERE product_sales.business_id = ?";
			$this->result = $this->pdoFetchRows();
		}catch(\PDOException $e){
			//logger
			$this->log->error("Error ".$e->getMessage());
		}
		return $this->result;
	}
}