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

$idSource = isset($_GET['b1']) ? $_GET['b1'] : '';
$AmountToYear = $ReportResult->Amountbudget($idSource, $db);
$YearToBudgetSelect = isset($AmountToYear['0']['AMS_BUDGET_YEAR']) ? $AmountToYear['0']['AMS_BUDGET_YEAR'] + 543 : '';
$SumProduct = $ReportResult->SumpriceToBudget($idSource, 1, $db);
$SumArticle = $ReportResult->SumpriceToBudget($idSource, 2, $db);
$AllAmount =  isset($AmountToYear['0']['AMS_BUDGET_AMOUNT']) ? $AmountToYear['0']['AMS_BUDGET_AMOUNT'] : '0';
$SumPricePDC = isset($SumProduct['0']['SUMPRICEPDC']) ? $SumProduct['0']['SUMPRICEPDC'] : '0';
$SumPriceATC = isset($SumArticle['0']['SUMPRICEATC']) ? $SumArticle['0']['SUMPRICEATC'] : '0';
$BalanceBudget = $AllAmount - ($SumPricePDC + $SumPriceATC);
$cntAll = count($AmountToYear);
if ($cntAll > 0) {
    $b2 = $AmountToYear['0']['AMS_BUDGET_SOURCENM'] . ' ' . $AmountToYear['0']['AMS_BUDGET_CLASSNM'] . ' ' . $AmountToYear['0']['AMS_BUDGET_TYPENM'];
    $ProductList = $ReportResult->ProductAndATCBudgetAllPDF($idSource, 1);
    $ArticleList = $ReportResult->ProductAndATCBudgetAllPDF($idSource, 2);
    $CNTPDC = count($ProductList);
    $CNTATC = count($ArticleList);
}else{ }

$mpdf = new mPDF('th', 'A4-L', '0', 'UTF-8'); //ตั้งค่าหน้ากระดาษ
$mpdf->autoScriptToLang = true;

$mpdf->SetTitle('รายงานการใช้จ่ายงบประมาณ');

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
			<h3  style="text-align:center;">รายงานการใช้จ่ายงบประมาณ<br>คณะเทคโนโลยีสื่อสารมวลชน</h3>
		</div>
		<div align="right" style="margin-top:-30px;">
			<p style="text-align:right;">วันที่ออกรายงาน	' . $THNow . '</p>
		</div>
		<table>
			<tr>
				<td><b>ปีงบประมาณ </b>  ' . $YearToBudgetSelect . '</td>
				<td><b>ที่มางบประมาณ </b> ' . $b2 . '</td>
				<td></td>
				<td></td>
			</tr>
		</table>
		<table>
			<tr>
				<td><b>งบประมาณทั้งหมด </b> ' . number_format($AllAmount,2) . '</td>
				<td><b>ค่าใช้จ่ายครุภัณฑ์ </b> ' . number_format($SumPricePDC,2) . '</td>
				<td><b>ค่าใช้จ่ายวัสดุ </b> ' . number_format($SumPriceATC,2) . '</td>
				<td><b>งบคงเหลือ </b> ' . number_format($BalanceBudget,2) . '</td>
			</tr>
		</table>
		<table>
			<tr>
				<td><b>จำนวนครุภัณฑ์ที่จัดซื้อ </b> ' . $CNTPDC . ' รายการ</td>
				<td><b>จำนวนวัสดุที่จัดซื้อ </b> ' . $CNTATC . ' รายการ</td>
			</tr>
		</table>
		
		';

		$table .= '<div style="padding:10px;"><b>ตารางแสดงข้อมูลการใช้จ่ายงบประมาณ ครุภัณฑ์</b></div>';
		$table .= '<table class="table2 tableborder">
			<thead>
			<tr>
				<th class="tdb">เลขทะเบียนครุภัณฑ์</th>
                <th class="tdb">ชื่อครุภัณฑ์</th>
				<th class="tdb">ชื่อชุดครุภัณฑ์</th>
				<th class="tdb">หน่วยงานรับผิดชอบ</th>
                <th class="tdb">ราคา</th>
                <th class="tdb">สถานที่จัดเก็บ</th>
			</tr>
			</thead><tbody>';
foreach ($ProductList as $key => $value) {
	$table .= '<tr>
				<td class="tdb" >' . $value['AMS_PRODUCT_NO'] . '</td>
				<td class="tdb">' . $value['AMS_PRODUCT_NM'] . '</td>
				<td class="tdb">' . $value['AMS_PRODUCTSET_NO'] . '</td>
				<td class="tdb" >' . $ReportResult->DisplayHeader($value['AMS_PRODUCT_LCT'], 2) . '</td>
				<td class="tdb">' . number_format($value['AMS_PRODUCT_PRICE'], 2) . '</td>
				<td class="tdb" >' . $value['AMS_PRODUCT_LOC'] . '</td>

			</tr>';
}

$table .= '</tbody></table>';


$table2 .= '<div style="padding:10px;"><b>ตารางแสดงข้อมูลการใช้จ่ายงบประมาณ วัสดุ</b></div>';
$table2 .= '<table class="table2 tableborder">
	<thead>
	<tr>
		<th class="tdb">ประเภทวัสดุ</th>
		<th class="tdb">ชื่อวัสดุ</th>
		<th class="tdb">จำนวน</th>
		<th class="tdb">ราคาต่อหน่วย</th>
		<th class="tdb">ราคารวมทั้งหมด</th>
		<th class="tdb">หน่วยงานรับผิดชอบ</th>
	</tr>
	</thead><tbody>';
foreach ($ArticleList as $key_2 => $value_atc) {
$table2 .= '<tr>
		<td class="tdb">' . $value_atc["AMS_ARTICLE_TYPENM"] . '</td>
		<td class="tdb" >' . $value_atc["AMS_ARTICLE_NM"] . '</td>
		<td class="tdb">' . $value_atc["AMS_ARTICLE_QTY"] . '</td>
		<td class="tdb">' . number_format($value_atc["AMS_ARTICLE_PRICE"], 2) . '</td>
		<td class="tdb">' . number_format($value_atc["AMS_ARTICLE_PRICEALL"], 2) . '</td>
		<td class="tdb">' . $value_atc["AMS_LCT_NM"] . '</td>
	</tr>';
}

$table2 .= '</tbody></table>';

$footer = "
			<table width='100%' style='font-size:8pt;'>
				<tr>
					<td width='33%'>วันที่ออกรายงาน: ";

$footer .= "$THNow";

$footer .= "
					</td>
					<td width='33%' align='center'>{PAGENO}/{nbpg}</td>
					<td width='33%' style='text-align: right;'>รายงานการใช้จ่ายงบประมาณ</td>
				</tr>
			</table>";


if ($cntAll > 0) {
	$mpdf->mirrorMargins = 1;
	$mpdf->SetHTMLFooter($footer);
	$mpdf->SetHTMLFooter($footer, 'E');

    $mpdf->WriteHTML($head);
    $mpdf->WriteHTML($table);
    $mpdf->AddPage();
    $mpdf->WriteHTML($table2);
    $mpdf->Output("รายงานการใช้จ่ายงบประมาณ_$datenow.pdf", "D"); //ชื่อตอนดาวน์โหลด pdf D I
}else{

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
	$mpdf->Output("รายงานการใช้จ่ายงบประมาณ_$datenow.pdf", "D");

}
