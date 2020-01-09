<?php
namespace App\Models;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Handle product data from mysql
*/

use App\Databases\Database;
use App\Data\Product;
use App\Common\ErrorLogger;

class ProductModel extends Database{
	private $product;
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
		$this->log = new ErrorLogger('ProductModel');
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

	public function setData(Product $product){
		$this->product = $product;
	}

	public function createProduct(){
		$this->passedData = array(
				$this->product->getProductCartegoryId(),
				$this->product->getEmployeeId(),
				$this->product->getBusinessId(),
				$this->product->getProductName(),
				$this->product->getProductDesc(),
				$this->product->getPrice(),
				$this->dateTime
			);

		$this->product =  new Product();

		try{
			$this->pdo->beginTransaction();
			$this->sql = "INSERT INTO products VALUES(null,?,?,?,?,?,?,?)";
			$this->pdoPrepareAndExecute();
			$productId = $this->pdo->lastInsertId();
			$this->product = $this->getProduct($productId);			
			$this->pdo->commit();

		}catch(\PDOException $e){
			//logger
			$this->log->error("Error ".$e->getMessage());
		}
		return $this->product;
	}

	public function getProduct($productId){
		$this->passedData = array($productId);
		$this->sql = "SELECT * FROM products WHERE product_id = ?";

		$this->product =  new Product();

		try{

			$this->result = $this->pdoFetchRow();

			if($this->result == null){
				$this->product = null;
			}else{
				$this->product->setProductId($this->result[0]['product_id']);
				$this->product->setProductCartegoryId($this->result[0]['product_cartegory_id']);
				$this->product->setEmployeeId($this->result[0]['employee_id']);
				$this->product->setBusinessId($this->result[0]['business_id']);
				$this->product->setProductName($this->result[0]['product_name']);
				$this->product->setProductDesc($this->result[0]['product_desc']);
				$this->product->setPrice($this->result[0]['product_price']);
				$this->product->setDateTime($this->result[0]['date_time']);
			}
		}catch(\PDOException $e){
			// logger
			$this->log->error("Error ".$e->getMessage());
		}
		return $this->product;
	}

	public function getBusinessCartegoryProduct($productId){
		$this->passedData = array($productId);

		try{
			$this->sql = "SELECT * FROM products INNER JOIN product_stocks ON products.product_id = product_stocks.product_id WHERE products.product_id = ?";
			$this->result = $this->pdoFetchRow();

		}catch(\PDOException $e){
			// logger
			$this->log->error("Error ".$e->getMessage());
		}
		return $this->result;
	}

	public function getBusinessCartegoryProducts($productCartegoryId){
		$this->passedData = array($productCartegoryId);

		try{
			$this->sql = "SELECT * FROM products INNER JOIN product_stocks ON products.product_id = product_stocks.product_id WHERE product_cartegory_id = ?";
			$this->result = $this->pdoFetchRows();

		}catch(\PDOException $e){
			// logger
			$this->log->error("Error ".$e->getMessage());
		}
		return $this->result;
	}
	
	public function getBusinessProducts($businessId){
		$this->passedData = array($businessId);

		try{
			$this->sql = "SELECT * FROM products WHERE business_id = ?";
			$this->result = $this->pdoFetchRows();

		}catch(\PDOException $e){
			// logger
			$this->log->error("Error ".$e->getMessage());
		}
		return $this->result;
	}
	
	public function updateBusinessProduct(){
		$productId = $this->product->getProductId();
		$this->passedData = array(
				$this->product->getProductCartegoryId(),
				$this->product->getProductName(),
				$this->product->getProductDesc(),
				$this->product->getPrice(),
				$productId
			);

		$this->product = new Product();

		try{
			$this->pdo->beginTransaction();
			$this->sql = "UPDATE products SET product_cartegory_id=?, product_name=?, product_desc=?, product_price=? WHERE product_id=?";
			$this->pdoPrepareAndExecute();
			$this->product = $this->getProduct($productId);
			$this->pdo->commit();

		}catch(\PDOException $e){
			$this->pdo->rollback();
			
			//logger required!
		}
		return $this->product;	
	}
	
	public function deleteBusinessProduct($productId){
		$this->passedData = array($productId);
		try{
			$this->sql = "DELETE FROM products WHERE product_id=?";
			$this->result = $this->pdoPrepareAndExecute();
		}catch(\PDOException $e){
			$this->pdo->rollback();
			
			//logger required!
		}
		return $this->result;
	}
}