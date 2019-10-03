<?php
require_once("vendor/autoload.php");

use App\Data\Product;
use App\Repositories\ProductRepository; 
use App\Middlewares\AddProduct;
use App\Common\ErrorLogger;

//initialize objects
$product = new Product();
$productRepository = new ProductRepository();
$log = new ErrorLogger("add_product");
$log = $log->initLog();

//Data validation
$productCartegoryId = 1;
$productName = "Panadol";
$productDesc = "";
$price = 40;
$createdBy = 1;

//set data
$product->setProductCartegoryId($productCartegoryId);
$product->setProductName($productName);
$product->setProductDesc($productDesc);
$product->setPrice($price);
$product->setCreatedBy($createdBy);

//set repository
$addProduct = new AddProduct($productRepository);

try{
	$product = $addProduct->createProduct($product);
	echo $product->getProductId()." ".$product->getProductName();

}catch(\Exception $e){
	// logger
	$log->error("Error ".$e->getMessage());
}