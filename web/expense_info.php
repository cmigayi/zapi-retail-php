<?php
require_once("vendor/autoload.php");

use App\Middlewares\ExpenseInfo;
use App\Repositories\ExpenseRepository;
use App\Data\Expense;

$expenseId = 1;

$expenseRepo = new ExpenseRepository();

$expense = new Expense();
$expenseInfo = new ExpenseInfo($expenseRepo);
$expense = $expenseInfo->getExpense($expenseId);

if($expense == null){
	$info["status"] = false;
	$info["records"] = 0;	
}else{
	$info["status"] = true;
	$info["results"] = 1;
	$data["expense_id"] = $expense->getExpenseId();  
	$data["business_id"] = $expense->getBusinessId();  
	$data["expense_item"] = $expense->getExpenseItem();  
	$data["type"] = $expense->getExpenseType();  
	$data["amount"] = $expense->getAmount(); 
}

$main["content"] = array();
$content["info"] = array();
$content["expense"] = array();

array_push($content["info"],$info);
array_push($content["expense"],$data);
array_push($main["content"],$content);

echo json_encode($main, true);