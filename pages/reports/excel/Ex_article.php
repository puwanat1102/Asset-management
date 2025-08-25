<?php
date_default_timezone_set("Asia/Bangkok");
$datenow = date('dmY');
require('../../../layouts/config.php');
require('../report_funtion.php');
$ReportResult = new ReportResult();

$strExcelFileName = "รายงานวัสดุ_" . $datenow . ".xls";
header("Content-Type: application/x-msexcel; name=\"$strExcelFileName\"");
header("Content-Disposition: inline; filename=\"$strExcelFileName\"");
header("Pragma:no-cache");


$Atcname = '';
$Atctype = isset($_GET['a2']) ? $_GET['a2'] : '';
$Atcyear = isset($_GET['a3']) ? $_GET['a3'] : '';
$Atcsource = isset($_GET['a4']) ? $_GET['a4'] : '';
$Atcfdate = '';
$Atcldate = '';
$Atcstatus = isset($_GET['a7']) ? $_GET['a7'] : '';
$rpedcob = isset($_GET['a6']) ? $_GET['a6'] : '';

$AllArticel = $ReportResult->ArticleList($Atcname, $Atctype, $Atcyear, $Atcsource, $Atcfdate, $rpedcob, $Atcstatus, $db);

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
                <th>ชื่อวัสดุ</th>
                <th>ประเภทวัสดุ</th>
                <th>จำนวน</th>
                <th>ราคาต่อหน่วย</th>
                <th>วันหมดประกัน</th>
                <th>ปีงบประมาณ แหล่งที่มา</th>
                <th>หน่วยนับ</th>
                <th>วันสิ้นสุดประกัน</th>
                <th>หน่วยงานรับผิดชอบ</th>
                <th>จำนวนคงเหลือ</th>
                <th>วันที่ตรวจสอบยอด</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <?php foreach ($AllArticel as $key_atc => $value_atc) { 
                     $Yearsource = $value_atc["AMS_BUDGET_YEAR"] + 543;
                ?>
                    <td><?php echo $value_atc["AMS_ARTICLE_NM"]; ?></td>
                    <td><?php echo $value_atc["AMS_ARTICLE_TYPENM"]; ?></td>
                    <td><?php echo $value_atc["AMS_ARTICLE_QTY"]; ?></td>
                    <td><?php echo number_format($value_atc["AMS_ARTICLE_PRICE"], 2); ?></td>
                    <td><?php echo $ReportResult->dateToThai($value_atc["AMS_ARTICLE_EXPDATE"]); ?></td>
                    <td><?php echo $Yearsource . ' ' . $value_atc['AMS_BUDGET_SOURCENM'].' '.$value_atc['AMS_BUDGET_CLASSNM']; ?></td>
                    <td><?php echo $value_atc["AMS_ARTICLE_UNIT"]; ?></td>
                    <td><?php echo $ReportResult->dateToThai($value_atc["AMS_ARTICLE_EXPDATE"]); ?></td>
                    <td><?php echo $value_atc["AMS_LCT_NM"]; ?></td>
                    <td><?php echo $value_atc["AMS_ARTICLE_BALANCE"]; ?></td>
                    <td><?php echo $ReportResult->dateToThai($value_atc["AMS_ARTICLE_DBL"]); ?></td>
            </tr>
        <?php } ?>

        </tbody>
    </table>
</body>

</html>