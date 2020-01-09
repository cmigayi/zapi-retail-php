<?php
namespace App\Repositories;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Manage asset data from data source
*/

use App\Repositories\Contracts\AssetRepositoryInterface;
use App\Models\AssetModel;

class AssetRepository implements AssetRepositoryInterface{
	private $assetModel;	

	public function __construct(){
		$this->assetModel = new AssetModel();
	}
	
	public function getBusinessAssets($businessId){
		return $this->assetModel->getBusinessAssets($businessId);
	}
}	