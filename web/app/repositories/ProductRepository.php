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

	public function getBusinessCartegoryProduct($productId){
		return $this->productModel->getBusinessCartegoryProduct($productId);
	}
	
	public function loadBusinessCartegoryProducts($productCartegoryId){
		return $this->productModel->getBusinessCartegoryProducts($productCartegoryId);
	}
	
	public function loadBusinessProducts($businessId){
		return $this->productModel->getBusinessProducts($businessId);
	}
	
	public function updateBusinessProduct(Product $product){
		$this->productModel->setData($product);
		return $this->productModel->updateBusinessProduct();
	}
	
	public function deleteBusinessProduct($productId){
		return $this->productModel->deleteBusinessProduct($productId);
	}
}