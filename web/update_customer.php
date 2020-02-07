<?php
require_once("vendor/autoload.php");

use App\Data\Customer;
use App\Repositories\CustomerRepository; 
use App\Middlewares\CustomerInfo;

use App\Common\Email;
use App\Common\Phone;
use App\Common\InputValidator;

//initialize objects
$customer = new Customer();
$customerRepository = new CustomerRepository();
$customerInfo = new CustomerInfo($customerRepository);
$email = new Email();
$phone = new Phone();
$inputValidator = new InputValidator();

//Data validation
//$customerId = $_POST['customer_id'];
$customerId = 1;

//$employeeId = $_POST['employee_id'];
$employeeId = 1;

//$fname = $_POST['fname'];
$fname = "Jack";
$fname = $inputValidator->validateInput($fname);

//$lname = $_POST['lname'];
$lname = "Newton";
$lname = $inputValidator->validateInput($lname);

//$email = $_POST['email'];
$customerEmail = "jn@gmil.com";
$email->setEmail($customerEmail); 
$customerEmail = $email->validEmail();

//$phone = $_POST['phone'];
$customerPhone = "0734567";
$phone->setPhoneNumber($customerPhone);
$customerPhone = $phone->validPhoneNumber();

//$nationalId = $_POST['nat_id'];
$nationalId = "84567567";

//set data
$customer->setCustomerId($customerId);
$customer->setBusinessId($employeeId);
$customer->setFname($fname);
$customer->setLname($lname);
$customer->setEmail($customerEmail);
$customer->setPhone($customerPhone);
$customer->setNationalId($nationalId);

if(empty($customerEmail) || empty($customerPhone)){
	//Validation failed 
	$info["status"] = false;
	$info["records"] = 0;
}else{
	$customer = $customerInfo->updateCustomer($customer);	
	
	if($customer == null){
		//Validation failed 
		$info["status"] = false;
		$info["records"] = 0;
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
}

$main["content"] = array();
$content["info"] = array();
$content["customer"] = array();

array_push($content["info"],$info);
array_push($content["customer"],$data);
array_push($main["content"],$content);

echo json_encode($main, true);