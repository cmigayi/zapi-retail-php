<?php
namespace App\Middlewares;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Overall assets assets data
*/

use App\Repositories\Contracts\AssetRepositoryInterface;

use App\Data\CurrentAsset;

class Assets{
	private $repo;

	public function __construct(AssetRepositoryInterface $repo){
		$this->repo = $repo;
	}
	
	public function getBusinessAssets($businessId){
		return $this->repo->getBusinessAssets($businessId);
	}
	
	public function getTotalAssets($businessId, $startDate, $endDate){
		return $this->repo->getTotalAssets($businessId, $startDate, $endDate);
	}
}	