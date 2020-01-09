<?php
namespace App\Repositories\Contracts;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Contract to inventory repository
*/

use App\Data\Inventory;

interface InventoryRepositoryInterface{

	public function createInventory(Inventory $inventory);
	
	public function getBusinessInventory($businessId);
	
	public function getTotalInventory($businessId, $startDate, $endDate);
	
}