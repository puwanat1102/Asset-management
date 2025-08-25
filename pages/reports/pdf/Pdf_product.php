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
$ListAllProductDisKH = $ReportResult->ListProductDisplayToKH($ProductNo, $ProductName, $ProductType, $ProductStatus, $ProductYear, $ProductSource, $ProductDatast, $rpedcob);
$AmountToYear = $ReportResult->Amountbudget($ProductSource, $db);
$cntAll = count($ListAllProduct);

if ($cntAll > 0) {

	$p1 = $ProductYear == "" ? "ทั้งหมด" : $ProductYear + 543;
	$p2 = $ProductSource == "" ? "ทั้งหมด" : $AmountToYear['0']['AMS_BUDGET_SOURCENM'] . ' ' . $AmountToYear['0']['AMS_BUDGET_CLASSNM'] . ' ' . $AmountToYear['0']['AMS_BUDGET_TYPENM'];
	$p3 = $ProductType == "" ? "ทั้งหมด" : $ReportResult->DisplayHeader($ProductType, 1);
	$p4 = $rpedcob == "" ? "ทั้งหมด" : $ReportResult->DisplayHeader($rpedcob, 2);
	if ($ProductStatus == "10") {
		$p5 = "ปกติ";
	} elseif ($ProductStatus == "20") {
		$p5 = "เสีย";
	} elseif ($ProductStatus == "30") {
		$p5 = "รอแทงจำหน่าย";
	} elseif ($ProductStatus == "40") {
		$p5 = "แทงจำหน่าย/ตัดออกจากบัญชี";
	} else {
		$p5 = "ทั้งหมด";
	}

	if ($ProductDatast == "0") {
		$p6 = "ยังอยู่ในประกัน";
	} elseif ($ProductDatast == "1") {
		$p6 = "ประกันหมดอายุ";
	} else {
		$p6 = "ทั้งหมด";
	}

	foreach ($ListAllProductDisKH as $value_kh) {
		if ($value_kh['AMS_PRODUCT_ST'] == '10') {
			$DisTOKH10 = $value_kh['CNT'];
		} elseif ($value_kh['AMS_PRODUCT_ST'] == '20') {
			$DisTOKH20 = $value_kh['CNT'];
		} elseif ($value_kh['AMS_PRODUCT_ST'] == '30') {
			$DisTOKH30 = $value_kh['CNT'];
		} elseif ($value_kh['AMS_PRODUCT_ST'] == '40') {
			$DisTOKH40 = $value_kh['CNT'];
		} else {
			$DisTOKH10 = 0;
			$DisTOKH20 = 0;
			$DisTOKH30 = 0;
			$DisTOKH40 = 0;
		}
	}

	$DisTOKH10Y = isset($DisTOKH10) ? $DisTOKH10 : 0;
	$DisTOKH20Y = isset($DisTOKH20) ? $DisTOKH20 : 0;
	$DisTOKH30Y = isset($DisTOKH30) ? $DisTOKH30 : 0;
	$DisTOKH40Y = isset($DisTOKH40) ? $DisTOKH40 : 0;
	$DisTOKHAll = $DisTOKH10Y + $DisTOKH20Y + $DisTOKH30Y + $DisTOKH40Y;

	foreach ($ListAllProduct as $value_1) {
		$ArrayId[] = $value_1['AMS_PRODUCT_ID'];
	}

	$Imid = implode(',', $ArrayId);
	$SuMPD = $ReportResult->PDFRepair($Imid, 5);
	$DisSuMPD = isset($SuMPD['0']['SUMPDC']) ? number_format($SuMPD['0']['SUMPDC'], 2) : '0';
} else {
}

$mpdf = new mPDF('th', 'A4-L', '0', 'UTF-8'); //ตั้งค่าหน้ากระดาษ
$mpdf->autoScriptToLang = true;

