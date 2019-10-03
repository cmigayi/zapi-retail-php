<?php
namespace App\Repositories\Contracts;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Contract to supplier product repository
*/

use App\Data\SupplierProduct;

interface SupplierProductRepositoryInterface{

	public function createSupplierProduct(SupplierProduct $supplierProduct);
	
	public function loadBusinessSupplierProducts($businessId);
}