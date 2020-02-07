<?php
require_once("vendor/autoload.php");

use App\Data\Product;
use App\Repositories\ProductRepository; 
use App\Middlewares\BusinessCartegoryProduct;

//initialize objects
$product = new Product();
$productRepository = new ProductRepository();
$businessCartegoryProduct = new BusinessCartegoryProduct($productRepository);

//Data validation
//$productId = $_POST['product_id'];
$productId = 1;
//$productCartegoryId = $_POST['prod_cartegory'];
$productCartegoryId = 1;
//$employeeId = $_POST['employee_id'];
$employeeId = 1;
//$businessId = $_POST['business_id'];
$businessId = 3;
//$productName = $_POST['prod_name'];
$productName = "Mango";
//$productDesc = $_POST['desc'];
$productDesc = "";
//$price = $_POST['price'];
$price = 550;

//set data
$product->setProductId($productId);
$product->setProductCartegoryId($productCartegoryId);
$product->setEmployeeId($employeeId);
$product->setBusinessId($businessId);
$product->setProductName($productName);
$product->setProductDesc($productDesc);
$product->setPrice($price);

$product = $businessCartegoryProduct->updateBusinessProduct($product);

$main["content"] = array();
$content["info"] = array();
$content["product"] = array();

if($product == null){
	$info["status"] = false;
	$info["records"] = 0;	
}else{
	$info["status"] = true;	
	$info["records"] = 1;
	
	$data['product_id'] = $product->getProductId(); 
	$data['product_cartegory_id'] = $product->getProductCartegoryId(); 
	$data['employee_id'] = $product->getEmployeeId(); 
	$data['business_id'] = $product->getBusinessId(); 
	$data['product_name'] = $product->getProductName(); 
	$data['product_desc'] = $product->getProductDesc(); 
	$data['fee'] = $product->getPrice(); 
	$data['date_time'] = $product->getDateTime(); 
}

array_push($content["info"],$info);
array_push($content["product"],$data);
array_push($main["content"],$content);

echo json_encode($main, true);	