<?php
namespace App\Repositories\Contracts;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Contract to Product sale repository
*/

use App\Data\ServiceSale;

interface ServiceSaleRepositoryInterface{

	public function createServiceSale(ServiceSale $serviceSale);
	
	public function loadBusinessServicesSales($businessId);
}