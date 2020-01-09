<?php
namespace App\Middlewares;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* current assets data
*/

use App\Repositories\Contracts\CurrentAssetRepositoryInterface;

use App\Data\CurrentAsset;

class CurrentAssets{
	private $repo;

	public function __construct(CurrentAssetRepositoryInterface $repo){
		$this->repo = $repo;
	}
	
	public function getTotalCurrentAssets($businessId, $startDate, $endDate){
		return $this->repo->getTotalCurrentAssets($businessId, $startDate, $endDate);
	}
	
	public function getBusinessCurrentAssets($businessId){
		return $this->repo->getBusinessCurrentAssets($businessId);
	}
}	