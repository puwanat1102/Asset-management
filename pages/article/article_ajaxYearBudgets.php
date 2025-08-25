<?php
require_once '../../layouts/config.php';
require_once 'article_function.php';
require_once '../budget/budget_function.php';
$budgetsum = new BudgetResult();
$articleajax = new ArticleResult();

if (!empty($_POST['txtyearatc'])) {
    $YearBG = $_POST["txtyearatc"];
    $resultBudgets = $articleajax->DetailBudgets($YearBG, $db);

    if (!empty($resultBudgets)) {
        $i = 1;
        echo '<option value="">- - กรุณาเลือกที่มา - -</option>';
        foreach ($resultBudgets as $value_bg) {

            $budget1 = $budgetsum->SumPriceAllBudget($value_bg["AMS_BUDGET_ID"], 1, $db);
            $budget2 = $budgetsum->SumPriceAllBudget($value_bg["AMS_BUDGET_ID"], 2, $db);
            $budgetall = $budgetsum->EditResultBudget($value_bg["AMS_BUDGET_ID"], $db);

            $SumAllProductToAct = $budget1['0']['SUMPRICEPRODUCT'] + $budget2['0']['SUMPRICEATC'];
            $BalanceAll = $budgetall['0']['AMS_BUDGET_AMOUNT'] - $SumAllProductToAct;
            $ToBalanceAll = number_format($BalanceAll,2);

            $AmountBG = number_format($value_bg["AMS_BUDGET_AMOUNT"], 2);
            echo '<option value="' . $value_bg["AMS_BUDGET_ID"] . '">' . $i . '. ' . $value_bg["AMS_BUDGET_SOURCENM"] . $value_bg["AMS_BUDGET_CLASSNM"] . $value_bg["AMS_BUDGET_TYPENM"] . ' [' . $AmountBG . '] [ คงเหลือ : ' . $ToBalanceAll . ' ] ' . '</option>';
            $i++;
        }
    } else {
        return false;
    }
}

if (!empty($_POST['txtyearatc2'])) {
    $YearBG = $_POST["txtyearatc2"];
    $resultBudgets = $articleajax->DetailBudgets($YearBG, $db);

    if (!empty($resultBudgets)) {
        $i = 1;
        echo '<option value="">- - กรุณาเลือกที่มา - -</option>';
        foreach ($resultBudgets as $value_bg) {

            $budget1 = $budgetsum->SumPriceAllBudget($value_bg["AMS_BUDGET_ID"], 1, $db);
            $budget2 = $budgetsum->SumPriceAllBudget($value_bg["AMS_BUDGET_ID"], 2, $db);
            $budgetall = $budgetsum->EditResultBudget($value_bg["AMS_BUDGET_ID"], $db);

            $SumAllProductToAct = $budget1['0']['SUMPRICEPRODUCT'] + $budget2['0']['SUMPRICEATC'];
            $BalanceAll = $budgetall['0']['AMS_BUDGET_AMOUNT'] - $SumAllProductToAct;
            $ToBalanceAll = number_format($BalanceAll,2);

            $AmountBG = number_format($value_bg["AMS_BUDGET_AMOUNT"], 2);
            echo '<option value="' . $value_bg["AMS_BUDGET_ID"] . '">' . $i . '. ' . $value_bg["AMS_BUDGET_SOURCENM"] . $value_bg["AMS_BUDGET_CLASSNM"] . $value_bg["AMS_BUDGET_TYPENM"] . ' [' . $AmountBG . '] [ คงเหลือ : ' . $ToBalanceAll . ' ] ' .  '</option>';
            $i++;
        }
    } else {
        return false;
    }
}
