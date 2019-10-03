<?php
namespace App\Middlewares;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Fetch businesses data
*/

use App\Repositories\Contracts\BusinessRepositoryInterface;

class Businesses{
	private $repo; 

	public function __construct(BusinessRepositoryInterface $repo){
		$this->repo = $repo;
	}

	public function getOwnerBusinesses($ownerId){
		return $this->repo->loadOwnerBusinesses($ownerId);
	}

}