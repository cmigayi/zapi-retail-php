<?php
namespace App\Middlewares;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Fetch owners data
*/

use App\Repositories\Contracts\OwnerRepositoryInterface;

class Owners{
	private $repo; 

	public function __construct(OwnerRepositoryInterface $repo){
		$this->repo = $repo;
	}

	public function getOwners(){
		return $this->repo->getOwners();
	}
}