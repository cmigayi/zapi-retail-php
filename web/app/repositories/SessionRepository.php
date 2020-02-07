<?php
namespace App\Repositories;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Manage session data from data source
*/

use App\Data\Session;
use App\Repositories\Contracts\SessionRepositoryInterface;
use App\Models\SessionModel;

class SessionRepository implements SessionRepositoryInterface{
	private $sessionModel;
	private $session;

	public function __construct(){
		$this->sessionModel = new SessionModel();	
	} 

	/**
	* Create a new session
	*
	* @param pass Session data to be stored
	* @return session data (Session)
	*/
	public function createSession(Session $session){
		$this->sessionModel->setData($session);
		return $this->sessionModel->createSession();
	}

	/**
	* Get specific session
	* 
	* @param pass int($sessionId) to identify session
	*@return session data (Session)
	*/
	public function getSession(int $sessionId){
		return $this->sessionModel->getSession($sessionId);
	}
	
	/**
	* Delete user session
	* 
	* @param pass int($userId) to identify session
	*/
	public function deleteUserSession(int $userId){
		return $this->sessionModel->deleteUserSession($userId);
	}
}