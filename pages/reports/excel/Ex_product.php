<?php
date_default_timezone_set("Asia/Bangkok");
$datenow = date('dmY');
require('../../../layouts/config.php');
require('../report_funtion.php');
$ReportResult = new ReportResult();

$ProductNo = '';
$ProductName = '';
$ProductType = isset($_GET['p3']) ? $_GET['p3'] : '';
$ProductStatus = isset($_GET['p4']) ? $_GET['p4'] : '';
$ProductYear = isset($_GET['p5']) ? $_GET['p5'] : '';
$ProductSource = isset($_GET['p6']) ? $_GET['p6'] : '';
$ProductDatast = isset($_GET['p7']) ? $_GET['p7'] : '';
$ProductSet = '';
$rpedcob = isset($_GET['p8']) ? $_GET['p8'] : '';
$ListAllProduct = $ReportResult->ListProduct($ProductNo, $ProductName, $ProductType, $ProductStatus, $ProductYear, $ProductSource, $ProductDatast, $rpedcob, $db);


$strExcelFileName = "รายงานครุภัณฑ์_" . $datenow . ".xls";
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
                <th>เลขทะเบียนครุภัณฑ์</th>
                <th>ชื่อครุภัณฑ์</th>
                <th>ราคา</th>
                <th>สถานะครุภัณฑ์</th>
                <th>อายุการใช้งาน</th>
                <th>ชุดครุภัณฑ์</th>
                <th>ปีงบประมาณและที่มา</th>
                <th>วันที่หมดประกัน</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <?php foreach ($ListAllProduct as $key => $value) { 
                ?>
                <td><?php echo $value['AMS_PRODUCT_NO']; ?></td>
                <td><?php echo $value['AMS_PRODUCT_NM']; ?></td>
                <td><?php echo number_format($value['AMS_PRODUCT_PRICE'], 2); ?></td>
                <td><?php echo $value['AMS_PRODUCT_STNM']; ?></td>
                <td><?php echo $ReportResult->AgeProduct($value['AMS_PRODUCT_SDATE']); ?></td>
                <td><?php echo $value['AMS_PRODUCTSET_NO']; ?></td>
                <td><?php echo $value['AMS_PRODUCT_YEAR'] + 543 . ' ' . $value['AMS_BUDGET_SOURCENM'].' '.$value['AMS_BUDGET_CLASSNM']; ?></td>
                <td><?php echo $ReportResult->dateToThai($value['AMS_PRODUCT_EXPDATE']); ?></td>   
            </tr>
        <?php } ?>

        </tbody>
    </table>
</body>

</html>