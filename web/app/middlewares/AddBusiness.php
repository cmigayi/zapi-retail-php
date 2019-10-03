<?php
namespace App\Middlewares;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Create/add new business
*/

use App\Repositories\Contracts\BusinessRepositoryInterface;
use App\Data\Business;

class AddBusiness{
	private $repo;

	public function __construct(BusinessRepositoryInterface $repo){
		$this->repo = $repo;
	}	

	public function createBusiness(Business $business){
		return $this->repo->createBusiness($business);
	}
}
