<?php
namespace App\Models;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Handle business data from mysql
*/

use App\Databases\Database;
use App\Data\Business;
use App\Common\ErrorLogger;

class BusinessModel extends Database{
	private $business;
	private $dateTime;
	private $result;
	private $results;
	private $log;

	public function __construct(){
		/**
		* Date and time generated for date and time record creation 
		*/		
		$this->dateTime = date("Y-m-d h:i:sa");

		/**
		* initialize logger
		*/
		$this->log = new ErrorLogger('BusinessModel');
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

	public function setData(Business $business){
		$this->business = $business;
	}

	/**
	* Handle business creation
	* PDO transaction used because one query depends on another
	*
	* @return business data (Business)
	*/
	public function createBusiness(){
		$this->passedData = array(
				$this->business->getBusinessName(),
				$this->business->getBusinessType(),
				$this->business->getBusinessLocation(),
				$this->business->getBusinessCountry(),			
				$this->business->getOwnerId(),
				$this->business->getBusinessLogo(),
				$this->dateTime
			);

		$this->business = new Business();

		try{
			$this->pdo->beginTransaction();
			$this->sql = "INSERT INTO businesses VALUES(null,?,?,?,?,?,?,?)";
			$this->pdoPrepareAndExecute();
			$businessId = $this->pdo->lastInsertId();
			$this->business = $this->getBusiness($businessId);

			$this->pdo->commit();

		}catch(\PDOException $e){
			$this->pdo->rollback();
			
			//logger
			$this->log->error("Error ".$e->getMessage());
		}
		return $this->business;
	}

	/**
	* Handle individual business data retrieval based on business_id
	*
	* @param int($businessId) 
	* @return user data (Business)
	*/
	public function getBusiness($businessId){
		$this->passedData = array($businessId);
		$this->business = new Business();

		try{
			$this->sql = "SELECT * FROM businesses WHERE business_id = ?";
			$this->result = $this->pdoFetchRow();

			if($this->result == null){
				$this->business = null;
			}else{
				$this->business->setBusinessId($this->result[0]['business_id']);
				$this->business->setBusinessName($this->result[0]['business_name']);
				$this->business->setBusinessType($this->result[0]['business_type']);
				$this->business->setBusinessLocation($this->result[0]['business_location']);
				$this->business->setBusinessCountry($this->result[0]['country']);
				$this->business->setOwnerId($this->result[0]['owner_id']);
				$this->business->setBusinessLogo($this->result[0]['logo']);
				$this->business->setDateTime($this->result[0]['date_time']);
			}
		}catch(\PDOException $e){			
			//logger
			$this->log->error("Error ".$e->getMessage());
		}
		return $this->business;
	}

	/**
	* Handle owner's businesses data retrieval based on user_id (owner)
	*
	* @param int $businessOwnerId($userId) 
	* @return array business and business role data 
	*/
	public function getOwnerBusinesses($ownerId){
		$this->passedData = array($ownerId);

		try{						
			$this->sql = "SELECT * FROM businesses WHERE owner_id = ? ";
			$this->result = $this->pdoFetchRows();
		}catch(\PDOException $e){
			//logger
			$this->log->error("Error ".$e->getMessage());
		}
		return $this->result;
	}
	
	/**
	* Handle business data update
	*
	* @param none
	* @return array business info 
	*/
	public function updateBusiness(){
		$businessId = $this->business->getBusinessId();
		$this->passedData = array(
				$this->business->getBusinessName(),
				$this->business->getBusinessType(),
				$this->business->getBusinessLocation(),
				$this->business->getBusinessCountry(),	
				$this->business->getBusinessLogo(),
				$businessId
			);

		$this->business = new Business();

		try{
			$this->pdo->beginTransaction();
			$this->sql = "UPDATE businesses SET business_name=?, business_type=?, business_location=?, country=?, logo=? WHERE business_id=?";
			$this->pdoPrepareAndExecute();
			$this->business = $this->getBusiness($businessId);
			$this->pdo->commit();

		}catch(\PDOException $e){
			$this->pdo->rollback();
			
			//logger required!
		}
		return $this->business;		
	}
	
	/**
	* Handle business data delete
	*
	* @param business_id
	* @return boolean 
	*/
	public function deleteBusiness($businessId){
		$this->passedData = array($businessId);
		try{
			$this->sql = "DELETE FROM businesses WHERE business_id=?";
			$this->result = $this->pdoPrepareAndExecute();
		}catch(\PDOException $e){			
			//logger required!
		}
		return $this->result;		
	}
}