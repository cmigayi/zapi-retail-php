<?php
namespace App\Repositories;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Manage service data from data source
*/

use App\Repositories\Contracts\ServiceRepositoryInterface;
use App\Data\Service;
use App\Models\ServiceModel;

class ServiceRepository implements ServiceRepositoryInterface{
	private $serviceModel;

	public function __construct(){
		$this->serviceModel = new ServiceModel();
	}

	public function createService(Service $service){
		$this->serviceModel->setData($service);
		return $this->serviceModel->createService();
	}

	public function getBusinessCartegoryService($serviceId){
		return $this->serviceModel->getBusinessCartegoryService($serviceId);
	}
	
	public function loadBusinessCartegoryServices($serviceCartegoryId){
		return $this->serviceModel->getBusinessCartegoryServices($serviceCartegoryId);
	}
	
	public function loadBusinessServices($businessId){
		return $this->serviceModel->getBusinessServices($businessId);
	}
	
	public function updateBusinessService(Service $service){
		$this->serviceModel->setData($service);
		return $this->serviceModel->updateBusinessService();
	}
	
	public function deleteBusinessService($serviceId){
		return $this->serviceModel->deleteBusinessService($serviceId);
	}
}