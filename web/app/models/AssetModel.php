<?php
namespace App\Models;

use App\Databases\Database;
use App\Common\ErrorLogger;

class AssetModel extends Database{
	private $dateTime;
	private $result;
	private $log;
	
	public function __construct(){
		
		/**
		* Date and time generated for date and time record creation 
		*/		
		$this->dateTime = date("Y-m-d h:i:sa");

		/**
		* initialize logger
		*/
		$this->log = new ErrorLogger('AssetModel');
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
	
	public function getBusinessAssets($businessId){
		$this->passedData = array($businessId);		

		try{						
			$this->sql = "SELECT current_assets.title,current_assets.amount,fixed_assets.title,fixed_assets.amount, 	
			inventory.title,inventory.amount FROM current_assets LEFT JOIN fixed_assets ON current_assets.business_id = fixed_assets.business_id 
			LEFT JOIN inventory ON current_assets.business_id = inventory.business_id WHERE current_assets.business_id = ?";
			$this->result = $this->pdoFetchRows();
		}catch(\PDOException $e){
			echo $e;
			//logger
			$this->log->error("Error ".$e->getMessage());
		}
		return $this->result;
	}
	
	public function getBusinessAssetAmount($businessId){
		
	}
}	