$mpdf->SetTitle('รายงานครุภัณฑ์');

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
			<h3  style="text-align:center;">รายงานครุภัณฑ์<br>คณะเทคโนโลยีสื่อสารมวลชน</h3>
		</div>
		<div align="right" style="margin-top:-30px;">
			<p style="text-align:right;">วันที่ออกรายงาน	' . $THNow . '</p>
		</div>
		<table>
			<tr>
				<td><b>ปีงบประมาณ </b>  ' . $p1 . '</td>
				<td><b>ที่มางบประมาณ </b> ' . $p2 . '</td>
				<td></td>
				<td></td>
			</tr>
		</table>
		<table>
			<tr>
				<td><b>ประเภทครุภัณฑ์ </b> ' . $p3 . '</td>
				<td><b>หน่วยงานที่รับผิดชอบ </b> ' . $p4 . '</td>
				<td><b>สถานะครุภัณฑ์ </b> ' . $p5 . '</td>
				<td><b>สถานะการรับประกัน </b> ' . $p6 . '</td>
			</tr>
		</table>
		<table>
			<tr>
				<td><b>จำนวนครุภัณฑ์ทั้งหมด </b>  ' . $DisTOKHAll . ' รายการ</td>
				<td><b>จำนวนครุภัณฑ์ปกติ </b>  ' . $DisTOKH10Y . ' รายการ</td>
				<td><b>จำนวนครุภัณฑ์เสีย </b> ' . $DisTOKH20Y . ' รายการ</td>
			</tr>
			<tr>
				<td><b>จำนวนครุภัณฑ์รอแทงจำหน่าย </b> ' . $DisTOKH30Y . ' รายการ</td>
				<td colspan="2"><b>จำนวนครุภัณฑ์แทงจำหน่าย/ตัดออกจากบัญชี </b> ' . $DisTOKH40Y . ' รายการ</td>
			</tr>
			<tr>
			  <td colspan="3"><b>ค่าใช้จ่ายในการจัดซื้อครุภัณฑ์ทั้งหมด</b> ' . $DisSuMPD . ' บาท</td>
			</tr>
		</table>
		';
$table .= '<div style="padding:10px;"><b>ตารางแสดงข้อมูลครุภัณฑ์</b></div>';
$table .= '<table class="table2 tableborder">
			<thead>
			<tr>
				<th class="tdb">เลขทะเบียนครุภัณฑ์</th>
                <th class="tdb">ชื่อครุภัณฑ์</th>
                <th class="tdb">ราคา</th>
                <th class="tdb">ชื่อชุดครุภัณฑ์</th>
                <th class="tdb">หน่วยงานรับผิดชอบ</th>
                <th class="tdb">สถานะครุภัณฑ์</th>
			</tr>
			</thead><tbody>';
foreach ($ListAllProduct as $key => $value) {
	$table .= '<tr>
				<td class="tdb" >' . $value['AMS_PRODUCT_NO'] . '</td>
				<td class="tdb">' . $value['AMS_PRODUCT_NM'] . '</td>
				<td class="tdb">' . number_format($value['AMS_PRODUCT_PRICE'], 2) . '</td>
				<td class="tdb">' . $value['AMS_PRODUCTSET_NO'] . '</td>
				<td class="tdb" >' . $ReportResult->DisplayHeader($value['AMS_PRODUCT_LCT'], 2) . '</td>
				<td class="tdb" >' . $value['AMS_PRODUCT_STNM'] . '</td>
			</tr>';
}

$table .= '</tbody></table>';
$footer = "
			<table width='100%' style='font-size:8pt;'>
				<tr>
					<td width='33%'>วันที่ออกรายงาน: ";

$footer .= "$THNow";

$footer .= "
					</td>
					<td width='33%' align='center'>{PAGENO}/{nbpg}</td>
					<td width='33%' style='text-align: right;'>รายงานครุภัณฑ์</td>
				</tr>
			</table>";




if ($cntAll > 0) {

	$mpdf->mirrorMargins = 1;
	$mpdf->SetHTMLFooter($footer);
	$mpdf->SetHTMLFooter($footer, 'E');

	$mpdf->WriteHTML($head);
	$mpdf->WriteHTML($table);
	$mpdf->Output("รายงานครุภัณฑ์_$datenow.pdf", "D"); //ชื่อตอนดาวน์โหลด pdf D I

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
	$mpdf->Output("รายงานครุภัณฑ์_$datenow.pdf", "D");
}
