<?php
namespace App\Middlewares;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Fetch business cartegory service data
*/

use App\Repositories\Contracts\ServiceRepositoryInterface;
use App\Data\Service;

class BusinessCartegoryService{
	private $repo; 

	public function __construct(ServiceRepositoryInterface $repo){
		$this->repo = $repo;
	}

	public function getBusinessCartegoryService($serviceId){
		return $this->repo->getBusinessCartegoryService($serviceId);
	}
	
	public function updateBusinessService(Service $service){
		return $this->repo->updateBusinessService($service);		
	}
	
	public function deleteBusinessService($serviceId){
		return $this->repo->deleteBusinessService($serviceId);		
	}
}