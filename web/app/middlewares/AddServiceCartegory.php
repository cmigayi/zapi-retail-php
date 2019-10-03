<?php
namespace App\Middlewares;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Create/add new service cartegory
*/

use App\Repositories\Contracts\ServiceCartegoryRepositoryInterface;
use App\Data\ServiceCartegory;

class AddServiceCartegory{
	private $repo;

	public function __construct(ServiceCartegoryRepositoryInterface $repo){
		$this->repo = $repo;
	}

	public function createServiceCartegory(ServiceCartegory $serviceCartegory){
		return $this->repo->createServiceCartegory($serviceCartegory);
	}
}