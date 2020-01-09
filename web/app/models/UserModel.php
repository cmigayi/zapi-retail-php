<?php
namespace App\Models;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Handle user data from mysql
*/

use App\Databases\Database;
use App\Data\User;
use App\Common\ErrorLogger;

class UserModel extends Database{
	private $user;
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
		$this->log = new ErrorLogger('UserModel');
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

	public function setData(User $user){
		$this->user = $user;
	}

	/**
	* Handle user account creation	*
	* PDO transaction used because one query depends on another
	*
	* @return user data (User)
	*/
	public function createUser(){
		$this->passedData = array(
				$this->user->getFname(),
				$this->user->getLname(),
				$this->user->getEmail(),
				$this->user->getPhone(),
				$this->user->getUsername(),
				$this->user->getPassword(),
				$this->dateTime
			);

		$this->user = new User();

		try{
			$this->pdo->beginTransaction();
			$this->sql = "INSERT INTO users VALUES(null,?,?,?,?,?,?,?)";
			$this->pdoPrepareAndExecute();
			$userId = $this->pdo->lastInsertId();
			$this->user = $this->getUser($userId);

			$this->pdo->commit();

		}catch(\PDOException $e){
			$this->pdo->rollback();
			
			//logger required!
		}
		return $this->user;		
	}

	/**
	* Handle individual user data retrieval based on user_id
	*
	* @param int($userId) 
	* @return user data (User)
	*/
	public function getUser($userId){
		$this->sql = "SELECT * FROM users WHERE user_id=?";
		$this->passedData = array($userId);
		$this->result = $this->pdoFetchRow();

		$this->user = new User();

		if($this->result == null){
			$this->user = null;
		}else{
			$this->user->setUserId($this->result[0]['user_id']);
			$this->user->setFname($this->result[0]['fname']);
			$this->user->setLname($this->result[0]['lname']);
			$this->user->setEmail($this->result[0]['email']);
			$this->user->setPhone($this->result[0]['phone']);
			$this->user->setUsername($this->result[0]['username']);
			$this->user->setPassword($this->result[0]['password']);
			$this->user->setDateTime($this->result[0]['date_time']);
		}
		return $this->user;
	}

	/**
	* Handle individual user data retrieval based on username and password
	*
	* @return user data (User)
	*/
	public function getUserByUsernameAndPassword(){
		$this->passedData = array(
				$this->user->getUsername()
			);		

		try{
			$this->sql = "SELECT * FROM users WHERE username=?";
			$this->result = $this->pdoFetchRow();

			if($this->result == null){
				$this->user = null;
			}else{
				/**
				* Verify encrypted password (pashword_hash) 
				*/
				if(\password_verify($this->user->getPassword(), 
					$this->result[0]['password'])){

					$this->user = new User();	

					$this->user->setUserId($this->result[0]['user_id']);
					$this->user->setFname($this->result[0]['fname']);
					$this->user->setLname($this->result[0]['lname']);
					$this->user->setEmail($this->result[0]['email']);
					$this->user->setPhone($this->result[0]['phone']);
					$this->user->setUsername($this->result[0]['username']);
					$this->user->setPassword($this->result[0]['password']);
					$this->user->setDateTime($this->result[0]['date_time']);
				}else{
					$this->user = null;
				}
			}

		}catch(\PDOException $e){
			$this->pdo->rollback();
			
			//logger
			$this->log->error("Error ".$e->getMessage());
		}
		return $this->user;
	}
}