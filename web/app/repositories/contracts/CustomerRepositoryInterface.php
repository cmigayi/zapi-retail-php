<?php
namespace App\Repositories\Contracts;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Contract to Cusotmer repository
*/

use App\Data\Customer;

interface CustomerRepositoryInterface{

	/**
	* Create a new customer
	*
	* @param pass customer data to be stored
	*/
	public function createCustomer(Customer $customer); 
	
	public function getCustomer($customerId);
	
	public function loadBusinessCustomers($businessId);
	
	public function updateCustomer(Customer $customer);
	
	public function deleteCustomer($customerId);
}