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
			$this->pdoConfig();
		}catch(\Exception $e){
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
		$this->passedData = array(
				$this->session->getUserId(),
				$this->session->getSessionString(),
				$this->dateTime
			);

		$this->session = new Session();

		try{
			$this->pdo->beginTransaction();
			$this->sql = "INSERT INTO sessions VALUES(null,?,?,?)";
			$this->pdoPrepareAndExecute();
			$sessionId = $this->pdo->lastInsertId();
			$this->session = $this->getSession(1);
			$this->pdo->commit();

		}catch(\PDOException $e){
			$this->pdo->rollback();
			
			//logger required!
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
		$this->sql = "SELECT * FROM sessions WHERE session_id=?";
		$this->passedData = array($sessionId);
		$this->result = $this->pdoFetchRow();

		$this->session = new Session();

		if($this->result == null){
			$this->session = null;
		}else{
			$this->session->setSessionId($this->result[0]['session_id']);
			$this->session->setUserId($this->result[0]['user_id']);
			$this->session->setSessionString($this->result[0]['session_string']);
			$this->session->setDateTime($this->result[0]['date_time']);
		}
		return $this->session;
	}
}	