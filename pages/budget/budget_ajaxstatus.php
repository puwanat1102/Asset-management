<?php
require_once('../../layouts/config.php');
require_once('../budget/budget_function.php');
$bdsttusAction = new BudgetResult();
function dateToThai($date)
{
    if ($date == "") {
        $ToThai = $date;
    } else {
        $epdate = explode('-', $date);
        $yearThai = $epdate['0'] + 543;
        $ToThai = $epdate['2'] . '/' . $epdate['1'] . '/' . $yearThai;
    }
    if (isset($ToThai)) {
        return $ToThai;
    } else {
        return false;
    }
}

$action = '';
if ($_GET['action'] == '') {
    $action = $_POST['action'];
} else {
    $action = $_GET['action'];
}
if ($action == 'statusbudget') {

    $idbd = isset($_POST['id']) ? $_POST['id'] : '';
    $allBudgetYear = $bdsttusAction->EditResultBudget($idbd, $db);
    $productSumAll = $bdsttusAction->SumPriceAllBudget($idbd,1, $db);
    $atcSumAll = $bdsttusAction->SumPriceAllBudget($idbd,2, $db);

    $SumAllProductToAct = $productSumAll['0']['SUMPRICEPRODUCT']+$atcSumAll['0']['SUMPRICEATC'];
    $BalanceAll = $allBudgetYear['0']['AMS_BUDGET_AMOUNT'] - $SumAllProductToAct;
     


?>

<div class="text-center">
    <form method="post" action="?Page=bd_statusall&p=<?php echo base64_encode($idbd); ?>" target="_blank">
        <button type="submit" class="btn btn-sm btn-warning text-dark"><i class="mdi mdi-list-status"></i> รายละเอียดการใช้งบประมาณ</button>
    </form>
</div>
    <table id="bdstatusall" class="table table-bordered dt-responsive  table-striped align-middle text-wrap table-hover" style="width:100%">
        <thead>
            <tr class="text-center">
                <th>งบประมาณ</th>
                <th>งบประมาณที่ใช้</th>
                <th>งบประมาณคงเหลือ</th>
            </tr>
        </thead>
        <tbody>
            <?php // while ($row = $query->fetch_assoc()) { ?>
                <tr class="text-center">
                    <td><?php echo number_format($allBudgetYear['0']['AMS_BUDGET_AMOUNT'],2); ?></td>
                    <td><?php echo number_format($SumAllProductToAct,2); ?></td>
                    <td><?php echo number_format($BalanceAll,2); ?></td>
                </tr>
                    
            <?php // } ?>
        </tbody>
    </table>
<?php
}

?>