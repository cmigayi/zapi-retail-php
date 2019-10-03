<?php
namespace App\Repositories\Contracts;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Contract to Product sale repository
*/

use App\Data\ProductSale;

interface ProductSaleRepositoryInterface{

	public function createProductSale(ProductSale $productSale);
	
	public function loadBusinessProductsSales($businessId);
}