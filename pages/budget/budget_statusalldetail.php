<?php
include 'budget_function.php';
$budgetListHistory = new BudgetResult();
$idbudget = isset($_GET['p']) ? base64_decode($_GET['p']) : '';
$HistoryAll = $budgetListHistory->ProductAndATCBudgetAll($idbudget, $db);
?>
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0"><i class="mdi mdi-cash-multiple"></i> จัดการข้อมูลงบประมาณ </h4>

                    <div class="page-title-right">

                    </div>

                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1"><i class="mdi mdi-format-list-bulleted"></i> รายการรายละเอียดงบประมาณ</h4>
                    </div><!-- end card header -->
                    <div class="card-body">

                        <table id="budgetmanageall" class="table table-bordered dt-responsive nowrap table-striped align-middle table-hover" style="width:100%">
                            <thead>
                                <tr class="text-center">
                                    <th hidden></th>
                                    <th>ประเภท</th>
                                    <th>ชื่อวัสดุ/ครุภัณฑ์</th>
                                    <th>เลขครุภัณฑ์/ประเภทวัสดุ</th>
                                    <th>ราคา</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $sum = '0';
                                foreach ($HistoryAll as $key_hisbd => $value_hisbd) {

                                ?>
                                <tr class="text-center">
                                    <td hidden><?php echo $value_hisbd['TYPEBD']; ?></td>
                                    <td><?php echo $value_hisbd['TYPEBD'] == 'ATC' ? 'วัสดุ':'ครุภัณฑ์'; ?></td>
                                    <td><?php echo $value_hisbd['BDNM']; ?></td>
                                    <td><?php  if($value_hisbd['TYPEBD'] == 'ATC'){ echo $value_hisbd['BDNO'] == '10' ? 'วัสดุสิ้นเปลือง':'วัสดุคงทน'; }else{ echo $value_hisbd['BDNO']; } ?></td>
                                    <td><?php echo number_format($value_hisbd['BDPRICE'],2); ?></td>
                                </tr>

                                <?php
                                 $sum += $value_hisbd['BDPRICE'];
                                } ?>
                                 <tfoot>
                                <tr class="text-center">
                                    <td hidden></td>
                                    <td colspan="2"></td>
                                    <td><b>รวม</b></td>
                                    <td><b><?php echo number_format($sum,2); ?></b></td>
                                </tr>

                            </tbody>
                        </table>


                    </div>
                </div>

            </div>
        </div>

    </div>
</div>