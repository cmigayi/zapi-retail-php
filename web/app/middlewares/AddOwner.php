<?php
namespace App\Middlewares;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Create/add new owner
*/

use App\Repositories\Contracts\OwnerRepositoryInterface;
use App\Data\Owner;

class AddOwner{
	private $repo;

	public function __construct(OwnerRepositoryInterface $repo){
		$this->repo  = $repo;
	}

	public function createOwner(Owner $owner){
		return $this->repo->createOwner($owner);
	}	
}