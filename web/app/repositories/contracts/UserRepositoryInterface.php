<?php
namespace App\Repositories\Contracts;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Contract to user repository
*/

use App\Data\User;

interface UserRepositoryInterface{

	/**
	* Create a new user
	*
	* @param pass user data to be stored
	*/
	public function createUser(User $user);

	/**
	* Get specific user
	* 
	* @param pass int($userId) to identify user
	*/
	public function getUser(int $userId);

	/**
	* Get specific user
	* 
	* @param pass String($email) and String($password) to identify user
	*/
	public function getUserByUsernameAndPwd(String $email, String $password);
}