<?php
require_once("vendor/autoload.php");

use App\Data\SaleTransaction;
use App\Repositories\SaleTransactionRepository; 
use App\Middlewares\AddSaleTransaction;
use App\Common\ErrorLogger;

//initialize objects
$saleTransaction = new SaleTransaction();
$saleTransactionRepository = new SaleTransactionRepository();
$log = new ErrorLogger("add_sale_transaction");
$log = $log->initLog();

//Data validation
$businessId = 1;
$transactionNumber = "";
$paymentAmount = 100;
$amountPaid = 1000;
$balance = 900;
$paymentMode = "Cash";

//set data
$saleTransaction->setBusinessId($businessId);
$saleTransaction->setTransactionNumber($transactionNumber);
$saleTransaction->setPaymentAmount($paymentAmount);
$saleTransaction->setAmountPaid($amountPaid);
$saleTransaction->setBalance($balance);
$saleTransaction->setPaymentMode($paymentMode);

//set repository
$addSaleTransaction = new AddSaleTransaction($saleTransactionRepository);

try{
	$saleTransaction = $addSaleTransaction->createSaleTransaction($saleTransaction);
	echo $saleTransaction->getSaleTransactionId()." ".$saleTransaction->getPaymentAmount();

}catch(\Exception $e){
	// logger
	$log->error("Error ".$e->getMessage());
}