<?php
namespace App\Middlewares;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* current asset data
*/

use App\Repositories\Contracts\AssetRepositoryInterface;

use App\Data\CurrentAsset;
use App\Data\FixedAsset;
use App\Data\Inventory;

class AddAsset{
	private $repo;

	public function __construct(AssetRepositoryInterface $repo){
		$this->repo = $repo;
	}
	
	/**	
	* CurrentAsset functions
	*
	*/
	public function createCurrentAsset(CurrentAsset $currentAsset){
		return $this->repo->createCurrentAsset($currentAsset);
	}
	
	/**	
	* FixedAsset functions
	*
	*/
	public function createFixedAsset(FixedAsset $fixedAsset){
		return $this->repo->createFixedAsset($fixedAsset);
	}
	
	/**	
	* Inventory functions
	*
	*/
	public function createInventory(Inventory $inventory){
		return $this->repo->createInventory($inventory);
	}
}	