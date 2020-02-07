<?php
require_once("vendor/autoload.php");

use App\Middlewares\Customers;
use App\Repositories\CustomerRepository;
use App\Data\Customer;

$customerRepo = new CustomerRepository();
$customers = new Customers($customerRepo);

//$businessId = $_POST['business_id']; 
$businessId = 1; 
$data = $customers->getBusinessCustomers($businessId);

$main["content"] = array();
$content["info"] = array();
$content["customers"] = array();

if($data == null){
	$info["status"] = false;
	$info["records"] = 0;	
}else{
	$info["status"] = true;	
	$info["records"] = count($data[0]);
}

array_push($content["info"],$info);
array_push($content["customers"],$data[0]);
array_push($main["content"],$content);

echo json_encode($main, true);