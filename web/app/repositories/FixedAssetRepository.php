<?php
namespace App\Repositories;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Manage fixed asset data from data source
*/

use App\Repositories\Contracts\FixedAssetRepositoryInterface;
use App\Models\FixedAssetModel;
use App\Data\FixedAsset;

class FixedAssetRepository implements FixedAssetRepositoryInterface{
	private $fixedAssetModel;	

	public function __construct(){
		$this->fixedAssetModel = new FixedAssetModel();
	}
	
	public function createFixedAsset(FixedAsset $fixedAsset){
		return $this->fixedAssetModel->createFixedAsset($fixedAsset);
	}
	
	public function getBusinessFixedAssets($businessId){
		return $this->fixedAssetModel->getBusinessFixedAssets($businessId);
	}
	
	public function getTotalFixedAssets($businessId, $startDate, $endDate){
		return $this->fixedAssetModel->getTotalFixedAssets($businessId, $startDate, $endDate);
	}	
}	