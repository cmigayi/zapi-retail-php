<?php
namespace App\Repositories;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Manage user data from data source
*/

use App\Data\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Models\UserModel;

class UserRepository implements UserRepositoryInterface{
	private $userModel;
	private $user;

	public function __construct(){
		$this->userModel = new UserModel();		
		$this->user = new User();
	} 

	/**
	* Create a new user
	*
	* @param pass User data to be stored
	* @return user data (User)
	*/
	public function createUser(User $user){
		$this->userModel->setData($user);
		return $this->userModel->createUser();
	}

	/**
	* Get specific user
	* 
	* @param pass int($userId) to identify user
	*@return user data (User)
	*/
	public function getUser(int $userId){
		return $this->userModel->getUser($userId);
	}

	/**
	* Get specific user
	* 
	* @param pass String($email) and String($password) to identify user
	* @return user data (user)
	*/
	public function getUserByUsernameAndPwd(String $username, String $password){
		$this->user->setUsername($username);
		$this->user->setPassword($password);
		$this->userModel->setData($this->user);
		return $this->userModel->getUserByUsernameAndPassword();
	}
}