<?php
namespace App\Repositories\Contracts;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Contract to businessCredit repository
*/

interface AssetRepositoryInterface{
	
	public function getBusinessAssets($businessId);
}