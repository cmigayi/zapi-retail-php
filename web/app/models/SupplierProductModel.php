<?php
namespace App\Models;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Handle supplier product data from mysql
*/

use App\Databases\Database;
use App\Data\SupplierProduct;
use App\Common\ErrorLogger;

class SupplierProductModel extends Database{
	private $supplierProduct;
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
		$this->log = new ErrorLogger('SupplierProductModel');
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

	public function setData(SupplierProduct $supplierProduct){
		$this->supplierProduct = $supplierProduct;
	}

	public function createSupplierProduct(){
		$this->passedData = array(
				$this->supplierProduct->getProductId(),
				$this->supplierProduct->getSupplierId(),
				$this->supplierProduct->getBusinessId(),
				$this->dateTime
			);

		$this->supplierProduct =  new SupplierProduct();

		try{
			$this->pdo->beginTransaction();
			$this->sql = "INSERT INTO supplier_products VALUES(null,?,?,?,?)";
			$this->pdoPrepareAndExecute();
			$supplierProductId = $this->pdo->lastInsertId();
			$this->supplierProduct = $this->getSupplierProduct($supplierProductId);			
			$this->pdo->commit();

		}catch(\PDOException $e){
			//logger
			$this->log->error("Error ".$e->getMessage());
		}
		return $this->supplierProduct;
	}

	public function getSupplierProduct($supplierProductId){
		$this->passedData = array($supplierProductId);
		$this->sql = "SELECT * FROM supplier_products WHERE supplier_product_id = ?";

		$this->supplierProduct =  new SupplierProduct();

		try{

			$this->result = $this->pdoFetchRow();

			if($this->result == null){
				$this->supplierProduct = null;
			}else{
				$this->supplierProduct->setSupplierProductId($this->result[0]['supplier_product_id']);
				$this->supplierProduct->setProductId($this->result[0]['product_id']);
				$this->supplierProduct->setSupplierId($this->result[0]['supplier_id']);
				$this->supplierProduct->setBusinessId($this->result[0]['business_id']);
				$this->supplierProduct->setDateTime($this->result[0]['date_time']);
			}
		}catch(\PDOException $e){
			// logger
			$this->log->error("Error ".$e->getMessage());
		}
		return $this->supplierProduct;
	}

	public function getBusinessSupplierProducts($businessId){
		$this->passedData = array($businessId);

		try{						
			$this->sql = "SELECT * FROM supplier_products LEFT JOIN products ON supplier_products.product_id = products.product_id LEFT JOIN suppliers ON supplier_products.supplier_id = suppliers.supplier_id WHERE supplier_products.business_id = ?";
			$this->result = $this->pdoFetchRows();
		}catch(\PDOException $e){
			//logger
			$this->log->error("Error ".$e->getMessage());
		}
		return $this->result;
	}
}