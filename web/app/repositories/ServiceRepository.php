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

	public function loadBusinessCartegoryService($serviceId){
		return $this->serviceModel->getBusinessCartegoryService($serviceId);
	}
	
	public function loadBusinessCartegoryServices($serviceCartegoryId){
		return $this->serviceModel->getBusinessCartegoryServices($serviceCartegoryId);
	}
}