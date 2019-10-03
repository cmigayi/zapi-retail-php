<?php
namespace App\Middlewares;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Create/add new user
*/

use App\Repositories\Contracts\UserRepositoryInterface;

class AddUser{
	private $repo;

	public function __construct(UserRepositoryInterface $repo){
		$this->repo  = $repo;
	}

	public function createUser($user){
		return $this->repo->createUser($user);
	}	
}