<?php
namespace App\Repositories;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Manage product stock data from data source
*/

use App\Repositories\Contracts\ProductStockRepositoryInterface;
use App\Data\ProductStock;
use App\Models\StockModel;

class ProductStockRepository implements ProductStockRepositoryInterface{
	private $stockModel;

	public function __construct(){
		$this->stockModel = new StockModel();
	}

	public function createProductStock(ProductStock $productStock){
		$this->stockModel->setData($productStock);
		return $this->stockModel->createStock();
	}
	
	public function getStock($productStockId){
		return $this->stockModel->getStock($productStockId);
	}
	
	public function loadBusinessProductsStocks($businessId){
		return $this->stockModel->getBusinessProductsStocks($businessId);
	}
	
	public function updateStock(ProductStock $productStock){
		$this->stockModel->setData($productStock);
		return $this->stockModel->updateStock();
	}
	
	public function deleteStock($productStockId){
		return $this->stockModel->deleteStock($productStockId);
	}
}