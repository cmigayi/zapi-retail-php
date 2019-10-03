<?php
namespace App\Models;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Handle product cartegory data from mysql
*/

use App\Databases\Database;
use App\Data\ProductCartegory;
use App\Common\ErrorLogger;

class ProductCartegoryModel extends Database{
	private $productCartegory;
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
		$this->log = new ErrorLogger('ProductCartegoryModel');
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

	public function setData(ProductCartegory $productCartegory){
		$this->productCartegory = $productCartegory;
	}

	public function createProductCartegory(){
		$this->passedData = array(
				$this->productCartegory->getBusinessId(),
				$this->productCartegory->getCartegoryName(),
				$this->productCartegory->getCartegoryDesc(),
				$this->productCartegory->getCreatedBy(),
				$this->dateTime
			);

		$this->productCartegory =  new ProductCartegory();

		try{
			$this->pdo->beginTransaction();
			$this->sql = "INSERT INTO product_cartegory VALUES(null,?,?,?,?,?)";
			$this->pdoPrepareAndExecute();
			$productCartegoryId = $this->pdo->lastInsertId();
			$this->productCartegory = $this->getProductCartegory($productCartegoryId);			
			$this->pdo->commit();

		}catch(\PDOException $e){
			//logger
			$this->log->error("Error ".$e->getMessage());
		}
		return $this->productCartegory;
	}

	public function getProductCartegory($productCartegoryId){
		$this->passedData = array($productCartegoryId);
		$this->sql = "SELECT * FROM product_cartegory WHERE product_cartegory_id = ?";

		$this->productCartegory =  new ProductCartegory();

		try{

			$this->result = $this->pdoFetchRow();

			if($this->result == null){
				$this->productCartegory = null;
			}else{
				$this->productCartegory->setProductCartegoryId($this->result[0]['product_cartegory_id']);
				$this->productCartegory->setBusinessId($this->result[0]['business_id']);
				$this->productCartegory->setCartegoryName($this->result[0]['cartegory_name']);
				$this->productCartegory->setCartegoryDesc($this->result[0]['cartegory_desc']);
				$this->productCartegory->setCreatedBy($this->result[0]['created_by']);
				$this->productCartegory->setDateTime($this->result[0]['date_time']);
			}
		}catch(\PDOException $e){
			// logger
			$this->log->error("Error ".$e->getMessage());
		}
		return $this->productCartegory;
	}

	public function getBusinessProductCartegories($businessId){
		$this->passedData = array($businessId);

		try{
			$this->sql = "SELECT * FROM product_cartegory WHERE business_id = ?";
			$this->result = $this->pdoFetchRows();

		}catch(\PDOException $e){
			// logger
			$this->log->error("Error ".$e->getMessage());
		}
		return $this->result;
	}
}