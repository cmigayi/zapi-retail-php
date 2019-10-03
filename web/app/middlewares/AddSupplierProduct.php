<?php
namespace App\Middlewares;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Create/add new supplier product
*/

use App\Repositories\Contracts\SupplierProductRepositoryInterface;
use App\Data\SupplierProduct;

class AddSupplierProduct{
	private $repo; 

	public function __construct(SupplierProductRepositoryInterface $repo){
		$this->repo = $repo;
	}

	public function createSupplierProduct(SupplierProduct $supplierProduct){
		return $this->repo->createSupplierProduct($supplierProduct);
	}
}