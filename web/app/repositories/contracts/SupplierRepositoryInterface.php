<?php
namespace App\Repositories\Contracts;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Contract to supplier repository
*/

use App\Data\Supplier;

interface SupplierRepositoryInterface{

	public function createSupplier(Supplier $supplier);

	public function loadBusinessSupplier($businessId);
	
	public function loadBusinessSuppliers($businessId);
}