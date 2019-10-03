<?php
namespace App\Repositories\Contracts;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Contract to Product repository
*/

use App\Data\Product;

interface ProductRepositoryInterface{

	public function createProduct(Product $product);

	public function loadBusinessCartegoryProduct($productId);
	
	public function loadBusinessCartegoryProducts($productCartegoryId);
}