<?php
require_once("vendor/autoload.php");

use App\Middlewares\Suppliers;
use App\Repositories\SupplierRepository;

$verb = $_SERVER['REQUEST_METHOD'];
$url_pieces = explode('/', $_SERVER['PATH_INFO']);
if($url_pieces[1] != "zapi-v1"){	
	return http_response_code(404);
}

$userId = $url_pieces[3];
$businessId = $url_pieces[5];

$supplierRepo = new SupplierRepository();

$suppliers = new Suppliers($supplierRepo);
$data = $suppliers->getBusinessSuppliers($businessId);

$main["content"] = array();
$content["info"] = array();
$content["suppliers"] = array();

if($data == null){
	$info["status"] = false;
	$info["records"] = 0;	
}else{
	$info["status"] = true;	
	$info["records"] = count($data[0]);
}

array_push($content["info"],$info);
array_push($content["suppliers"],$data[0]);
array_push($main["content"],$content);

echo json_encode($main, true);