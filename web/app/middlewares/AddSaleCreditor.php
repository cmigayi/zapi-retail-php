<?php
namespace App\Middlewares;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Create/add new sale creditor
*/

use App\Repositories\Contracts\SaleCreditorRepositoryInterface;
use App\Data\SaleCreditor;

class AddSaleCreditor{
	private $repo; 

	public function __construct(SaleCreditorRepositoryInterface $repo){
		$this->repo = $repo;
	}

	public function createSaleCreditor(SaleCreditor $saleCreditor){
		return $this->repo->createSaleCreditor($saleCreditor);
	}
}