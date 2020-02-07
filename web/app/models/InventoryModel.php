<?php
namespace App\Models;

use App\Databases\Database;
use App\Common\ErrorLogger;
use App\Data\Inventory;

class InventoryModel extends Database{
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
		$this->log = new ErrorLogger('InventoryAssetModel');
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

	public function setData(InventoryAsset $inventory){
		$this->inventory = $inventory;
	}

	public function createInventoryAsset($inventory){
		$this->passedData = array(
				$this->inventory->getBusinessId(),
				$this->inventory->getTitle(),
				$this->inventoryt->getDescription(),
				$this->inventory->getAmount(),	
				$this->dateTime
			);

		$this->inventory = new Inventory();

		try{
			$this->pdo->beginTransaction();
			$this->sql = "INSERT INTO inventory VALUES(null,?,?,?,?,?)";
			$this->pdoPrepareAndExecute();
			$inventoryId = $this->pdo->lastInsertId();
			$this->inventory = $this->getInventory($inventoryId);

			$this->pdo->commit();

		}catch(\PDOException $e){
			$this->pdo->rollback();
			
			//logger
			$this->log->error("Error ".$e->getMessage());
		}
		return $this->inventory;
	}
	
	public function getInventory($inventoryId){
		$this->passedData = array($inventoryId);
		$this->inventory = new Inventory();

		try{
			$this->sql = "SELECT * FROM inventory WHERE inventory_id = ?";
			$this->result = $this->pdoFetchRow();

			if($this->result == null){
				$this->inventory = null;
			}else{
				$this->inventory->setInventoryId($this->result[0]['inventory_id']);
				$this->inventory->setBusinessId($this->result[0]['business_id']);
				$this->inventory->setTitle($this->result[0]['title']);
				$this->inventory->setDescription($this->result[0]['description']);
				$this->inventory->setAmount($this->result[0]['amount']);
				$this->inventory->setDateTime($this->result[0]['date_time']);
			}
		}catch(\PDOException $e){			
			//logger
			$this->log->error("Error ".$e->getMessage());
		}
		return $this->inventory;
	}
	
	public function getBusinessInventory($businessId){
		$this->passedData = array($businessId);
		
		try{						
			$this->sql = "SELECT * FROM inventory WHERE business_id = ? ";
			$this->result = $this->pdoFetchRows();
		}catch(\PDOException $e){
			//logger
			$this->log->error("Error ".$e->getMessage());
		}
		return $this->result;
	}
	
	public function getTotalInventory($businessId, $startDate, $endDate){
		$this->passedData = array(
			$businessId,
			$startDate, 
			$endDate
		);

		try{						
			$this->sql = "SELECT SUM(amount) AS amount FROM inventory WHERE business_id = ? AND (date_time BETWEEN ? AND ?)";
			$this->result = $this->pdoFetchRow();
			if($this->result === null){
				$inventoryAmount = null;
			}else{
				$inventoryAmount = $this->result[0]['amount'];
			}
		}catch(\PDOException $e){
			//logger
			$this->log->error("Error ".$e->getMessage());
		}
		return $inventoryAmount;
	}
}	