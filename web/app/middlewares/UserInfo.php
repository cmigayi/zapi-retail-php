<?php
namespace App\Middlewares;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Fetch user data
*/
use App\Data\User;
use App\Repositories\Contracts\UserRepositoryInterface;

class UserInfo{
	private $repo; 

	public function __construct(UserRepositoryInterface $repo){
		$this->repo = $repo;
	}

	public function getUser($userId){
		return $this->repo->getUser($userId);
	}
	
	public function updateUser(User $user){
		return $this->repo->updateUser($user);
	}
	
	public function deleteUser($userId){
		return $this->repo->deleteUser($userId);
	}
}