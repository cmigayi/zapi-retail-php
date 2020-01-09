<?php
namespace App\Repositories;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Manage current asset data from data source
*/

use App\Repositories\Contracts\CurrentAssetRepositoryInterface;
use App\Models\CurrentAssetModel;
use App\Data\CurrentAsset;

class CurrentAssetRepository implements CurrentAssetRepositoryInterface{
	private $currentAssetModel;	

	public function __construct(){
		$this->currentAssetModel = new CurrentAssetModel();
	}
	
	public function createCurrentAsset(CurrentAsset $currentAsset){
		return $this->currentAssetModel->createCurrentAsset($currentAsset);
	}
	
	public function getBusinessCurrentAssets($businessId){
		return $this->currentAssetModel->getBusinessCurrentAssets($businessId);
	}
	
	public function getTotalCurrentAssets($businessId, $startDate, $endDate){
		return $this->currentAssetModel->getTotalCurrentAssets($businessId, $startDate, $endDate);
	}	
}	