<?php
namespace App\Repositories;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Manage service cartegory data from data source
*/

use App\Repositories\Contracts\ServiceCartegoryRepositoryInterface;
use App\Data\ServiceCartegory;
use App\Models\ServiceCartegoryModel;

class ServiceCartegoryRepository implements ServiceCartegoryRepositoryInterface{
	private $serviceCartegoryModel;

	public function __construct(){
		$this->serviceCartegoryModel = new ServiceCartegoryModel();
	}

	public function createServiceCartegory(ServiceCartegory $serviceCartegory){
		$this->serviceCartegoryModel->setData($serviceCartegory);
		return $this->serviceCartegoryModel->createServiceCartegory();
	}

	public function loadBusinessServiceCartegories($businessId){
		return $this->serviceCartegoryModel->getBusinessServiceCartegories($businessId);
	}	
}