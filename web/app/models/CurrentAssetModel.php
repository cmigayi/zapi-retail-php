<?php
namespace App\Models;

use App\Databases\Database;
use App\Common\ErrorLogger;
use App\Data\CurrentAsset;

class CurrentAssetModel extends Database{
	private $dateTime;
	private $result;
	private $log;	
	private $currentAsset;
	
	public function __construct(){
		
		/**
		* Date and time generated for date and time record creation 
		*/		
		$this->dateTime = date("Y-m-d h:i:sa");

		/**
		* initialize logger
		*/
		$this->log = new ErrorLogger('CurrentAssetModel');
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

	public function setData(CurrentAsset $currentAsset){
		$this->currentAsset = $currentAsset;
	}

	public function createCurrentAsset(){
		$this->passedData = array(
				$this->currentAsset->getBusinessId(),
				$this->currentAsset->getTitle(),
				$this->currentAsset->getDescription(),
				$this->currentAsset->getAmount(),	
				$this->dateTime
			);

		$this->currentAsset = new CurrentAsset();

		try{
			$this->pdo->beginTransaction();
			$this->sql = "INSERT INTO current_assets VALUES(null,?,?,?,?,?)";
			$this->pdoPrepareAndExecute();
			$currentAssetId = $this->pdo->lastInsertId();
			$this->currentAsset = $this->getCurrentAsset($currentAssetId);

			$this->pdo->commit();

		}catch(\PDOException $e){
			$this->pdo->rollback();
			
			//logger
			$this->log->error("Error ".$e->getMessage());
		}
		return $this->currentAsset;
	}
	
	public function getCurrentAsset($currentAssetId){
		$this->passedData = array($currentAssetId);
		$this->currentAsset = new CurrentAsset();

		try{
			$this->sql = "SELECT * FROM current_assets WHERE current_asset_id = ?";
			$this->result = $this->pdoFetchRow();

			if($this->result == null){
				$this->currentAsset = null;
			}else{
				$this->currentAsset->setCurrentAssetId($this->result[0]['current_asset_id']);
				$this->currentAsset->setBusinessId($this->result[0]['business_id']);
				$this->currentAsset->setTitle($this->result[0]['title']);
				$this->currentAsset->setDescription($this->result[0]['description']);
				$this->currentAsset->setAmount($this->result[0]['amount']);
				$this->currentAsset->setDateTime($this->result[0]['date_time']);
			}
		}catch(\PDOException $e){			
			//logger
			$this->log->error("Error ".$e->getMessage());
		}
		return $this->currentAsset;
	}
	
	public function getBusinessCurrentAssets($businessId){
		$this->passedData = array($businessId);
		
		try{						
			$this->sql = "SELECT * FROM current_assets WHERE business_id = ? ";
			$this->result = $this->pdoFetchRows();
		}catch(\PDOException $e){
			//logger
			$this->log->error("Error ".$e->getMessage());
		}
		return $this->result;
	}
	
	public function getTotalCurrentAssets($businessId, $startDate, $endDate){
		$this->passedData = array(
			$businessId,
			$startDate, 
			$endDate
		);

		try{						
			$this->sql = "SELECT SUM(amount) AS amount FROM current_assets WHERE business_id = ? AND (date_time BETWEEN ? AND ?)";
			$this->result = $this->pdoFetchRow();
			if($this->result === null){
				$currentAssetAmount = null;
			}else{
				$currentAssetAmount = $this->result[0]['amount'];
			}
		}catch(\PDOException $e){
			//logger
			$this->log->error("Error ".$e->getMessage());
		}
		return $currentAssetAmount;
	}
}	