<?php
require_once("vendor/autoload.php");

use App\Data\Customer;
use App\Repositories\CustomerRepository; 
use App\Middlewares\AddCustomer;

//initialize objects
$customer = new Customer();
$customerRepository = new CustomerRepository();

//Data validation
//$employeeId = $_POST['employee_id'];
$employeeId = 1;
//$fname = $_POST['fname'];
$fname = "Jack";
//$lname = $_POST['lname'];
$lname = "Newton";
//$email = $_POST['email'];
$email = "jn@gmil.com";
//$phone = $_POST['phone'];
$phone = "0734567";
//$nationalId = $_POST['nat_id'];
$nationalId = "54567567";

//set data
$customer->setBusinessId($employeeId);
$customer->setFname($fname);
$customer->setLname($lname);
$customer->setEmail($email);
$customer->setPhone($phone);
$customer->setNationalId($nationalId);

//set repository
$addCustomer = new AddCustomer($customerRepository);
$customer = $addCustomer->createCustomer($customer);

if($customer == null){
	$info["status"] = false;
	$info["results"] = 0;
}else{	
	$info["status"] = true;
	$info["results"] = 1;
	$data["customer_id"] = $customer->getCustomerId();  
	$data["business_id"] = $customer->getBusinessId();  
	$data["fname"] = $customer->getFname();  
	$data["lname"] = $customer->getLname();  
	$data["email"] = $customer->getEmail();  
	$data["phone"] = $customer->getPhone();  
	$data["national_id"] = $customer->getNationalId();    
	$data["date_time"] = $customer->getDateTime(); 	
}
$content["info"] = array();
$content["customer"] = array();
$main["content"] = array();

array_push($content["info"], $info);
array_push($content["customer"], $data);
array_push($main["content"], $content);

echo json_encode($main, true);