<?php
require_once("vendor/autoload.php");

use App\Middlewares\Transactions;
use App\Repositories\TransactionRepository;
use App\Data\Transaction;

$businessId = 3;

$transactionRepo = new TransactionRepository();

$transactions = new Transactions($saleRepo);
$data = $transactions->getBusinessTransactions($businessId);

if($data == null){
	$info["status"] = false;
	$info["records"] = 0;	
}else{
	$info["status"] = true;	
	$info["records"] = count($data[0]);
}

$main["content"] = array();
$content["info"] = array();
$content["transactions"] = array();

array_push($content["info"],$info);
array_push($content["transactions"],$data[0]);
array_push($main["content"],$content);

echo json_encode($main, true);