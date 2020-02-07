<?php
require_once("vendor/autoload.php");

use App\Data\Customer;
use App\Repositories\CustomerRepository; 
use App\Middlewares\CustomerInfo;

//initialize objects
$customer = new Customer();
$customerRepository = new CustomerRepository();
$customerInfo = new CustomerInfo($customerRepository);

// Data validation

//$customerId = $_POST['customer_id'];
$customerId = 1;

$data = $customerInfo->deleteCustomer($customerId);

if($data == null){
	$info["status"] = false;	
}else{	
	$info["status"] = true;
}

$main["content"] = array();
$content["info"] = array();

array_push($content["info"],$info);
array_push($main["content"],$content);

echo json_encode($main, true);