<?php
namespace App\Models;

use App\Databases\Database;
use App\Common\ErrorLogger;

class ProfitAndLossModel extends Database{
	private $dateTime;
	private $result;
	private $log;
	private $totalRevenue;
	private $stockCostSold;
	private $servicesCostSold;
	private $totalRecurringExpense;
	
	public function __construct(){
		
		/**
		* Date and time generated for date and time record creation 
		*/		
		$this->dateTime = date("Y-m-d h:i:sa");

		/**
		* initialize logger
		*/
		$this->log = new ErrorLogger('ProfitAndLossModel');
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
	
	/**
	* Objective: Get total Buying Price of products sold
	* 
	*/
	public function getBusinessTotalCostOfStockSold($businessId, $startDate, $endDate){
		$this->passedData = array(
			$businessId,
			$startDate, 
			$endDate
		);

		try{						
			$this->sql = "SELECT SUM(products_sold.quantity * products_supplied.unit_price) AS amount 
			FROM products_sold INNER JOIN products_supplied ON products_sold.product_id = products_supplied.product_id 
			AND products_sold.business_id = products_supplied.business_id WHERE products_sold.business_id = ? AND (products_sold.date_time BETWEEN ? AND ?)";
			$this->result = $this->pdoFetchRow();
			if($this->result === null){
				$productSoldAmount = null;
			}else{
				$productSoldAmount = $this->result[0]['amount'];
			}
		}catch(\PDOException $e){
			//logger
			$this->log->error("Error ".$e->getMessage());
		}
		return $productSoldAmount;
	}
	
	public function getBusinessProductsSoldAmount($businessId, $startDate, $endDate){
		$this->passedData = array(
			$businessId,
			$startDate, 
			$endDate
		);

		try{						
			$this->sql = "SELECT SUM(cost) AS amount FROM products_sold WHERE business_id = ? AND (date_time BETWEEN ? AND ?)";
			$this->result = $this->pdoFetchRow();
			if($this->result === null){
				$productSoldAmount = null;
			}else{
				$productSoldAmount  = $this->result[0]['amount'];
			}
		}catch(\PDOException $e){
			//logger
			$this->log->error("Error ".$e->getMessage());
		}
		return $productSoldAmount;
	}
	
	public function getBusinessServicesAmountSold($businessId, $startDate, $endDate){
		$this->passedData = array(
			$businessId,
			$startDate, 
			$endDate
		);

		try{						
			$this->sql = "SELECT SUM(cost) AS amount FROM services_sold WHERE business_id = ? AND (date_time BETWEEN ? AND ?)";
			$this->result = $this->pdoFetchRow();
			if($this->result === null){
				$this->servicesCostSold = null;
			}else{
				$this->servicesCostSold  = $this->result[0]['amount'];
			}
		}catch(\PDOException $e){
			//logger
			$this->log->error("Error ".$e->getMessage());
		}
		return $this->servicesCostSold;
	}
	
	public function getBusinessTotalRevenue($businessId, $startDate, $endDate){
		
		$this->passedData = array(
			$businessId,
			$startDate, 
			$endDate
		);		
		
		try{						
			$this->sql = "SELECT SUM(cost) AS cost FROM transactions WHERE business_id=? AND (date_time BETWEEN ? AND ?)";
			$this->result = $this->pdoFetchRow();
			
			if($this->result === null){
				$this->totalRevenue = null;
			}else{
				$this->totalRevenue = $this->result[0]['cost'];
			}
		}catch(\PDOException $e){
			echo $e;
			//logger
			$this->log->error("Error ".$e->getMessage());
		}
		return $this->totalRevenue;
	}
	
	public function getBusinessRecurringExpense($businessId, $startDate, $endDate){
		
		$this->passedData = array($businessId,'Recurring');		
		
		try{						
			$this->sql = "SELECT SUM(amount) AS amount FROM expenses WHERE business_id=? AND expense_type=?";
			$this->result = $this->pdoFetchRow();
			
			if($this->result === null){
				$this->totalRecurringExpense = null;
			}else{
				$this->totalRecurringExpense = $this->result[0]['amount'];
			}
		}catch(\PDOException $e){
			echo $e;
			//logger
			$this->log->error("Error ".$e->getMessage());
		}
		return $this->totalRecurringExpense;
	} 
}