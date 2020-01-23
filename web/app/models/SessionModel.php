<?php
namespace App\Models;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Handle session data from mysql
*/

use App\Databases\Database;
use App\Data\Session;
use App\Common\ErrorLogger;

class SessionModel extends Database{
	private $session;
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
		$this->log = new ErrorLogger('SessionModel');
		$this->log = $this->log->initLog();

		try{
			/**
			* Connect to PDO database 
			*/			
			parent::pdoConfig();

		}catch(\Exception $e){
			echo $e->getMessage();
			//logger
			$this->log->error("Error ".$e->getMessage());
		}
	}

	public function setData(Session $session){
		$this->session = $session;
	}
	
	/**
	* Handle session creation
	* PDO transaction used because one query depends on another
	*
	* @return session data (Session)
	*/
	public function createSession(){
		$userId = $this->session->getUserId();		
		$sessionString = $this->session->getSessionString();

		$this->session = new Session();
		
		// Get session (UserSession), if it exists
		$this->session = $this->getUserSession($userId);		
		if($this->session == null){
			// Create new session
			$this->passedData = array(
				$userId,
				$sessionString,
				$this->dateTime
			);
			
			try{
				$this->pdo->beginTransaction();			
				$this->sql = "INSERT INTO sessions VALUES(null,?,?,?)";
				$this->pdoPrepareAndExecute();
				$sessionId = $this->pdo->lastInsertId();
				$this->session = $this->getSession($sessionId);
				$this->pdo->commit();

			}catch(\PDOException $e){
				$this->pdo->rollback();	
				//logger required!
			}
		}	
		return $this->session;	
	}
	
	/**
	* Handle individual session data retrieval based on session_id
	*
	* @param int($sessionId) 
	* @return session data (Session)
	*/
	public function getSession($sessionId){
		$this->passedData = array($sessionId);
		$this->sql = "SELECT * FROM sessions WHERE session_id=?";
		$this->result = $this->pdoFetchRow();		
		
		$this->session = null;
		
		if($this->result != null){
			$this->session = new Session();
			$this->session->setSessionId($this->result[0]['session_id']);
			$this->session->setUserId($this->result[0]['user_id']);
			$this->session->setSessionString($this->result[0]['session_string']);
			$this->session->setDateTime($this->result[0]['date_time']);
		}
		return $this->session;
	}
	
	/**
	* Get user session based on user_id
	*
	* @param int($userId) 
	* @return session
	*/
	public function getUserSession($userId){
		$this->passedData = array($userId);		
		$this->passedData = array($userId);		
		$this->sql = "SELECT * FROM sessions WHERE user_id=?";
		$this->result = $this->pdoFetchRow();
		
		$this->session = null;
		
		if($this->result != null){
			$this->session = new Session();
			$this->session->setSessionId($this->result[0]['session_id']);
			$this->session->setUserId($this->result[0]['user_id']);
			$this->session->setSessionString($this->result[0]['session_string']);
			$this->session->setDateTime($this->result[0]['date_time']);			
		}
		return $this->session;
	}
	
	
	public function deleteUserSession($userId){
		$this->passedData = array($userId);
		try{
			$this->sql = "DELETE FROM sessions WHERE user_id=?";
			$this->result = $this->pdoPrepareAndExecute();
		}catch(\PDOException $e){			
			//logger required!
		}
		return $this->result;
	}
}	