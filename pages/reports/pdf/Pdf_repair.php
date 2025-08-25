<?php
date_default_timezone_set('Asia/Bangkok');
$datenow = date('dmY');
$prdate = date('d/m/');
$pr_year = date('Y') + 543;
$THNow = $prdate . $pr_year;
require('../../../layouts/config.php');
require('../report_funtion.php');
$ReportResult = new ReportResult();
require_once __DIR__ . '../../../../vendor/mpdf/vendor/autoload.php';

// 
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
$cntAll = count($TabAllRP);
// 
if ($cntAll > 0) {
	$rs1 = $rpfdate == "" ? "" : $ReportResult->dateToThai($rpfdate);
	$rs2 = $rpldate == "" ? "" : $ReportResult->dateToThai($rpldate);
	$rs3 = $rpaped == "" ? "ทั้งหมด" : $ReportResult->DisplayHeader($rpaped, 1);
	$rs4 = $rpedcob == "" ? "ทั้งหมด" : $ReportResult->DisplayHeader($rpedcob, 2);
	$rs5 = $rpfsave == "" ? "ทั้งหมด" : $ReportResult->DisplayHeader($rpfsave, 3);
	if ($rpst == '0') {
		$disrpst = "อยู่ระหว่างการซ่อม";
	} elseif ($rpst == '1') {
		$disrpst = "ซ่อมแล้ว";
	} else {
		$disrpst = "ทั้งหมด";
	}

	foreach ($TabAllRP as $value) {
		$ArrayId[] = $value['AMS_REPAIR_ID'];
	}

	$Imid = implode(',', $ArrayId);

	$SuMExpen = $ReportResult->PDFRepair($Imid, 1);
	$SuMSuccess = $ReportResult->PDFRepair($Imid, 2);
	$SuMProcess = $ReportResult->PDFRepair($Imid, 3);
	$DisExpen = isset($SuMExpen['0']['SUMEXPEN']) ? number_format($SuMExpen['0']['SUMEXPEN'], 2) : '0';
	$DisSuccess = isset($SuMSuccess['0']['CNTRP']) ? $SuMSuccess['0']['CNTRP'] : '0';
	$DisProcess = isset($SuMProcess['0']['CNTRP']) ? $SuMProcess['0']['CNTRP'] : '0';
} else {
}




$mpdf = new mPDF('th', 'A4-L', '0', 'UTF-8'); //ตั้งค่าหน้ากระดาษ
$mpdf->autoScriptToLang = true;

$mpdf->SetTitle('รายงานการซ่อมบำรุงครุภัณฑ์');

$head = '
		<style>
			body{
				font-family: "THSarabun";//เรียกใช้font THSarabun สำหรับแสดงผล ภาษาไทย
			}
			td{
				padding: 10px;
			}
			th{
				padding: 8px;
			}
			
			  .table2 {
				width: 100%;
				border-collapse: collapse;
			  }
			  .tableborder {
				border: 1px solid;
			  }
			  .tdb{
				border: 1px solid;
			  }
		</style>

		<div align="center">			 
			<h3  style="text-align:center;">รายงานการซ่อมบำรุงครุภัณฑ์<br>คณะเทคโนโลยีสื่อสารมวลชน</h3>
		</div>
		<div align="right" style="margin-top:-30px;">
			<p style="text-align:right;">วันที่ออกรายงาน	' . $THNow . '</p>
		</div>
		<table>
			<tr>
				<td><b>วันที่ส่งซ่อม </b> ' . $rs1 . '</td>
				<td><b>ถึงวันที่ </b> ' . $rs2 . '</td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td><b>ประเภทครุภัณฑ์ </b> ' . $rs3 . '</td>
				<td><b>หน่วยงานที่รับผิดชอบ </b> ' . $rs4 . '</td>
				<td><b>ผู้บันทึกข้อมูลการซ่อม </b> ' . $rs5 . '</td>
				<td><b>สถานะการส่งซ่อม </b> ' . $disrpst . '</td>
			</tr>
		</table>
		<table>
			<tr>
				<td><b>จำนวนครุภัณฑ์ที่อยู่ระหว่างการซ่อม </b> ' . $DisProcess . '  รายการ</td>
				<td><b>จำนวนครุภัณฑ์ที่ซ่อมแล้ว </b> ' . $DisSuccess . '  รายการ</td>
				<td><b>จำนวนครุภัณฑ์ที่ส่งซ่อมทั้งหมด </b> ' . $cntAll . '  รายการ</td>
			</tr>
			<tr>
				<td><b>ค่าใช้จ่ายในการส่งซ่อมทั้งหมด </b> ' . $DisExpen . '  บาท</td>
				<td></td>
				<td></td>
			</tr>
		</table>
		';
