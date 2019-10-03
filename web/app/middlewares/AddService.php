<?php
namespace App\Middlewares;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Create/add new service
*/

use App\Repositories\Contracts\ServiceRepositoryInterface;
use App\Data\Service;

class AddService{
	private $repo; 

	public function __construct(ServiceRepositoryInterface $repo){
		$this->repo = $repo;
	}

	public function createService(Service $service){
		return $this->repo->createService($service);
	}
}