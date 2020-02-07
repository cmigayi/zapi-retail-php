<?php
namespace App\Repositories\Contracts;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Contract to current asset repository
*/

use App\Data\CurrentAsset;

interface CurrentAssetRepositoryInterface{

	public function createCurrentAsset(CurrentAsset $currentAsset);
	
	public function getBusinessCurrentAssets($businessId);
	
	public function getTotalCurrentAssets($businessId, $startDate, $endDate);	
}