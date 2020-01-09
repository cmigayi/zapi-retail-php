<?php
require_once("vendor/autoload.php");

use App\Data\Supplier;
use App\Repositories\SupplierRepository; 
use App\Middlewares\AddSupplier;
use App\Common\ErrorLogger;

$verb = $_SERVER['REQUEST_METHOD'];
$url_pieces = explode('/', $_SERVER['PATH_INFO']);
if($url_pieces[1] != "zapi-v1"){	
	return http_response_code(404);
}

$userId = $url_pieces[3];
$businessId = $url_pieces[5];

//initialize objects
$supplier = new Supplier();
$supplierRepository = new SupplierRepository();

//Data validation
$supplierName = $_POST['supplier_name'];
$phone = $_POST['phone'];
$email = $_POST['email'];

//set data
$supplier->setBusinessId($businessId);
$supplier->setSupplierName($supplierName);
$supplier->setPhone($phone);
$supplier->setEmail($email);

//set repository
$addSupplier = new AddSupplier($supplierRepository);

$supplier = $addSupplier->createSupplier($supplier);

if($supplier == null){
	$info["status"] = false;
	$info["results"] = 0;
}else{	
	$info["status"] = true;
	$info["results"] = 1;
	$data["supplier_id"] = $supplier->getSupplierId();  
	$data["business_id"] = $supplier->getBusinessId();  
	$data["name"] = $supplier->getSupplierName();  
	$data["email"] = $supplier->getEmail();  
	$data["phone"] = $supplier->getPhone();    
	$data["date_time"] = $supplier->getDateTime(); 	
}
$content["info"] = array();
$content["supplier"] = array();
$main["content"] = array();

array_push($content["info"], $info);
array_push($content["supplier"], $data);
array_push($main["content"], $content);

echo json_encode($main, true);
