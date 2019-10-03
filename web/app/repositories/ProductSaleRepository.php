<?php
namespace App\Repositories;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Manage product sale data from data source
*/

use App\Repositories\Contracts\ProductSaleRepositoryInterface;
use App\Data\ProductSale;
use App\Models\ProductSaleModel;

class ProductSaleRepository implements ProductSaleRepositoryInterface{
	private $productSaleModel;

	public function __construct(){
		$this->productSaleModel = new ProductSaleModel();
	}

	public function createProductSale(ProductSale $productSale){
		$this->productSaleModel->setData($productSale);
		return $this->productSaleModel->createProductSale();
	}
	
	public function loadBusinessProductsSales($businessId){
		return $this->productSaleModel->getBusinessProductsSales($businessId);
	}
}