<?php
namespace App\Middlewares;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Create/add new sale credit
*/

use App\Repositories\Contracts\SaleCreditRepositoryInterface;
use App\Data\SaleCredit;

class AddSaleCredit{
	private $repo; 

	public function __construct(SaleCreditRepositoryInterface $repo){
		$this->repo = $repo;
	}

	public function createSaleCredit(SaleCredit $saleCredit){
		return $this->repo->createSaleCredit($saleCredit);
	}
}