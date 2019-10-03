<?php
namespace App\Middlewares;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Create/add new sale transaction
*/

use App\Repositories\Contracts\SaleTransactionRepositoryInterface;
use App\Data\SaleTransaction;

class AddSaleTransaction{
	private $repo; 

	public function __construct(SaleTransactionRepositoryInterface $repo){
		$this->repo = $repo;
	}

	public function createSaleTransaction(SaleTransaction $saleTransaction){
		return $this->repo->createSaleTransaction($saleTransaction);
	}
}