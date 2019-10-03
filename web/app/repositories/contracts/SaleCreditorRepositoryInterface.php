<?php
namespace App\Repositories\Contracts;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Contract to sale creditor repository
*/

use App\Data\SaleCreditor;

interface SaleCreditorRepositoryInterface{

	public function createSaleCreditor(SaleCreditor $saleCreditor);
	
	public function loadBusinessSalesCreditors($businessId);
}