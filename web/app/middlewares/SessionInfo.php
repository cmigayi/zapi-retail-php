<?php
namespace App\Middlewares;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Fetch session data
*/

use App\Repositories\Contracts\SessionRepositoryInterface;
use App\Data\Session;

class SessionInfo{
	private $repo; 

	public function __construct(SessionRepositoryInterface $repo){
		$this->repo = $repo;
	}

	public function getSession($sessionId){
		return $this->repo->getSession($sessionId);
	}
	
	public function updateSession(Session $session){
		return $this->repo->updateSession($session);
	}
	
	public function deleteSession($sessionId){
		return $this->repo->deleteSession($sessionId);
	}
}