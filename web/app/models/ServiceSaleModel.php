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
use App\Data\ServiceSale;
use App\Common\ErrorLogger;

class ServiceSaleModel extends Database{
	private $ServiceSale;
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
		$this->log = new ErrorLogger('ServiceSaleModel');
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

	public function setData(ServiceSale $serviceSale){
		$this->serviceSale = $serviceSale;
	}

	public function createServiceSale(){
		$this->passedData = array(
				$this->serviceSale->getServiceId(),
				$this->serviceSale->getTransactionNumber(),
				$this->serviceSale->getSellerId(),
				$this->serviceSale->getBusinessId(),
				$this->serviceSale->getFee(),
				$this->serviceSale->getPayment(),
				$this->serviceSale->getReceipt(),
				$this->dateTime
			);

		$this->serviceSale =  new ServiceSale();

		try{
			$this->pdo->beginTransaction();
			$this->sql = "INSERT INTO service_sales VALUES(null,?,?,?,?,?,?,?,?)";
			$this->pdoPrepareAndExecute();
			$serviceSaleId = $this->pdo->lastInsertId();
			$this->serviceSale = $this->getServiceSale($serviceSaleId);			
			$this->pdo->commit();

		}catch(\PDOException $e){
			//logger
			$this->log->error("Error ".$e->getMessage());
		}
		return $this->serviceSale;
	}

	public function getServiceSale($serviceSaleId){
		$this->passedData = array($serviceSaleId);
		$this->sql = "SELECT * FROM service_sales WHERE service_sale_id = ?";

		$this->serviceSale =  new ServiceSale();

		try{

			$this->result = $this->pdoFetchRow();

			if($this->result == null){
				$this->serviceSale = null;
			}else{
				$this->serviceSale->setServiceSaleId($this->result[0]['service_sale_id']);
				$this->serviceSale->setBusinessId($this->result[0]['business_id']);
				$this->serviceSale->setServiceId($this->result[0]['service_id']);
				$this->serviceSale->setSellerId($this->result[0]['seller_id']);
				$this->serviceSale->setTransactionNumber($this->result[0]['transaction_number']);
				$this->serviceSale->setFee($this->result[0]['fee']);
				$this->serviceSale->setPayment($this->result[0]['payment']);
				$this->serviceSale->setReceipt($this->result[0]['receipt']);
				$this->serviceSale->setDateTime($this->result[0]['date_time']);
			}
		}catch(\PDOException $e){
			// logger
			$this->log->error("Error ".$e->getMessage());
		}
		return $this->serviceSale;
	}

	public function getBusinessServicesSales($businessId){
		$this->passedData = array($businessId);

		try{						
			$this->sql = "SELECT * FROM service_sales LEFT JOIN sales_credit ON service_sales.transaction_number = sales_credit.transaction_number WHERE service_sales.business_id = ?";
			$this->result = $this->pdoFetchRows();
		}catch(\PDOException $e){
			//logger
			$this->log->error("Error ".$e->getMessage());
		}
		return $this->result;
	}
}