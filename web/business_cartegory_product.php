<?php
require_once("vendor/autoload.php");

use App\Middlewares\BusinessCartegoryProduct;
use App\Repositories\ProductRepository;

$productId = 1;

$productRepo = new ProductRepository();

$businessCartegoryProduct = new BusinessCartegoryProduct($productRepo);
$data = $businessCartegoryProduct->getBusinessCartegoryProduct($productId);	

$main["content"] = array();
$content["info"] = array();
$content["product"] = array();

if($data == null){
	$info["status"] = false;
	$info["records"] = 0;	
}else{
	$info["status"] = true;	
	$info["records"] = 1;
}

array_push($content["info"],$info);
array_push($content["product"],$data[0]);
array_push($main["content"],$content);

echo json_encode($main, true);