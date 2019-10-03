<?php
namespace App\Repositories\Contracts;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Contract to Product stock repository
*/

use App\Data\ProductStock;

interface ProductStockRepositoryInterface{

	public function createProductStock(ProductStock $productStock);
	
	public function loadBusinessProductsStocks($businessId);
}