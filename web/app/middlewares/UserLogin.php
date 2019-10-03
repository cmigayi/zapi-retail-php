<?php
namespace App\Middlewares;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* User login
*/

use App\Repositories\Contracts\UserRepositoryInterface;
use App\Traits\Session;

class UserLogin{
	private $repo;
	
	//private $user; *user already declared in Session trait

	use Session;

	public function __construct(UserRepositoryInterface $repo){
		$this->repo  = $repo;
	}

	public function userLogin($user){
		$this->user = $this->repo->getUserByUsernameAndPwd($user->getUsername(),$user->getPassword());

		if($this->user != null){
			$this->startSession();
			$this->initializeSessionData($this->user);
			$this->user = $this->getSessionData();
		}
		return $this->user;
	}
}