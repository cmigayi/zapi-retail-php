<?php
namespace App\Models;

use App\Databases\Database;
use App\Common\ErrorLogger;
use App\Data\FixedAsset;

class FixedAssetModel extends Database{
	private $dateTime;
	private $result;
	private $log;	
	private $fixedAsset;
	
	public function __construct(){
		
		/**
		* Date and time generated for date and time record creation 
		*/		
		$this->dateTime = date("Y-m-d h:i:sa");

		/**
		* initialize logger
		*/
		$this->log = new ErrorLogger('FixedAssetModel');
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

	public function setData(FixedAsset $fixedAsset){
		$this->fixedAsset = $fixedAsset;
	}

	public function createFixedAsset(){
		$this->passedData = array(
				$this->fixedAsset->getBusinessId(),
				$this->fixedAsset->getTitle(),
				$this->fixedAsset->getDescription(),
				$this->fixedAsset->getAmount(),	
				$this->dateTime
			);

		$this->fixedAsset = new FixedAsset();

		try{
			$this->pdo->beginTransaction();
			$this->sql = "INSERT INTO fixed_assets VALUES(null,?,?,?,?,?)";
			$this->pdoPrepareAndExecute();
			$fixedAssetId = $this->pdo->lastInsertId();
			$this->fixedAsset = $this->getFixedAsset($fixedAssetId);

			$this->pdo->commit();

		}catch(\PDOException $e){
			$this->pdo->rollback();
			
			//logger
			$this->log->error("Error ".$e->getMessage());
		}
		return $this->fixedAsset;
	}
	
	public function getFixedAsset($fixedAssetId){
		$this->passedData = array($fixedAssetId);
		$this->fixedAsset = new FixedAsset();

		try{
			$this->sql = "SELECT * FROM fixed_assets WHERE fixed_asset_id = ?";
			$this->result = $this->pdoFetchRow();

			if($this->result == null){
				$this->fixedAsset = null;
			}else{
				$this->fixedAsset->setFixedAssetId($this->result[0]['fixed_asset_id']);
				$this->fixedAsset->setBusinessId($this->result[0]['business_id']);
				$this->fixedAsset->setTitle($this->result[0]['title']);
				$this->fixedAsset->setDescription($this->result[0]['description']);
				$this->fixedAsset->setAmount($this->result[0]['amount']);
				$this->fixedAsset->setDateTime($this->result[0]['date_time']);
			}
		}catch(\PDOException $e){			
			//logger
			$this->log->error("Error ".$e->getMessage());
		}
		return $this->fixedAsset;
	}
	
	public function getBusinessFixedAssets($businessId){
		$this->passedData = array($businessId);
		
		try{						
			$this->sql = "SELECT * FROM fixed_assets WHERE business_id = ? ";
			$this->result = $this->pdoFetchRows();
		}catch(\PDOException $e){
			//logger
			$this->log->error("Error ".$e->getMessage());
		}
		return $this->result;
	}
	
	public function getTotalFixedAssets($businessId, $startDate, $endDate){
		$this->passedData = array(
			$businessId,
			$startDate, 
			$endDate
		);

		try{						
			$this->sql = "SELECT SUM(amount) AS amount FROM fixed_assets WHERE business_id = ? AND (date_time BETWEEN ? AND ?)";
			$this->result = $this->pdoFetchRow();
			if($this->result === null){
				$fixedAssetAmount = null;
			}else{
				$fixedAssetAmount = $this->result[0]['amount'];
			}
		}catch(\PDOException $e){
			//logger
			$this->log->error("Error ".$e->getMessage());
		}
		return $fixedAssetAmount;
	}
}	