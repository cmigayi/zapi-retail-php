<?php
require_once("vendor/autoload.php");

use App\Data\Supplier;
use App\Middlewares\SupplierInfo;
use App\Repositories\SupplierRepository;

$verb = $_SERVER['REQUEST_METHOD'];
$url_pieces = explode('/', $_SERVER['PATH_INFO']);
if($url_pieces[1] != "zapi-v1"){	
	return http_response_code(404);
}

$userId = $url_pieces[3];
$supplierId = $url_pieces[5];

$supplier = new Supplier();
$supplierRepo = new SupplierRepository();

$supplierInfo = new SupplierInfo($supplierRepo);
$supplier = $supplierInfo->getSupplier($supplierId);	

if($supplier == null){
	$info["status"] = false;
	$info["records"] = 0;	
}else{
	$info["status"] = true;	
	$info["records"] = 1;
	$data["supplier_id"] = $supplier->getSupplierId();  
	$data["business_id"] = $supplier->getBusinessId();  
	$data["name"] = $supplier->getSupplierName();  
	$data["email"] = $supplier->getEmail();  
	$data["phone"] = $supplier->getPhone();    
	$data["date_time"] = $supplier->getDateTime(); 	
}

$main["content"] = array();
$content["info"] = array();
$content["supplier"] = array();

array_push($content["info"],$info);
array_push($content["supplier"],$data);
array_push($main["content"],$content);

echo json_encode($main, true);