<?php
namespace App\Repositories\Contracts;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Contract to session repository
*/

use App\Data\Session;

interface SessionRepositoryInterface{

	/**
	* Create a new session
	*
	* @param pass session data to be stored
	*/
	public function createSession(Session $session);

	/**
	* Get specific session
	* 
	* @param pass int($sessionId) to identify session
	*/
	public function getSession(int $sessionId);
	
	/**
	* Delete user session
	* 
	* @param pass int($userId) to identify session
	*/
	public function deleteUserSession(int $userId);
}