<?php
namespace App\Middlewares;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Inventory assets data
*/

use App\Repositories\Contracts\InventoryRepositoryInterface;

use App\Data\CurrentAsset;

class InventoryAssets{
	private $repo;

	public function __construct(InventoryRepositoryInterface $repo){
		$this->repo = $repo;
	}
	
	public function getTotalInventory($businessId, $startDate, $endDate){
		return $this->repo->getTotalInventory($businessId, $startDate, $endDate);
	}
	
	public function getBusinessInventory($businessId){
		return $this->repo->getBusinessInventory($businessId);
	}
}	