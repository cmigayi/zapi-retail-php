<?php
namespace App\Repositories;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Manage BusinessCredit data from data source
*/

use App\Repositories\Contracts\BusinessCreditRepositoryInterface;
use App\Data\BusinessCredit;
use App\Models\BusinessCreditModel;

class BusinessCreditRepository implements BusinessCreditRepositoryInterface{
	private $businessCreditModel;	

	public function __construct(){
		$this->businessCreditModel = new BusinessCreditModel();
	}

	/**	
	* Create new BusinessCredit
	*
	* @param $businessCredit object
	* @return BusinessCredit object
	*/
	public function createBusinessCredit(BusinessCredit $businessCredit){
		$this->businessCreditModel->setData($businessCredit);
		return $this->businessCreditModel->createBusinessCredit();
	}

	/**	
	* Fetch BusinessCredit
	*
	* @param int($businessCreditId)
	* @return businessCredit
	*/
	public function getBusinessCredit($businessCreditId){
		return $this->businessCreditModel->getBusinessCredit($businessCreditId);
	}
	
	/**	
	* Fetch supplier BusinessCredit
	*
	* @param int($upplierId)
	* @return businessCredit
	*/
	public function getSupplierBusinessCredit($supplierId){
		return $this->businessCreditModel->getSupplierBusinessCredit($supplierId);
	}
	
	/**
	* Handle customer businessCredit data retrieval based on businessCreditId
	*
	* @param int($customerId) 
	* @return businessCredit data (BusinessCredit)
	*/
	public function getCustomerBusinessCredit($customerId){
		return $this->businessCreditModel->getCustomerBusinessCredit($customerId);		
	}

	/**
	* Handle businessCredits data retrieval
	*
	* @param int($businessId)
	* @return array businessCredits info 
	*/
	public function getBusinessCredits($businessId){
		return $this->businessCreditModel->getBusinessCredits($businessId);	
	}
	
	/**
	* Handle businessCredit data update
	*
	* @param none
	* @return array businessCredit info 
	*/
	public function updateBusinessCredit(BusinessCredit $businessCredit){
		$this->businessCreditModel->setData($businessCredit);
		return $this->businessCreditModel->updateBusinessCredit();
	}
	
	/**
	* Handle businessCredit data delete
	*
	* @param businessCreditId
	* @return boolean 
	*/
	public function deleteBusinessCredit($businessCreditId){
		return $this->businessCreditModel->deleteBusinessCredit($businessCreditId);
	}
}