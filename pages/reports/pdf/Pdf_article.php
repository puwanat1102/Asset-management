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

$Atcname = '';
$Atctype = isset($_GET['a2']) ? $_GET['a2'] : '';
$Atcyear = isset($_GET['a3']) ? $_GET['a3'] : '';
$Atcsource = isset($_GET['a4']) ? $_GET['a4'] : '';
$Atcfdate = '';
$Atcldate = '';
$Atcstatus = isset($_GET['a7']) ? $_GET['a7'] : '';
$rpedcob = isset($_GET['a6']) ? $_GET['a6'] : '';

$AllArticel = $ReportResult->ArticleList($Atcname, $Atctype, $Atcyear, $Atcsource, $Atcfdate, $rpedcob, $Atcstatus, $db);
$AllArticelDis = $ReportResult->ArticleListDisplayToKH($Atcname, $Atctype, $Atcyear, $Atcsource, $Atcfdate, $rpedcob, $Atcstatus);
$AmountToYear = $ReportResult->Amountbudget($Atcsource, $db);
$cntAll = count($AllArticel);

if ($cntAll > 0) {
	$a1 = $Atcyear == "" ? "ทั้งหมด" : $Atcyear + 543;
	$a2 = $Atcsource == "" ? "ทั้งหมด" : $AmountToYear['0']['AMS_BUDGET_SOURCENM'] . ' ' . $AmountToYear['0']['AMS_BUDGET_CLASSNM'] . ' ' . $AmountToYear['0']['AMS_BUDGET_TYPENM'];
	if ($Atctype == "10") {
		$a3 = "วัสดุสิ้นเปลือง";
	} elseif ($Atctype == "20") {
		$a3 = "วัสดุคงทน";
	} else {
		$a3 = "ทั้งหมด";
	}
	$a4 = $rpedcob == "" ? "ทั้งหมด" : $ReportResult->DisplayHeader($rpedcob, 2);
	if ($Atcstatus == "0") {
		$a5 = "ยังอยู่ในประกัน";
	} elseif ($Atcstatus == "1") {
		$a5 = "ประกันหมดอายุ";
	} else {
		$a5 = "ทั้งหมด";
	}

	foreach ($AllArticelDis as $value_kh) {
		if ($value_kh['TYPE'] == '10') {
			$DisTOKH10 = $value_kh['CNT'];
		} elseif ($value_kh['TYPE'] == '20') {
			$DisTOKH20 = $value_kh['CNT'];
		} else {
			$DisTOKH10 = 0;
			$DisTOKH20 = 0;
		}
	}
	$DisTOKH10Y = isset($DisTOKH10) ? $DisTOKH10 : 0;
	$DisTOKH20Y = isset($DisTOKH20) ? $DisTOKH20 : 0;

	foreach ($AllArticel as $value) {
		$ArrayId[] = $value['AMS_ARTICLE_ID'];
	}

	$Imid = implode(',', $ArrayId);
	$SuMATC = $ReportResult->PDFRepair($Imid, 4);
	$DisSUMATC = isset($SuMATC['0']['SUMATC']) ? number_format($SuMATC['0']['SUMATC'], 2) : '0';
} else {
}

$mpdf = new mPDF('th', 'A4-L', '0', 'UTF-8'); //ตั้งค่าหน้ากระดาษ
$mpdf->autoScriptToLang = true;

$mpdf->SetTitle('รายงานวัสดุ');

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
			<h3  style="text-align:center;">รายงานวัสดุ<br>คณะเทคโนโลยีสื่อสารมวลชน</h3>
		</div>
		<div align="right" style="margin-top:-30px;">
			<p style="text-align:right;">วันที่ออกรายงาน	' . $THNow . '</p>
		</div>
		<table>
			<tr>
				<td><b>ปีงบประมาณ </b> ' . $a1 . ' </td>
				<td><b>ที่มางบประมาณ </b> ' . $a2 . '</td>
				<td></td>
			</tr>
			<tr>
				<td><b>ประเภทของวัสดุ </b> ' . $a3 . '</td>
				<td><b>หน่วยงานที่รับผิดชอบ </b> ' . $a4 . '</td>
				<td><b>สถานะการรับประกัน </b> ' . $a5 . '</td>
			</tr>
		</table>
		<table>
			<tr>
				<td><b>จำนวนวัสดุทั้งหมด </b> ' . ($DisTOKH10Y + $DisTOKH20Y) . '  รายการ</td>
				<td><b>จำนวนวัสดุสิ้นเปลือง </b>  ' . $DisTOKH10Y . ' รายการ</td>
				<td><b>จำนวนวัสดุคงทน </b>  ' . $DisTOKH20Y . ' รายการ</td>
			</tr>
			</table>
			<table>
			<tr>
				<td><b>ค่าใช้จ่ายในการจัดซื้อวัสดุทั้งหมด </b>  ' . $DisSUMATC . ' บาท</td>
				<td></td>
				<td></td>
			</tr>
		</table>
		
		';

$table .= '<div style="padding:10px;"><b>ตารางแสดงข้อมูลวัสดุ</b></div>';
$table .= '<table class="table2 tableborder">
			<thead>
			<tr>
				<th class="tdb">ชื่อวัสดุ</th>
                <th class="tdb">ประเภทวัสดุ</th>
                <th class="tdb">จำนวน</th>
                <th class="tdb">ราคาต่อหน่วย</th>
                <th class="tdb" width="10%">จำนวน<br>คงเหลือ</th>
                <th class="tdb" width="10%">วันที่ตรวจ<br>สอบยอด</th>
				<th class="tdb">หน่วยงานรับผิดชอบ</th>
			</tr>
			</thead><tbody>';
foreach ($AllArticel as $key_atc => $value_atc) {
	$table .= '<tr>
			<td class="tdb" >' . $value_atc["AMS_ARTICLE_NM"] . '</td>
			<td class="tdb">' . $value_atc["AMS_ARTICLE_TYPENM"] . '</td>
			<td class="tdb">' . $value_atc["AMS_ARTICLE_QTY"] . '</td>
			<td class="tdb">' . number_format($value_atc["AMS_ARTICLE_PRICE"], 2) . '</td>
			<td class="tdb" width="10%">' . $value_atc["AMS_ARTICLE_BALANCE"] . '</td>
			<td class="tdb" width="10%">' . $ReportResult->dateToThai($value_atc["AMS_ARTICLE_DBL"]) . '</td>
			<td class="tdb">' . $value_atc["AMS_LCT_NM"] . '</td>
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
					<td width='33%' style='text-align: right;'>รายงานวัสดุ</td>
				</tr>
			</table>";


if ($cntAll > 0) {

	$mpdf->mirrorMargins = 1;
	$mpdf->SetHTMLFooter($footer);
	$mpdf->SetHTMLFooter($footer, 'E');

	$mpdf->WriteHTML($head);
	$mpdf->WriteHTML($table);
	$mpdf->Output("รายงานวัสดุ_$datenow.pdf", "D"); //ชื่อตอนดาวน์โหลด pdf D I

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
	$mpdf->Output("รายงานวัสดุ_$datenow.pdf", "D");
}
