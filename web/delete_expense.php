<?php
require_once("vendor/autoload.php");

use App\Data\Expense;
use App\Repositories\ExpenseRepository; 
use App\Middlewares\ExpenseInfo;

//initialize objects
$expense = new Expense();
$expenseRepository = new ExpenseRepository();
$expenseInfo = new ExpenseInfo($expenseRepository);

// Data validation

//$expenseId = $_POST['expense_id'];
$expenseId = 1;

$data = $expenseInfo->deleteExpense($expenseId);

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