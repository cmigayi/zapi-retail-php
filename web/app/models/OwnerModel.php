<?php
namespace App\Models;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Handle owner data from mysql
*/

use App\Databases\Database;
use App\Data\Owner;
use App\Common\ErrorLogger;

class OwnerModel extends Database{
	private $owner;
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
		$this->log = new ErrorLogger('OwnerModel');
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

	public function setData(Owner $owner){
		$this->owner = $owner;
	}

	/**
	* Handle owner account creation	*
	* PDO transaction used because one query depends on another
	*
	* @return owner data (Owner)
	*/
	public function createOwner(){
		$this->passedData = array(
				$this->owner->getFname(),
				$this->owner->getLname(),
				$this->owner->getEmail(),
				$this->owner->getPhone(),
				$this->owner->getUsername(),
				$this->owner->getPassword(),
				$this->dateTime
			);

		$this->owner = new Owner();

		try{
			$this->pdo->beginTransaction();
			$this->sql = "INSERT INTO owners VALUES(null,?,?,?,?,?,?,?)";
			$this->pdoPrepareAndExecute();
			$ownerId = $this->pdo->lastInsertId();
			$this->owner = $this->getOwner($ownerId);
			$this->pdo->commit();

		}catch(\PDOException $e){
			$this->pdo->rollback();
			
			//logger required!
		}
		return $this->owner;		
	}	

	/**
	* Handle individual user data retrieval based on owner_id
	*
	* @param int($ownerId) 
	* @return owner data (Owner)
	*/
	public function getOwner($ownerId){
		$this->passedData = array($ownerId);
		$this->sql = "SELECT * FROM owners WHERE owner_id=?";
		$this->result = $this->pdoFetchRow();

		$this->owner = new Owner();
		
		if($this->result == null){
			$this->owner = null;
		}else{
			$this->owner->setOwnerId($this->result[0]['owner_id']);
			$this->owner->setFname($this->result[0]['firstname']);
			$this->owner->setLname($this->result[0]['lastname']);
			$this->owner->setEmail($this->result[0]['email']);
			$this->owner->setPhone($this->result[0]['phone']);
			$this->owner->setUsername($this->result[0]['username']);
			$this->owner->setPassword($this->result[0]['password']);
			$this->owner->setDateTime($this->result[0]['date_time']);
		}
		return $this->owner;
	}

	/**
	* Handle individual owner data retrieval based on username and password
	*
	* @return owner data (Owner)
	*/
	public function getOwnerByUsernameAndPassword(){
		$this->passedData = array(
				$this->owner->getUsername()
			);		

		try{
			$this->sql = "SELECT * FROM owners WHERE username=?";
			$this->result = $this->pdoFetchRow();

			if($this->result == null){
				$this->owner = null;
			}else{
				/**
				* Verify encrypted password (pashword_hash) 
				*/
				if(\password_verify($this->owner->getPassword(), 
					$this->result[0]['password'])){

					$this->owner = new Owner();	

					$this->owner->setOwnerId($this->result[0]['owner_id']);
					$this->owner->setFname($this->result[0]['firstname']);
					$this->owner->setLname($this->result[0]['lastname']);
					$this->owner->setEmail($this->result[0]['email']);
					$this->owner->setPhone($this->result[0]['phone']);
					$this->owner->setUsername($this->result[0]['username']);
					$this->owner->setPassword($this->result[0]['password']);
					$this->owner->setDateTime($this->result[0]['date_time']);
				}else{
					$this->owner = null;
				}
			}
		}catch(\PDOException $e){
			$this->pdo->rollback();
			
			//logger
			$this->log->error("Error ".$e->getMessage());
		}
		return $this->owner;
	}
	
	/**
	* Handle owners data retrieval
	*
	* @param null
	* @return array owners info 
	*/
	public function getOwners(){
		$this->passedData = array();

		try{						
			$this->sql = "SELECT * FROM owners";
			$this->result = $this->pdoFetchRows();
		}catch(\PDOException $e){
			//logger
			$this->log->error("Error ".$e->getMessage());
		}
		return $this->result;
	}
	
	/**
	* Handle owner data update
	*
	* @param none
	* @return array owner info 
	*/
	public function updateOwner(){
		$ownerId = $this->owner->getOwnerId();
		$this->passedData = array(
				$this->owner->getFname(),
				$this->owner->getLname(),
				$this->owner->getEmail(),
				$this->owner->getPhone(),
				$ownerId
			);

		$this->owner = new Owner();

		try{
			$this->pdo->beginTransaction();
			$this->sql = "UPDATE owners SET firstname=?, lastname=?, email=?, phone=? WHERE owner_id=?";
			$this->pdoPrepareAndExecute();
			$this->owner = $this->getOwner($ownerId);
			$this->pdo->commit();

		}catch(\PDOException $e){
			$this->pdo->rollback();
			
			//logger required!
		}
		return $this->owner;		
	}
	
	/**
	* Handle owner data delete
	*
	* @param owner_id
	* @return boolean 
	*/
	public function deleteOwner($ownerId){
		$this->passedData = array($ownerId);
		try{
			$this->sql = "DELETE FROM owners WHERE owner_id=?";
			$this->result = $this->pdoPrepareAndExecute();
		}catch(\PDOException $e){
			$this->pdo->rollback();
			
			//logger required!
		}
		return $this->result;		
	}
}