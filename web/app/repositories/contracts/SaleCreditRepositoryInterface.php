<?php
namespace App\Repositories\Contracts;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Contract to sale credit repository
*/

use App\Data\SaleCredit;

interface SaleCreditRepositoryInterface{

	public function createSaleCredit(SaleCredit $saleCredit);
	
	public function loadBusinessSalesCredits($businessId);
}