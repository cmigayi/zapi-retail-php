<?php
namespace App\Repositories;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Manage product cartegory data from data source
*/

use App\Repositories\Contracts\ProductCartegoryRepositoryInterface;
use App\Data\ProductCartegory;
use App\Models\ProductCartegoryModel;

class ProductCartegoryRepository implements ProductCartegoryRepositoryInterface{
	private $productCartegoryModel;

	public function __construct(){
		$this->productCartegoryModel = new ProductCartegoryModel();
	}

	public function createProductCartegory(ProductCartegory $productCartegory){
		$this->productCartegoryModel->setData($productCartegory);
		return $this->productCartegoryModel->createProductCartegory();
	}

	public function loadBusinessProductCartegories($businessId){
		return $this->productCartegoryModel->getBusinessProductCartegories($businessId);
	}	
}