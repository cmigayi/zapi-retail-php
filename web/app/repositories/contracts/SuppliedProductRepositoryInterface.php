<?php
namespace App\Repositories\Contracts;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Contract to supplied product repository
*/

use App\Data\SuppliedProduct;

interface SuppliedProductRepositoryInterface{

	public function createSuppliedProduct(SuppliedProduct $suppliedProduct);
	
	public function loadBusinessSuppliedProducts($businessId);
}