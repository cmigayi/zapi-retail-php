<?php
require_once("vendor/autoload.php");

use App\Middlewares\BusinessCartegoryProducts;
use App\Repositories\ProductRepository;

$productCartegoryId = 1;

$productRepo = new ProductRepository();

$businessCartegoryProducts = new BusinessCartegoryProducts($productRepo);
$data = $businessCartegoryProducts->getBusinessCartegoryProducts($productCartegoryId);
//print_r($ownerBusinesses); 
// Count records found
$recordCount = 0;	

$main["content"] = array();
$content["info"] = array();
$content["businessCartegoryProducts"] = array();

if($data == null){
	$info["status"] = false;	
}else{
	$info["status"] = true;	
	$recordCount = count($data[0]);
}

$info["records"] = $recordCount;

array_push($content["info"],$info);
array_push($content["businessCartegoryProducts"],$data[0]);
array_push($main["content"],$content);

echo json_encode($main, true);