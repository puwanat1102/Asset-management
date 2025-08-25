<?php
require_once('../../layouts/config.php');
require_once('../budget/budget_function.php');
$budgetsum = new BudgetResult();
$action = '';
if ($_GET['action'] == '') {
    $action = $_POST['action'];
} else {
    $action = $_GET['action'];
}

if ($action == 'checkbudget') {
    $error = '';
    $txtsourceatc = $_GET['txtsourceatc'];
    $txtprice = $_GET['txtprice'];
    $toSaveAtcprice = str_replace(',', '', $txtprice, $var);
    $txtcnt = $_GET['txtcnt'];
    $txtpriceed = $_GET['txtpriceed'];
    $toSaveAtcpriceed = str_replace(',', '', $txtpriceed, $var);
    $txtcnted = $_GET['txtcnted'];
    
    $budget1 = $budgetsum->SumPriceAllBudget($txtsourceatc, 1, $db);
    $budget2 = $budgetsum->SumPriceAllBudget($txtsourceatc, 2, $db);
    $budgetall = $budgetsum->EditResultBudget($txtsourceatc, $db);

    $PriceToUse = $toSaveAtcprice * $txtcnt;
    $PriceToUse2 = $toSaveAtcpriceed * $txtcnted;

   if($txtsourceatc != ""){

    if($PriceToUse == $PriceToUse2){
        $error = 'true';
        echo $error;
    }else{

        $SumAllProductToAct = ($budget1['0']['SUMPRICEPRODUCT'] + $budget2['0']['SUMPRICEATC'])-$PriceToUse2;
        $BalanceAll = $budgetall['0']['AMS_BUDGET_AMOUNT'] - $SumAllProductToAct;
        $chkToUse =   $BalanceAll - $PriceToUse;
        $chkerror = number_format($chkToUse,2);

        if($chkToUse < 0){
            $error = 'false';
        }else{
            $error = 'true';
        }
        echo $error;

    }

   }else{

    $error = 'true';
    echo $error;

   }

 

   
}

?>
