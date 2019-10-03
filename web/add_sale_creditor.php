<?php
require_once("vendor/autoload.php");

use App\Data\SaleCreditor;
use App\Repositories\SaleCreditorRepository; 
use App\Middlewares\AddSaleCreditor;
use App\Common\ErrorLogger;

//initialize objects
$saleCreditor = new SaleCreditor();
$saleCreditorRepository = new SaleCreditorRepository();
$log = new ErrorLogger("add_sale_credit");
$log = $log->initLog();

//Data validation
$businessId = 1;
$customerId = 3;
$amount = 4500;

//set data
$saleCreditor->setBusinessId($businessId);
$saleCreditor->setCustomerId($customerId);
$saleCreditor->setAmount($amount);

//set repository
$addSaleCreditor = new AddSaleCreditor($saleCreditorRepository);

try{
	$saleCreditor = $addSaleCreditor->createSaleCreditor($saleCreditor);
	echo $saleCreditor->getCreditorId()." ".$saleCreditor->getBusinessId();

}catch(\Exception $e){
	// logger
	$log->error("Error ".$e->getMessage());
}