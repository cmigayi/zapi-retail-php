<?php
namespace App\Middlewares;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* fixed assets data
*/

use App\Repositories\Contracts\FixedAssetRepositoryInterface;

class FixedAssets{
	private $repo;

	public function __construct(FixedAssetRepositoryInterface $repo){
		$this->repo = $repo;
	}
	
	public function getTotalFixedAssets($businessId, $startDate, $endDate){
		return $this->repo->getTotalFixedAssets($businessId, $startDate, $endDate);
	}
	
	public function getBusinessFixedAssets($businessId){
		return $this->repo->getBusinessFixedAssets($businessId);
	}
}	