<?php
namespace App\Repositories\Contracts;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Contract to fixed asset repository
*/

use App\Data\FixedAsset;

interface FixedAssetRepositoryInterface{

	public function createFixedAsset(FixedAsset $fixedAsset);
	
	public function getBusinessFixedAssets($businessId);
	
	public function getTotalFixedAssets($businessId, $startDate, $endDate);
	
}