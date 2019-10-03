<?php
require_once("vendor/autoload.php");

use App\Middlewares\BusinessCartegoryProduct;
use App\Repositories\ProductRepository;

$productId = 1;

$productRepo = new ProductRepository();

$businessCartegoryProduct = new BusinessCartegoryProduct($productRepo);
$data = $businessCartegoryProduct->getBusinessCartegoryProduct($productId);
//print_r($ownerBusinesses); 
// Count records found
$recordCount = 0;	

$main["content"] = array();
$content["info"] = array();
$content["businessCartegoryProduct"] = array();

if($data == null){
	$info["status"] = false;	
}else{
	$info["status"] = true;	
	$recordCount = count($data[0]);
}

$info["records"] = $recordCount;

array_push($content["info"],$info);
array_push($content["businessCartegoryProduct"],$data[0]);
array_push($main["content"],$content);

echo json_encode($main, true);