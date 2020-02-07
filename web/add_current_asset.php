<?php
require_once("vendor/autoload.php");

use App\Data\CurrentAsset;
use App\Repositories\AssetRepository; 
use App\Middlewares\AddAsset;

//initialize objects
$currentAsset = new CurrentAsset();
$assetRepository = new AssetRepository();

//Data validation

//$businessId = $_POST['business_id'];
$businessId = 3;

//$title = $_POST['title'];
$title = "Petty cash";

//$desc = $_POST['description'];
$desc = "business daily upkeep";

//$amount = $_POST['amount'];
$amount = 10000;

//set data
$currentAsset->setBusinessId($businessId); 
$currentAsset->setTitle($title); 
$currentAsset->setDescription($desc); 
$currentAsset->setAmount($amount); 

//set repository
$addAsset = new AddAsset($assetRepository);
$currentAsset = $addAsset->createCurrentAsset($currentAsset);

if($currentAsset == null){
	$info["status"] = false;
	$info["results"] = 0;
}else{	
	$info["status"] = true;
	$info["results"] = 1;
	$data["current_asset_id"] = $currentAsset->getCurrentAssetId();  
	$data["business_id"] = $currentAsset->getBusinessId();  
	$data["title"] = $currentAsset->getTitle();  
	$data["description"] = $currentAsset->getDescription();  
	$data["amount"] = $currentAsset->getAmount();  	
	$data["date_time"] = $currentAsset->getDateTime();  	
}
$content["info"] = array();
$content["currentAsset"] = array();
$main["content"] = array();

array_push($content["info"], $info);
array_push($content["currentAsset"], $data);
array_push($main["content"], $content);

echo json_encode($main, true);
