<?php
date_default_timezone_set("Asia/Bangkok");
$datenow = date('dmY');
require('../../../layouts/config.php');
require('../report_funtion.php');
$ReportResult = new ReportResult();


$strExcelFileName = "รายงานการซ่อมบำรุงครุภัณฑ์_" . $datenow . ".xls";
header("Content-Type: application/x-msexcel; name=\"$strExcelFileName\"");
header("Content-Disposition: inline; filename=\"$strExcelFileName\"");
header("Pragma:no-cache");

$rpfdate = isset($_GET['r1']) ? $_GET['r1'] : '';
$rpldate = isset($_GET['r2']) ? $_GET['r2'] : '';
$rppcdno = isset($_GET['r3']) ? $_GET['r3'] : '';
$rppcdnm =  isset($_GET['r4']) ? $_GET['r4'] : '';
$rpsdate = isset($_GET['r5']) ? $_GET['r5'] : '';
$rpcpn = isset($_GET['r6']) ? $_GET['r6'] : '';
$rpfsave = isset($_GET['r7']) ? $_GET['r7'] : '';
$rpst = isset($_GET['r8']) ? $_GET['r8'] : '';
$rpdst = isset($_GET['r9']) ? $_GET['r9'] : '';
$rpaped = isset($_GET['r10']) ? $_GET['r10'] : '';
$rpedcob = isset($_GET['r11']) ? $_GET['r11'] : '';
$TabAllRP = $ReportResult->RepairAllTabResult($rpfdate, $rpldate, $rppcdno, $rppcdnm, $rpsdate, $rpcpn, $rpfsave, $rpst, $rpdst, $rpaped, $rpedcob, $db); 



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
                <th>วันที่ส่งซ่อม</th>
                <th>วันที่กำหนดแล้วเสร็จ</th>
                <th>เลขทะเบียนครุภัณฑ์</th>
                <th>ชื่อครุภัณฑ์</th>
                <th>ผู้บันทึกข้อมูลการซ่อม</th>
                <th>สถานะการส่งซ่อม</th>
                <th>อาการเสีย</th>
                <th>ค่าใช้จ่ายในการซ่อม</th>
                <th>บริษัทที่ส่งซ่อม</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <?php foreach ($TabAllRP as $key_allrp => $value_allrp) { ?>
                    <td><?php echo $ReportResult->dateToThai($value_allrp['AMS_REPAIR_DATE']); ?></td>
                    <td><?php echo $ReportResult->dateToThai($value_allrp['AMS_REPAIR_SDATE']); ?></td>
                    <td><?php echo $value_allrp['AMS_PRODUCT_NO']; ?></td>
                    <td><?php echo $value_allrp['AMS_PRODUCT_NM']; ?></td>
                    <td><?php echo $value_allrp['AMS_USER_FNAME'] . ' ' . $value_allrp['AMS_USER_LNAME']; ?></td>
                    <td><?php echo $value_allrp['AMS_REPAIR_RSTNM']; ?></td>
                    <td><?php echo $value_allrp['AMS_REPAIR_CAUSE']; ?></td>
                    <td><?php echo number_format($value_allrp['AMS_REPAIR_EXPEN'], 2); ?></td>
                    <td><?php echo $value_allrp['AMS_REPAIR_CPN']; ?></td>

            </tr>
        <?php } ?>

        </tbody>
    </table>
</body>

</html>