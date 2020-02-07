<?php
require_once("vendor/autoload.php");

use App\Data\Expense;
use App\Repositories\ExpenseRepository; 
use App\Middlewares\ExpenseInfo;

//initialize objects
$expense = new Expense();
$expenseRepository = new ExpenseRepository();
$expenseInfo = new ExpenseInfo($expenseRepository);

//Data validation

//$expenseId = $_POST['expense_id'];
$expenseId = 1;
$amount = "405";

//set data
$expense->setExpenseId($expenseId);  
$expense->setAmount($amount); 

//set repository
$expenseInfo = new ExpenseInfo($expenseRepository);
$expense = $expenseInfo->updateExpense($expense);

if($expense == null){
	$info["status"] = false;
	$info["results"] = 0;
}else{	
	$info["status"] = true;
	$info["results"] = 1;
	$data["expense_id"] = $expense->getExpenseId();  
	$data["business_id"] = $expense->getBusinessId();  
	$data["expense_item"] = $expense->getExpenseItem();  
	$data["type"] = $expense->getExpenseType();  
	$data["amount"] = $expense->getAmount();  	
}
$content["info"] = array();
$content["expense"] = array();
$main["content"] = array();

array_push($content["info"], $info);
array_push($content["expense"], $data);
array_push($main["content"], $content);

echo json_encode($main, true);