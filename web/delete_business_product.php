<?php
require_once("vendor/autoload.php");

use App\Data\Product;
use App\Repositories\ProductRepository; 
use App\Middlewares\BusinessCartegoryProduct;

//initialize objects
$product = new Product();
$productRepository = new ProductRepository();
$businessCartegoryProduct = new BusinessCartegoryProduct($productRepository);

// Data validation

//$productId = $_POST['product_id'];
$productId = 1;

$data = $businessCartegoryProduct->deleteBusinessProduct($productId);

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