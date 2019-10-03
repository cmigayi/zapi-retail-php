<?php
namespace App\Repositories;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Manage product data from data source
*/

use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Data\Product;
use App\Models\ProductModel;

class ProductRepository implements ProductRepositoryInterface{
	private $productModel;

	public function __construct(){
		$this->productModel = new ProductModel();
	}

	public function createProduct(Product $product){
		$this->productModel->setData($product);
		return $this->productModel->createProduct();
	}

	public function loadBusinessCartegoryProduct($productId){
		return $this->productModel->getBusinessCartegoryProduct($productId);
	}
	
	public function loadBusinessCartegoryProducts($productCartegoryId){
		return $this->productModel->getBusinessCartegoryProducts($productCartegoryId);
	}
}