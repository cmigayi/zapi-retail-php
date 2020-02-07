<?php
require_once("vendor/autoload.php");

use App\Data\Inventory;
use App\Repositories\AssetRepository; 
use App\Middlewares\AddAsset;

//initialize objects
$inventory = new Inventory();
$assetRepository = new AssetRepository();

//Data validation

//$businessId = $_POST['business_id'];
$businessId = 3;

//$title = $_POST['title'];
$title = "Stock on hand";

//$desc = $_POST['description'];
$desc = "Current available stock";

//$amount = $_POST['amount'];
$amount = 3000;

//set data
$inventory->setBusinessId($businessId); 
$inventory->setTitle($title); 
$inventory->setDescription($desc); 
$inventory->setAmount($amount); 

//set repository
$addAsset = new AddAsset($assetRepository);
$inventory = $addAsset->createInventory($inventory);

if($inventory == null){
	$info["status"] = false;
	$info["results"] = 0;
}else{	
	$info["status"] = true;
	$info["results"] = 1;
	$data["inventory_id"] = $inventory->getInventoryId();  
	$data["business_id"] = $inventory->getBusinessId();  
	$data["title"] = $inventory->getTitle();  
	$data["description"] = $inventory->getDescription();  
	$data["amount"] = $inventory->getAmount();  	
	$data["date_time"] = $inventory->getDateTime();  	
}
$content["info"] = array();
$content["inventory"] = array();
$main["content"] = array();

array_push($content["info"], $info);
array_push($content["inventory"], $data);
array_push($main["content"], $content);

echo json_encode($main, true);
