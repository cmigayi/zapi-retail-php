<?php
require_once("vendor/autoload.php");

use App\Data\Supplier;
use App\Repositories\SupplierRepository; 
use App\Middlewares\SupplierInfo;

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

// Data validation

$data = $supplierInfo->deleteSupplier($supplierId);

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