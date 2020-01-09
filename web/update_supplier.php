<?php
require_once("vendor/autoload.php");

use App\Data\Supplier;
use App\Repositories\SupplierRepository; 
use App\Middlewares\SupplierInfo;

use App\Common\Email;
use App\Common\Phone;
use App\Common\InputValidator;
use App\Common\Username;
use App\Common\Password;

$verb = $_SERVER['REQUEST_METHOD'];
$url_pieces = explode('/', $_SERVER['PATH_INFO']);
if($url_pieces[1] != "zapi-v1"){	
	return http_response_code(404);
}

$userId = $url_pieces[3];
$supplierId = $url_pieces[5];

//initialize objects
$supplier = new Supplier();
$supplierRepository = new SupplierRepository();
$supplierInfo = new SupplierInfo($supplierRepository);
$email = new Email();
$phone = new Phone();
$inputValidator = new InputValidator();

//Data validation
$supplierName = $_POST['supplier_name'];
//$supplierName = "Ibrahim logistics";

// Email validation
$supplierEmail = $_POST['email'];
//$supplierEmail = "ibra1@gmail.com";
$email->setEmail($supplierEmail); 
$supplierEmail = $email->validEmail();

// Phone validation
$supplierPhone = $_POST['phone'];
//$supplierPhone = "0718485173";
$phone->setPhoneNumber($supplierPhone);
$supplierPhone = $phone->validPhoneNumber();

// set data
$supplier->setSupplierId($supplierId);
$supplier->setSupplierName($supplierName);
$supplier->setPhone($supplierPhone);
$supplier->setEmail($supplierEmail);

if(empty($supplierEmail) || empty($supplierPhone)){
	//Validation failed 
	$info["status"] = false;
	$info["records"] = 0;
}else{
	$supplier = $supplierInfo->updateSupplier($supplier);

	if($supplier == null){
		$info["status"] = false;	
		$info["result"] = 0;	
	}else{	
		$info["status"] = true;
		$info["result"] = 1;
		$data["supplier_id"] = $supplier->getSupplierId();  
		$data["business_id"] = $supplier->getBusinessId();  
		$data["name"] = $supplier->getSupplierName();  
		$data["email"] = $supplier->getEmail();  
		$data["phone"] = $supplier->getPhone();    
		$data["date_time"] = $supplier->getDateTime(); 	
	}
}

$main["content"] = array();
$content["info"] = array();
$content["supplier"] = array();

array_push($content["info"],$info);
array_push($content["supplier"],$data);
array_push($main["content"],$content);

echo json_encode($main, true);