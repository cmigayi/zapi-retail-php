<?php
namespace App\Repositories;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Manage business data from data source
*/

use App\Repositories\Contracts\BusinessRepositoryInterface;
use App\Data\Business;
use App\Models\BusinessModel;

class BusinessRepository implements BusinessRepositoryInterface{
	private $businessModel;	

	public function __construct(){
		$this->businessModel = new BusinessModel();
	}

	public function createBusiness(Business $business){
		$this->businessModel->setData($business);
		return $this->businessModel->createBusiness();
	}
	
	public function loadBusiness($businessId){		
		return $this->businessModel->getBusiness($businessId);
	}

	public function loadOwnerBusinesses($ownerId){		
		return $this->businessModel->getOwnerBusinesses($ownerId);
	}	
	
	public function updateBusiness(Business $business){
		$this->businessModel->setData($business);
		return $this->businessModel->updateBusiness();
	}
		
	public function deleteBusiness($businessId){
		return $this->businessModel->deleteBusiness($businessId);
	}
} 