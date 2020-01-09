<?php
namespace App\Repositories;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Manage customer data from data source
*/

use App\Data\Customer;
use App\Models\CustomerModel;
use App\Repositories\Contracts\CustomerRepositoryInterface;

class CustomerRepository implements CustomerRepositoryInterface{
	private $customerModel;

	public function __construct(){
		$this->customerModel = new CustomerModel();
	}

	/**
	* Create a new customer
	*
	* @param pass customer data to be stored
	* @return customer data (Customer)
	*/
	public function createCustomer(Customer $customer){
		$this->customerModel->setData($customer);
		return $this->customerModel->createCustomer();
	} 
	
	public function getCustomer($customerId){
		return $this->customerModel->getCustomer($customerId);
	}
	
	public function loadBusinessCustomers($businessId){
		return $this->customerModel->getBusinessCustomers($businessId);
	}
	
	public function updateCustomer(Customer $customer){
		$this->customerModel->setData($customer);
		return $this->customerModel->updateCustomer();
	}
	
	public function deleteCustomer($customerId){
		return $this->customerModel->deleteCustomer($customerId);
	}

}