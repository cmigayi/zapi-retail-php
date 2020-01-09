<?php
require_once("vendor/autoload.php");

use App\Middlewares\BusinessCartegoryProducts;
use App\Repositories\ProductRepository;

$productCartegoryId = 1;

$productRepo = new ProductRepository();

$businessCartegoryProducts = new BusinessCartegoryProducts($productRepo);
$data = $businessCartegoryProducts->getBusinessCartegoryProducts($productCartegoryId);

$main["content"] = array();
$content["info"] = array();
$content["products"] = array();

if($data == null){
	$info["status"] = false;
	$info["records"] = 0;	
}else{
	$info["status"] = true;	
	$info["records"] = count($data[0]);
}

array_push($content["info"],$info);
array_push($content["products"],$data[0]);
array_push($main["content"],$content);

echo json_encode($main, true);