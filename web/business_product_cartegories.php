<?php
require_once("vendor/autoload.php");

use App\Middlewares\BusinessProductCartegories;
use App\Repositories\ProductCartegoryRepository;

$businessId = 1;

$productCartegoryRepo = new ProductCartegoryRepository();

$businessProductCartegories = new BusinessProductCartegories($productCartegoryRepo);
$data = $businessProductCartegories->getBusinessProductCartegories($businessId);
//print_r($ownerBusinesses); 
// Count records found
$recordCount = 0;	

$main["content"] = array();
$content["info"] = array();
$content["businessProductCartegories"] = array();

if($data == null){
	$info["status"] = false;	
}else{
	$info["status"] = true;	
	$recordCount = count($data[0]);
}

$info["records"] = $recordCount;

array_push($content["info"],$info);
array_push($content["businessProductCartegories"],$data[0]);
array_push($main["content"],$content);

echo json_encode($main, true);