<?php
require_once("vendor/autoload.php");

use App\Data\SaleCredit;
use App\Repositories\SaleCreditRepository; 
use App\Middlewares\AddSaleCredit;
use App\Common\ErrorLogger;

//initialize objects
$saleCredit = new SaleCredit();
$saleCreditRepository = new SaleCreditRepository();
$log = new ErrorLogger("add_sale_credit");
$log = $log->initLog();

//Data validation
$creditorId = 4;
$saleId = 1;
$businessId = 1;
$transactionNumber = "";
$itemType = "product";
$amount = 500;

//set data
$saleCredit->setCreditorId($creditorId);
$saleCredit->setSaleId($saleId);
$saleCredit->setBusinessId($businessId);
$saleCredit->setTransactionNumber($transactionNumber);
$saleCredit->setItemType($itemType);
$saleCredit->setAmount($amount);

//set repository
$addSaleCredit = new AddSaleCredit($saleCreditRepository);

try{
	$saleCredit = $addSaleCredit->createSaleCredit($saleCredit);
	echo $saleCredit->getCreditId()." ".$saleCredit->getCreditorId();

}catch(\Exception $e){
	// logger
	$log->error("Error ".$e->getMessage());
}