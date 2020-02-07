<?php
require_once("vendor/autoload.php");

use App\Middlewares\Expenses;
use App\Repositories\ExpenseRepository;
use App\Data\Expense;

$businessId = 1;

$expenseRepo = new ExpenseRepository();

$expenses = new Expenses($expenseRepo);
$data = $expenses->getBusinessNonRecurringExpenses($businessId);

if($data == null){
	$info["status"] = false;
	$info["records"] = 0;	
}else{
	$info["status"] = true;	
	$info["records"] = count($data[0]);
}

$main["content"] = array();
$content["info"] = array();
$content["expenses"] = array();

array_push($content["info"],$info);
array_push($content["expenses"],$data[0]);
array_push($main["content"],$content);

echo json_encode($main, true);