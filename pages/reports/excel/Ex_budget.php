<?php
date_default_timezone_set("Asia/Bangkok");
$datenow = date('dmY');
require('../../../layouts/config.php');
require('../report_funtion.php');
$ReportResult = new ReportResult();

$idSource = isset($_GET['b1']) ? $_GET['b1'] : '';
$HistoryAll = $ReportResult->ProductAndATCBudgetAll($idSource, $db);

$strExcelFileName = "รายงานการใช้จ่ายงบประมาณ_" . $datenow . ".xls";
header("Content-Type: application/x-msexcel; name=\"$strExcelFileName\"");
header("Content-Disposition: inline; filename=\"$strExcelFileName\"");
header("Pragma:no-cache");

?>



<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40">
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
    <table cellspacing="0" width="100%" border="1">
        <thead>
            <tr>
                <th>ประเภท</th>
                <th>ชื่อวัสดุ/ครุภัณฑ์</th>
                <th>เลขครุภัณฑ์/ประเภทวัสดุ</th>
                <th>ราคา</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <?php
                foreach ($HistoryAll as $key_hisbd => $value_hisbd) {
                    $modalARC = $ReportResult->ArticleListToModal($value_hisbd['IDBD'], $value_hisbd['TYPEBD']);
                    $Yearsource = isset($modalARC["0"]["AMS_BUDGET_YEAR"]) ? $modalARC["0"]["AMS_BUDGET_YEAR"] + 543 : "";
                ?>
                    <td><?php echo $value_hisbd['TYPEBD'] == 'ATC' ? 'วัสดุ' : 'ครุภัณฑ์'; ?></td>
                    <td><?php echo $value_hisbd['BDNM']; ?></td>
                    <td><?php if ($value_hisbd['TYPEBD'] == 'ATC') {
                            echo $value_hisbd['BDNO'] == '10' ? 'วัสดุสิ้นเปลือง' : 'วัสดุคงทน';
                        } else {
                            echo $value_hisbd['BDNO'];
                        } ?></td>
                    <td><?php echo number_format($value_hisbd['BDPRICE'], 2); ?></td>
            </tr>
        <?php
                    $sum += $value_hisbd['BDPRICE'];
                } ?>
        </tbody>
        <tfoot>
            <tr class="text-center">
                <td colspan="2"></td>
                <td><b>รวม</b></td>
                <td><b><?php echo number_format($sum, 2); ?></b></td>
            </tr>
        </tfoot>
    </table>
</body>

</html>