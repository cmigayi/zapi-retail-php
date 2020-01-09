<?php
require_once("vendor/autoload.php");

use App\Middlewares\Assets;/* 
use App\Middlewares\CurrentAssets;
use App\Middlewares\FixedAssets;
use App\Middlewares\InventoryAssets;
use App\Repositories\CurrentAssetRepository;
use App\Repositories\FixedAssetRepository;
use App\Repositories\InventoryRepository; */
use App\Repositories\AssetRepository;

$businessId = 3;
$startDate = "2019-11-19";
$endDate = "2019-12-30";

$assetRepo = new AssetRepository();
$assets = new Assets($assetRepo);
$data = $assets->getBusinessAssets($businessId);
print_r($data);
// All current assets
/* $currentAssetRepo = new CurrentAssetRepository();
$currentAssets = new CurrentAssets($currentAssetRepo);
$data = $currentAssets->getBusinessCurrentAssets($businessId);
for($i=0; $i < count($data[0]); $i++){
	echo $data[0][$i]['title'].": ".$data[0][$i]['amount']."<br/>";
} */
// Total of all current assets
/* $totalCurrentAssets = $currentAssets->getTotalCurrentAssets($businessId, $startDate, $endDate);
echo "<br/> Total current assets: ".$totalCurrentAssets; */

// All fixed assets
/* $fixedAssetRepo = new FixedAssetRepository();
$fixedAssets = new FixedAssets($fixedAssetRepo);
$fixedAssetData = $fixedAssets->getBusinessFixedAssets($businessId);
echo "<br/><br/>............Fixed assets............<br/>";
for($i=0; $i < count($fixedAssetData[0]); $i++){
	echo $fixedAssetData[0][$i]['title'].": ".$fixedAssetData[0][$i]['amount']."<br/>";
} */
// Total of all fixed assets
/* $totalFixedAssets = $fixedAssets->getTotalFixedAssets($businessId, $startDate, $endDate);
echo "<br/> Total fixed assets: ".$totalFixedAssets */;

// Inventory
/* $inventoryRepo = new InventoryRepository();
$inventoryAssets = new InventoryAssets($inventoryRepo);
$inventoryData = $inventoryAssets->getBusinessInventory($businessId);
echo "<br/><br/>............Inventory..........<br/>";
for($i=0; $i < count($inventoryData[0]); $i++){
	echo $inventoryData[0][$i]['title'].": ".$inventoryData[0][$i]['amount']."<br/>";
} */
// Total of all inventory
/* $totalInventory = $inventoryAssets->getTotalInventory($businessId, $startDate, $endDate);
echo "<br/> Total inventory: ".$totalInventory; */

// Overall total assets amount
/* $assets = new Assets($assetRepo);
echo "<br/><br/>............Total assets..........<br/>";
$totalAssetsAmount = $assets->getTotalAssets($businessId, $startDate, $endDate);
echo "<br/> Total assets: ".$totalAssetsAmount; */


/* $recordCount = count($data[0]);	

$main["content"] = array();
$content["info"] = array();
$content["businessAgent"] = array();

if($data == null){
	$info["status"] = false;	
}else{
	$info["status"] = true;	
}

$info["records"] = $recordCount;

array_push($content["info"],$info);
array_push($content["businessAgent"],$data[0]);
array_push($main["content"],$content);

echo json_encode($main, true); */