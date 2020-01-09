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

	public function getBusinessCartegoryProduct($productId);
	
	public function loadBusinessCartegoryProducts($productCartegoryId);
	
	public function loadBusinessProducts($businessId);
	
	public function updateBusinessProduct(Product $product);
	
	public function deleteBusinessProduct($productId);
}