////////////////////////////////////////////////Sethead	
////////////////////////////////////////////////SetTable
$table .= '<div style="padding:10px;"><b>ตารางแสดงข้อมูลการซ่อมบำรุงครุภัณฑ์</b></div>';
$table .= '<table class="table2 tableborder">
	<thead>
	<tr>
		<th class="tdb">วันที่ส่งซ่อม</th>
		<th class="tdb">วันที่กำหนดแล้วเสร็จ</th>
		<th class="tdb">เลขทะเบียนครุภัณฑ์</th>
		<th class="tdb">ชื่อครุภัณฑ์</th>
		<th class="tdb">ค่าใช้จ่ายในการซ่อม</th>
		<th class="tdb">สถานะการส่งซ่อม</th>
	</tr>
	</thead><tbody>';
foreach ($TabAllRP as $key_allrp => $value_allrp) {
	$table .= '<tr>
	<td class="tdb">' . $ReportResult->dateToThai($value_allrp['AMS_REPAIR_DATE']) . '</td>
	<td class="tdb">' . $ReportResult->dateToThai($value_allrp['AMS_REPAIR_SDATE']) . '</td>
	<td class="tdb">' . $value_allrp['AMS_PRODUCT_NO'] . '</td>
	<td class="tdb">' . $value_allrp['AMS_PRODUCT_NM'] . '</td>
	<td class="tdb">' . number_format($value_allrp['AMS_REPAIR_EXPEN'], 2) . '</td>
	<td class="tdb">' . $value_allrp['AMS_REPAIR_RSTNM'] . '</td>
</tr>';
}

$table .= '</tbody></table>';
////////////////////////////////////////////////SetTable
$footer = "
			<table width='100%' style='font-size:8pt;'>
				<tr>
					<td width='33%'>วันที่ออกรายงาน: ";

$footer .= "$THNow";

$footer .= "
					</td>
					<td width='33%' align='center'>{PAGENO}/{nbpg}</td>
					<td width='33%' style='text-align: right;'>รายงานการซ่อมบำรุงครุภัณฑ์</td>
				</tr>
			</table>";


if ($cntAll > 0) {
	$mpdf->mirrorMargins = 1;
	//$mpdf->SetHeader('{PAGENO}.'/'.{nbpg}');
	//$mpdf->setFooter('{PAGENO}');//ใส่เลขหน้าท้ายตาราง
	$mpdf->SetHTMLFooter($footer);
	$mpdf->SetHTMLFooter($footer, 'E');

	$mpdf->WriteHTML($head);
	$mpdf->WriteHTML($table);


	$mpdf->Output("รายงานการซ่อมบำรุงครุภัณฑ์_$datenow.pdf", "D"); //ชื่อตอนดาวน์โหลด pdf D I
} else {
	$mpdf->SetTitle('ไม่พบข้อมูล');
	$head = '
					<style>
						body{
							font-family: "THSarabun";//เรียกใช้font Garuda สำหรับแสดงผล ภาษาไทย
						}
					</style>
					<div align="center">
						<h2 style="text-align:center">ไม่พบข้อมูล</h2>
					</div>';

	$mpdf->WriteHTML($head);
	$mpdf->Output("รายงานการซ่อมบำรุงครุภัณฑ์_$datenow.pdf", "D");
}
