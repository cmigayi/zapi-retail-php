<?php
namespace App\Repositories;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Manage inventory asset data from data source
*/

use App\Repositories\Contracts\InventoryRepositoryInterface;
use App\Models\InventoryModel;
use App\Data\Inventory;

class InventoryRepository implements InventoryRepositoryInterface{
	private $inventoryModel;	

	public function __construct(){
		$this->inventoryModel = new InventoryModel();
	}
	
	public function createInventory(Inventory $inventory){
		return $this->inventoryModel->createInventory($inventory);
	}
	
	public function getBusinessInventory($businessId){
		return $this->inventoryModel->getBusinessInventory($businessId);
	}	
	
	public function getTotalInventory($businessId, $startDate, $endDate){
		return $this->inventoryModel->getTotalInventory($businessId, $startDate, $endDate);
	}	
}	