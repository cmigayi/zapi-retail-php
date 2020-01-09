<?php
namespace App\Middlewares;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Fetch business suppliers data
*/

use App\Repositories\Contracts\SupplierRepositoryInterface;

class Suppliers{
	private $repo; 

	public function __construct(SupplierRepositoryInterface $repo){
		$this->repo = $repo;
	}

	public function getBusinessSuppliers($businessId){
		return $this->repo->loadBusinessSuppliers($businessId);
	}
}