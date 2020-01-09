<?php
namespace App\Repositories\Contracts;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Contract to customerCredit repository
*/

use App\Data\CustomerCredit;

interface CustomerCreditRepositoryInterface{

	/**	
	* Create new CustomerCredit
	*
	* @param $customerCredit object
	* @return BusinessCredit object
	*/
	public function createCustomerCredit(CustomerCredit $customerCredit);

	/**	
	* Fetch CustomerCredit
	*
	* @param int($customerCreditId)
	* @return customerCredit
	*/
	public function getCustomerCredit($businessCreditId);
	
	/**
	* Handle customerCredit data retrieval based on customerCreditId
	*
	* @param int($customerId) 
	* @return customerCredit data (CustomerCredit)
	*/
	public function getCustomerCredits($customerId);

	/**
	* Handle customerCredits data retrieval
	*
	* @param int($customerId)
	* @return array customerCredits info 
	*/
	public function getBusinessCustomerCredits($businessId);
	
	/**
	* Handle customerCredit data update
	*
	* @param none
	* @return array customerCredit info 
	*/
	public function updateCustomerCredit(CustomerCredit $customerCredit);
	
	/**
	* Handle customerCredit data delete
	*
	* @param customerCreditId
	* @return boolean 
	*/
	public function deleteCustomerCredit($customerCreditId);

}