<?php
namespace App\Repositories\Contracts;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Contract to business repository
*/

use App\Data\Business;

interface BusinessRepositoryInterface{

	/**	
	* Create new business
	*
	* @param $business object
	* @return Business object
	*/
	public function createBusiness(Business $business);

	/**	
	* Fetch business
	*
	* @param int($businessId)
	* @return business
	*/
	public function loadBusiness($businessId);

	/**	
	* Fetch only businesses belonging to $businessOwnerId
	*
	* @param int($businessOwnerId)
	* @return businesses
	*/
	public function loadOwnerBusinesses($ownerId);
	
	/**
	* Handle business data update
	*
	* @param none
	* @return array business info 
	*/
	public function updateBusiness(Business $business);
	
	/**
	* Handle business data delete
	*
	* @param business_id
	* @return boolean 
	*/
	public function deleteBusiness($businessId);

}