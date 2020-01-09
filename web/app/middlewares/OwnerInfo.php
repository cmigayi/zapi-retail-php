<?php
namespace App\Middlewares;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Fetch owner data
*/

use App\Repositories\Contracts\OwnerRepositoryInterface;
use App\Data\Owner;

class OwnerInfo{
	private $repo; 

	public function __construct(OwnerRepositoryInterface $repo){
		$this->repo = $repo;
	}

	public function getOwner($ownerId){
		return $this->repo->getOwner($ownerId);
	}
	
	public function updateOwner(Owner $owner){
		return $this->repo->updateOwner($owner);
	}
	
	public function deleteOwner($ownerId){
		return $this->repo->deleteOwner($ownerId);
	}
}