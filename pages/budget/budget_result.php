<!-- <div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body"> -->
<?php

include 'budget_function.php';
$budgetAction = new BudgetResult();
$action = isset($_POST['Actionbudget']) ? $_POST['Actionbudget'] : '';
$chkDup = isset($_SESSION['chkDup']) ? $_SESSION['chkDup'] : '0';

if (isset($p)) {

    if ($chkDup == '0') {

        switch ($action) {
            case 'Add':

                $yearbudget = $_POST['txtyear'];
                $sourcebudget = $_POST['txtsource'];
                $edubudget = $_POST['txtedu'];
                $papedbudget = $_POST['txtpaped'];
                $pricebudget = $_POST['txtprice'];
                $toSaveprice = str_replace(',', '', $pricebudget, $var);
                $statusbd = $_POST['txtbdst'];
                $fdate = $_POST['fdate'];
                $fstf = $_POST['fstf'];
                if ($sourcebudget == '103') {
                    $etcbudget = $_POST['txtsourceetc'];
                } else {
                    $etcbudget = "";
                }

                // genidBudget
                $yearMonth = substr(date("Y") + 543, -2);
                $Month = substr(date("m"), -2);
                $year_MaxId = $yearMonth . $Month . '4';
                $data_ad = $budgetAction->show_maxidNew($year_MaxId, $db);
                $maxId = substr($data_ad['0']['MAX_ID'], -4);

                $maxId = ($maxId + 1);
                $maxId = substr("0000" . $maxId, -4);
                $maxId = $Month . "4" . substr("0000" . $maxId, -4);
                $idadgen_2 = $yearMonth . $maxId;
                // echo $idadgen_2;
                // genidBudget

                $InsertBudget = $budgetAction->InsertBudgetYear($idadgen_2, $yearbudget, $sourcebudget, $edubudget, $papedbudget, $toSaveprice, $statusbd, $fdate, $fstf, $etcbudget, $db);

                if ($InsertBudget == '1') {

                    $_SESSION['chkDup'] = '1';
?>
                    <div class="row">
                        <div class="col-xl-4 col-md-12"></div>
                        <div class="col-xl-4 col-md-12">
                            <!-- card -->
                            <!-- <div class="card card-animate">
                                                        <div class="card-body">
                                                            <div class="d-flex align-items-center">
                                                                <div class="flex-grow-1 overflow-hidden">
                                                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">สถานะการบันทึก</p>
                                                                </div>
                                                                <div class="flex-shrink-0">
                                                                </div>
                                                            </div>
                                                            <div class="d-flex align-items-end justify-content-between mt-4">
                                                                <div>
                                                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                                                        <b>บันทึกข้อมูลเรียบร้อย</b>
                                                                    </h4>
                                                                </div>
                                                                <div class="avatar-sm flex-shrink-0">
                                                                    <button class="btn btn-success" onClick="location.href='?Page=budget-manage'">
                                                                        ตกลง
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> -->
                            <!-- end card -->
                        </div><!-- end col -->
                        <div class="col-xl-4 col-md-12" style="display: none;">
                            <button type="button" class="btn btn-primary btn-sm" id="sa-successbd">confrim</button>
                        </div>
                    </div>
                <?php

                } else {

                    $_SESSION['chkDup'] = '1';
                ?>
                    <div class="row">
                        <div class="col-xl-4 col-md-12"></div>
                        <div class="col-xl-4 col-md-12">
                            <!-- card -->
                            <!-- <div class="card card-animate">
                                                        <div class="card-body">
                                                            <div class="d-flex align-items-center">
                                                                <div class="flex-grow-1 overflow-hidden">
                                                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">สถานะการบันทึก</p>
                                                                </div>
                                                                <div class="flex-shrink-0">
                                                                </div>
                                                            </div>
                                                            <div class="d-flex align-items-end justify-content-between mt-4">
                                                                <div>
                                                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                                                        <b>ไม่สามารถบันทึกข้อมูลได้</b>
                                                                    </h4>
                                                                </div>
                                                                <div class="avatar-sm flex-shrink-0">
                                                                    <button class="btn btn-danger" onClick="location.href='?Page=budget-add'">
                                                                        ตกลง
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> -->
                            <!-- end card -->
                        </div><!-- end col -->
                        <div class="col-xl-4 col-md-12" style="display: none;">
                            <button type="button" class="btn btn-primary btn-sm" id="sa-errorbd">confrim</button>
                        </div>
                    </div>
                    <?php
                }


                break;

            case 'Edit':
                // echo 'Edit';
                $yearbudget = $_POST['txtyear'];
                $sourcebudget = $_POST['txtsource'];
                $edubudget = $_POST['txtedu'];
                $papedbudget = $_POST['txtpaped'];
                $pricebudget = $_POST['txtprice'];
                $toSaveprice = str_replace(',', '', $pricebudget, $var);
                $statusbd = $_POST['txtbdst'];
                $fdate = $_POST['fdate'];
                $fstf = $_POST['fstf'];
                if ($sourcebudget == '103') {
                    $etcbudget = $_POST['txtsourceetc'];
                } else {
                    $etcbudget = "";
                }
                $idedit = isset($_POST['IdbudgetEdit']) ? $_POST['IdbudgetEdit'] : '';

                if ($idedit != "") {

                    $updateBudgetYear = $budgetAction->UpdateBudgetYear($idedit, $yearbudget, $sourcebudget, $edubudget, $papedbudget, $toSaveprice, $statusbd, $fdate, $fstf, $etcbudget, $db);
                    if ($updateBudgetYear == '1') {

                        $_SESSION['chkDup'] = '1';
                    ?>
                        <div class="col-xl-4 col-md-12" style="display: none;">
                            <button type="button" class="btn btn-primary btn-sm" id="sa-successbd">confrim</button>
                        </div>
                    <?php

                    } else {

                        $_SESSION['chkDup'] = '1';
                    ?>
                        <div class="col-xl-4 col-md-12" style="display: none;">
                            <button type="button" class="btn btn-primary btn-sm" id="sa-errorbd">confrim</button>
                        </div>
                    <?php
                    }
                } else {

                    $_SESSION['chkDup'] = '1';
                    ?>
                    <div class="col-xl-4 col-md-12" style="display: none;">
                        <button type="button" class="btn btn-primary btn-sm" id="sa-errorbd">confrim</button>
                    </div>
                    <?php



                }

                break;

            case 'Del':

                $statusbd = '99';
                $fstf = $_SESSION['id'];
                $fdate = date('Y-m-d H:i:s');

                $idDel = isset($_POST['txtiddel']) ? $_POST['txtiddel'] : '';
                if ($idDel != "") {
                    $updateDel = $budgetAction->DelBudgetYear($idDel, $statusbd, $fdate, $fstf, $db);
                    if ($updateDel == '1') {

                        $_SESSION['chkDup'] = '1';
                    ?>
                        <div class="col-xl-4 col-md-12" style="display: none;">
                            <button type="button" class="btn btn-primary btn-sm" id="sa-successbd">confrim</button>
                        </div>
                    <?php

                    } else {

                        $_SESSION['chkDup'] = '1';
                    ?>
                        <div class="col-xl-4 col-md-12" style="display: none;">
                            <button type="button" class="btn btn-primary btn-sm" id="sa-errorbd">confrim</button>
                        </div>
                    <?php
                    }
                } else {
                    $_SESSION['chkDup'] = '1';
                    ?>
                    <div class="col-xl-4 col-md-12" style="display: none;">
                        <button type="button" class="btn btn-primary btn-sm" id="sa-errorbd">confrim</button>
                    </div>
                    <?php
                }
                break;

            case 'Restore':

                $statusbd = '10';
                $fstf = $_SESSION['id'];
                $fdate = date('Y-m-d H:i:s');

                $idRe = isset($_POST['txtidrestore']) ? $_POST['txtidrestore'] : '';
                if ($idRe != "") {
                    $updateRe = $budgetAction->DelBudgetYear($idRe, $statusbd, $fdate, $fstf, $db);
                    if ($updateRe == '1') {

                        $_SESSION['chkDup'] = '1';
                    ?>
                        <div class="col-xl-4 col-md-12" style="display: none;">
                            <button type="button" class="btn btn-primary btn-sm" id="sa-successbd">confrim</button>
                        </div>
                    <?php

                    } else {

                        $_SESSION['chkDup'] = '1';
                    ?>
                        <div class="col-xl-4 col-md-12" style="display: none;">
                            <button type="button" class="btn btn-primary btn-sm" id="sa-errorbd">confrim</button>
                        </div>
                    <?php
                    }
                } else {
                    $_SESSION['chkDup'] = '1';
                    ?>
                    <div class="col-xl-4 col-md-12" style="display: none;">
                        <button type="button" class="btn btn-primary btn-sm" id="sa-errorbd">confrim</button>
                    </div>
        <?php
                }
                break;

            default:
                # code...
                break;
        }
    } else {
        $_SESSION['chkDup'] = '1';
        ?>
        <div class="col-xl-4 col-md-12" style="display: none;">
            <button type="button" class="btn btn-primary btn-sm" id="sa-errorbd">confrim</button>
        </div>

<?php



    }
}


?>
<!-- </div>
                </div>
            </div>
        </div>

    </div>
</div> -->