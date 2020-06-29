<?php
require_once("vendor/autoload.php");

use App\Middlewares\BusinessProductsStocks;
use App\Repositories\ProductStockRepository;

$verb = $_SERVER['REQUEST_METHOD'];
$url_pieces = explode('/', $_SERVER['PATH_INFO']);
if($url_pieces[1] != "zapi-v1"){
	return http_response_code(404);
}

$userId = $url_pieces[3];

$businessId = $url_pieces[5];

//$businessId = 1;

$productStockRepo = new ProductStockRepository();

$businessProductsStocks = new BusinessProductsStocks($productStockRepo);
$data = $businessProductsStocks->getBusinessProductsStocks($businessId);
//print_r($ownerBusinesses);
// Count records found
$recordCount = 0;

$main["content"] = array();
$content["info"] = array();
$content["businessProductsStocks"] = array();

if($data == null){
	$info["status"] = false;
}else{
	$info["status"] = true;
	$recordCount = count($data[0]);
}

$info["records"] = $recordCount;

array_push($content["info"],$info);
array_push($content["businessProductsStocks"],$data[0]);
array_push($main["content"],$content);

echo json_encode($main, true);
