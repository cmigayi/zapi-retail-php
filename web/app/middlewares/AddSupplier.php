<?php
namespace App\Middlewares;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Create/add new supplier
*/

use App\Repositories\Contracts\SupplierRepositoryInterface;
use App\Data\Supplier;

class AddSupplier{
	private $repo; 

	public function __construct(SupplierRepositoryInterface $repo){
		$this->repo = $repo;
	}

	public function createSupplier(Supplier $supplier){
		return $this->repo->createSupplier($supplier);
	}
}