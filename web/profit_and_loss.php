<?php
require_once("vendor/autoload.php");

use App\Middlewares\ProfitAndLoss;
use App\Repositories\ProfitAndLossRepository; 

//$businessId = $_POST['business_id'];
$businessId = 3;
$startDate = "2019-11-19";
$endDate = "2019-12-30";

$profitAndLossRepository = new ProfitAndLossRepository();
$profitAndLoss = new ProfitAndLoss($profitAndLossRepository);

$totalRevenue = $profitAndLoss->getBusinessTotalRevenue($businessId, $startDate, $endDate);
echo "Total Revenue: ".$totalRevenue."<br/>";

$totalCostOfStockSold = $profitAndLoss->getBusinessTotalCostOfStockSold($businessId, $startDate, $endDate);
echo "Cost of stock sold: ".$totalCostOfStockSold."<br/>";

$totalRecurryingExpense = $profitAndLoss->getBusinessRecurringExpense($businessId, $startDate, $endDate);
echo "Total recurring expense: ".$totalRecurryingExpense."<br/>";

if($totalRevenue == null && $stockCostSold == null && $totalRecurringExpense == null){	
	$grossProfit = 0.0;
}else{
	$grossProfit = $totalRevenue - ($totalCostOfStockSold + $totalRecurryingExpense);	
}
echo "Gross profit: ".$grossProfit."<br/>";



/* if($data == null){
	$info["status"] = false;
	$info["records"] = 0;	
}else{
	$info["status"] = true;	
	$info["records"] = count($data[0]);
}

$content["info"] = array();
$content["transaction"] = array();
$main["content"] = array();

array_push($content["info"], $info);
array_push($content["transaction"], $data[0]);
array_push($main["content"], $content);

echo json_encode($main, true); */


?>