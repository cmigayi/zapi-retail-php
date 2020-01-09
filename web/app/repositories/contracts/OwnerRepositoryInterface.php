<?php
namespace App\Repositories\Contracts;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Contract to owner repository
*/

use App\Data\Owner;

interface OwnerRepositoryInterface{

	/**
	* Create a new owner
	*
	* @param pass owner data to be stored
	*/
	public function createOwner(Owner $owner);

	/**
	* Get specific owner
	* 
	* @param pass int($ownerId) to identify owner
	*/
	public function getOwner($ownerId);

	/**
	* Get specific owner
	* 
	* @param pass String($email) and String($password) to identify owner
	*/
	public function getOwnerByUsernameAndPwd(String $email, String $password);
	
	/**
	* Get all owners
	* 
	* @param null
	*/
	public function getOwners();
	
	/**
	* Handle owner data update
	*
	* @param none
	* @return array owner info 
	*/
	public function updateOwner(Owner $owner);
	
	/**
	* Handle owner data delete
	*
	* @param owner_id
	* @return boolean 
	*/
	public function deleteOwner($ownerId);
}