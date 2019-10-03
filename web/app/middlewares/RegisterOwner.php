<?php
namespace App\Middlewares;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Create owner account
*/
use App\Data\BusinessAgent;
use App\Repositories\Contracts\BusinessAgentRepositoryInterface;

class  RegisterOwner{
	private $repo;

	public function __construct(BusinessAgentRepositoryInterface $repo){
		$this->repo = $repo;
	} 

	public function createOwnerAccount($businessAgent){
		return $this->repo->createBusinessAgent($businessAgent);
	}
}