<?php
namespace App\Repositories;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Manage owner data from data source
*/

use App\Data\Owner;
use App\Repositories\Contracts\OwnerRepositoryInterface;
use App\Models\OwnerModel;

class OwnerRepository implements OwnerRepositoryInterface{
	private $ownerModel;
	private $owner;

	public function __construct(){
		$this->ownerModel = new OwnerModel();		
		$this->owner = new Owner();
	} 

	/**
	* Create a new owner
	*
	* @param pass Owner data to be stored
	* @return owner data (Owner)
	*/
	public function createOwner(Owner $owner){
		$this->ownerModel->setData($owner);
		return $this->ownerModel->createOwner();
	}

	/**
	* Get specific owner
	* 
	* @param pass int($ownerId) to identify owner
	*@return owner data (Owner)
	*/
	public function getOwner($ownerId){
		return $this->ownerModel->getOwner($ownerId);
	}

	/**
	* Get specific owner
	* 
	* @param pass String($email) and String($password) to identify owner
	* @return owner data (owner)
	*/
	public function getOwnerByUsernameAndPwd(String $username, String $password){
		$this->owner->setUsername($username);
		$this->owner->setPassword($password);
		$this->ownerModel->setData($this->owner);
		return $this->ownerModel->getOwnerByUsernameAndPassword();
	}
	
	/**
	* Get all owners
	* 
	* @param null
	*/
	public function getOwners(){		
		return $this->ownerModel->getOwners();		
	}
	
	/**
	* Handle owner data update
	*
	* @param none
	* @return array owner info 
	*/
	public function updateOwner(Owner $owner){
		$this->ownerModel->setData($owner);
		return $this->ownerModel->updateOwner();
	}
	
	/**
	* Handle owner data delete
	*
	* @param owner_id
	* @return boolean 
	*/
	public function deleteOwner($ownerId){
		return $this->ownerModel->deleteOwner($ownerId);
	}
}