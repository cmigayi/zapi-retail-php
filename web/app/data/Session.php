<?php
namespace App\Data;

/**
* @Author: Cecil Migayi
* @Email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* This class assist in handling any session data 
*/

class Session{
	
	private $sessionId;
	private $userId;
	private $sessionString;
	private $dateTime;
	
	public function setSessionId($sessionId){
		$this->sessionId = $sessionId;
	}

	public function getSessionId(){
		return $this->sessionId;
	}

	public function setUserId($userId){
		$this->userId = $userId;
	}

	public function getUserId(){
		return $this->userId;
	}
	
	public function setSessionString($sessionString){
		$this->sessionString = $sessionString;
	}

	public function getSessionString(){
		return $this->sessionString;
	}

	public function setDateTime($dateTime){
		$this->dateTime = $dateTime;
	}

	public function getDateTime(){
		return $this->dateTime;
	}
}