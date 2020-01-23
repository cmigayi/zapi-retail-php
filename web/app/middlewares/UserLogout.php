<?php
namespace App\Middlewares;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* user logout
*/

use App\Repositories\Contracts\SessionRepositoryInterface;
use App\Traits\Session;

class UserLogout{
	private $repo;
	
	//private $user; *user already declared in Session trait

	use Session;

	public function __construct(SessionRepositoryInterface $repo){
		$this->repo  = $repo;
	}

	public function userLogout(){
		$this->startSession();
		$this->user = $this->getSessionData();
		
		if($this->authenticateSessionData()){
			$this->repo->deleteUserSession($this->user->getUserId());
			return $this->destroySession();
		}
		return false;
	}	
}