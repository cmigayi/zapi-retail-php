<?php
namespace App\Repositories;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Manage CustomerCredit data from data source
*/

use App\Repositories\Contracts\CustomerCreditRepositoryInterface;
use App\Data\CustomerCredit;
use App\Models\CustomerCreditModel;

class CustomerCreditRepository implements CustomerCreditRepositoryInterface{
	private $customerCreditModel;	

	public function __construct(){
		$this->customerCreditModel = new CustomerCreditModel();
	}

	/**	
	* Create new CustomerCredit
	*
	* @param $customerCredit object
	* @return CustomerCredit object
	*/
	public function createCustomerCredit(CustomerCredit $customerCredit){
		$this->customerCreditModel->setData($customerCredit);
		return $this->customerCreditModel->createCustomerCredit();
	}

	/**	
	* Fetch CustomerCredit
	*
	* @param int($customerCreditId)
	* @return customerCredit
	*/
	public function getCustomerCredit($customerCreditId){
		return $this->customerCreditModel->getCustomerCredit($customerCreditId);
	}
	
	/**
	* Handle customerCredit data retrieval based on customerId
	*
	* @param int($customerId) 
	* @return customerCredit data (CustomerCredit)
	*/
	public function getCustomerCredits($customerId){
		return $this->customerCreditModel->getCustomerCredits($customerId);		
	}

	/**
	* Handle customerCredits data retrieval
	*
	* @param int($businessId)
	* @return array customerCredits info 
	*/
	public function getBusinessCustomerCredits($businessId){
		return $this->customerCreditModel->getBusinessCustomerCredits($businessId);	
	}
	
	/**
	* Handle customerCredit data update
	*
	* @param none
	* @return array customerCredit info 
	*/
	public function updateCustomerCredit(CustomerCredit $customerCredit){
		$this->customerCreditModel->setData($customerCredit);
		return $this->customerCreditModel->updateCustomerCredit();
	}
	
	/**
	* Handle customerCredit data delete
	*
	* @param customerCreditId
	* @return boolean 
	*/
	public function deleteCustomerCredit($customerCreditId){
		return $this->customerCreditModel->deleteCustomerCredit($customerCreditId);
	}
}