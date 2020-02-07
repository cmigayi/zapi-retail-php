<?php
namespace App\Repositories\Contracts;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Contract to businessCredit repository
*/

use App\Data\BusinessCredit;

interface BusinessCreditRepositoryInterface{

	/**	
	* Create new BusinessCredit
	*
	* @param $businessCredit object
	* @return BusinessCredit object
	*/
	public function createBusinessCredit(BusinessCredit $businessCredit);

	/**	
	* Fetch BusinessCredit
	*
	* @param int($businessCreditId)
	* @return businessCredit
	*/
	public function getBusinessCredit($businessCreditId);
	
	/**	
	* Fetch supplier BusinessCredit
	*
	* @param int($upplierId)
	* @return businessCredit
	*/
	public function getSupplierBusinessCredit($supplierId);
	
	/**
	* Handle customer businessCredit data retrieval based on businessCreditId
	*
	* @param int($customerId) 
	* @return businessCredit data (BusinessCredit)
	*/
	public function getCustomerBusinessCredit($customerId);

	/**
	* Handle businessCredits data retrieval
	*
	* @param int($businessId)
	* @return array businessCredits info 
	*/
	public function getBusinessCredits($businessId);
	
	/**
	* Handle businessCredit data update
	*
	* @param none
	* @return array businessCredit info 
	*/
	public function updateBusinessCredit(BusinessCredit $businessCredit);
	
	/**
	* Handle businessCredit data delete
	*
	* @param businessCreditId
	* @return boolean 
	*/
	public function deleteBusinessCredit($businessCreditId);

}