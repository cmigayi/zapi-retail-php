<?php 
require_once("vendor/autoload.php");

use App\Data\Transaction;
use App\Repositories\TransactionRepository; 
use App\Middlewares\AddTransaction;

//initialize objects
$transaction = new Transaction();
$transactionRepository = new TransactionRepository();

//Data validation
//$businessId = $_POST['business_id']; 
$businessId = 3; 

//$employeeId = $_POST['employee_id'];
$employeeId = 1;

//$transactionNumber = $_POST['transaction_number'];
$transactionNumber = "0602";

//$cost = $_POST['cost'];
$cost = "800";

//$amountPaid = $_POST['amount_paid'];
$amountPaid = "1000";

//$balance = $_POST['balance'];
$balance = "200";

//$paymentMode = $_POST['payment_mode'];
$paymentMode = "Cash";

//$receipt = $_POST['receipt'];
$receipt = "Email";

//$transactedItems = $_POST['transacted_items'];
$transactedItems = array(
	array(
		"item_id" => 1,
		"item_type" => "Product", 
		"quantity" => 2,
		"items_cost" => 400
	),
	array(
		"item_id" => 1,
		"item_type" => "Product", 
		"quantity" => 1,
		"items_cost" => 200
	),
	array(
		"item_id" => 1,
		"item_type" => "Product", 
		"quantity" => 1,
		"items_cost" => 200
	)
);

//set data
$transaction->setEmployeeId($employeeId);
$transaction->setTransactionNumber($transactionNumber);
$transaction->setBusinessId($businessId);
$transaction->setCost($cost);
$transaction->setAmountPaid($amountPaid);
$transaction->setBalance($balance);
$transaction->setPaymentMode($paymentMode);
$transaction->setReceipt($receipt);
$transaction->setTransactedItems($transactedItems);


//set repository
$addTransaction = new AddTransaction($transactionRepository);
$transaction = $addTransaction->createTransaction($transaction);

if($transaction == null){
	$info["status"] = false;
	$info["results"] = 0;
}else{	
	$info["status"] = true;
	$info["results"] = 1;
	$data["transaction_id"] = $transaction->getTransactionId();  
	$data["employee_id"] = $transaction->getEmployeeId();  
	$data["transaction_number"] = $transaction->getTransactionNumber();   
	$data["business_id"] = $transaction->getBusinessId();  
	$data["cost"] = $transaction->getCost();  
	$data["amount_paid"] = $transaction->getAmountPaid();  
	$data["balance"] = $transaction->getBalance();  
	$data["payment_mode"] = $transaction->getPaymentMode();  
	$data["receipt"] = $transaction->getReceipt();
	$data["transacted_items"] = $transaction->getTransactedItems();   	
	$data["date_time"] = $transaction->getDateTime();   	
}
$content["info"] = array();
$content["transaction"] = array();
$main["content"] = array();

array_push($content["info"], $info);
array_push($content["transaction"], $data);
array_push($main["content"], $content);

echo json_encode($main, true);
