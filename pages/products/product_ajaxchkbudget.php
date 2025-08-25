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


    $budget1 = $budgetsum->SumPriceAllBudget($txtsourceatc, 1, $db);
    $budget2 = $budgetsum->SumPriceAllBudget($txtsourceatc, 2, $db);
    $budgetall = $budgetsum->EditResultBudget($txtsourceatc, $db);

    $SumAllProductToAct = $budget1['0']['SUMPRICEPRODUCT'] + $budget2['0']['SUMPRICEATC'];
    $BalanceAll = $budgetall['0']['AMS_BUDGET_AMOUNT'] - $SumAllProductToAct;
    $PriceToUse = $toSaveAtcprice;
    $chkToUse =   $BalanceAll - $PriceToUse;
    $chkerror = number_format($chkToUse, 2);

    if ($txtsourceatc != "") {
        if ($chkToUse < 0) {
            $error = 'false';
        } else {
            $error = 'true';
        }

        echo $error;
    } else {
        $error = 'true';
        echo $error;
    }
}elseif($action == 'checkbudgetset'){

    $error = '';
    $txtsourceatc = $_GET['txtsourceatc'];
    $txtsetprice = $_GET['txtsetprice'];
    $txtsetunit = $_GET['txtsetunit'];
    $toSaveAtcprice1 = str_replace(',', '', $txtsetprice, $var);
    // $toSaveAtcprice = $toSaveAtcprice1 * $txtsetunit;
    $toSaveAtcprice = $toSaveAtcprice1;

    $budget1 = $budgetsum->SumPriceAllBudget($txtsourceatc, 1, $db);
    $budget2 = $budgetsum->SumPriceAllBudget($txtsourceatc, 2, $db);
    $budgetall = $budgetsum->EditResultBudget($txtsourceatc, $db);

    $SumAllProductToAct = $budget1['0']['SUMPRICEPRODUCT'] + $budget2['0']['SUMPRICEATC'];
    $BalanceAll = $budgetall['0']['AMS_BUDGET_AMOUNT'] - $SumAllProductToAct;
    $PriceToUse = $toSaveAtcprice;
    $chkToUse =   $BalanceAll - $PriceToUse;
    $chkerror = number_format($chkToUse, 2);

    if ($txtsourceatc != "") {
        if ($chkToUse < 0) {
            $error = 'false';
        } else {
            $error = 'true';
        }

        echo $error;
    } else {
        $error = 'true';
        echo $error;
    }


}
