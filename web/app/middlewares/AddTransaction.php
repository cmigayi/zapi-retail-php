<?php
namespace App\Middlewares;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Create/add new transaction
*/

use App\Repositories\Contracts\TransactionRepositoryInterface;
use App\Data\Transaction;

class AddTransaction{
	private $repo; 

	public function __construct(TransactionRepositoryInterface $repo){
		$this->repo = $repo;
	}

	public function createTransaction(Transaction $transaction){
		return $this->repo->createTransaction($transaction);
	}
}