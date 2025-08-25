<?php
include 'repair_function.php';
$RepairAction = new RepairResult();
$action = isset($_POST['Actionrepair']) ? $_POST['Actionrepair'] : '';
$chkDup = isset($_SESSION['chkDup']) ? $_SESSION['chkDup'] : '0';

if (isset($p)) {

    if ($chkDup == '0') {
        switch ($action) {

            case 'Add':
                //GenIdRepair
                $yearMonth = substr(date("Y") + 543, -2);
                $Month = substr(date("m"), -2);
                $year_MaxId = $yearMonth . $Month . '7';
                $data_ad = $RepairAction->show_maxidNew($year_MaxId, $db);
                $maxId = substr($data_ad['0']['MAX_ID'], -4);

                $maxId = ($maxId + 1);
                $maxId = substr("0000" . $maxId, -4);
                $maxId = $Month . "7" . substr("0000" . $maxId, -4);
                $idadgen_6 = $yearMonth . $maxId;
                // echo $idadgen_6;

                $IdProductToSave = $_POST['IdProductRepair'];
                $RepairPNO = $_POST['txtrppdcno'];
                $RepairPNM = $_POST['txtrppdcname'];
                $RepairCase = $_POST['txtrpcase'];
                $RepairDate = $_POST['txtrpdate'];
                $RepairDate == "" ? $TosaveRepairDate = 'null' : $TosaveRepairDate = "'" . $RepairAction->dateTosave($RepairDate) . "'";
                $RepairDateSuccess = $_POST['textsuccessdate'];
                $RepairDateSuccess == "" ? $TosaveRepairDateSuccess = 'null' : $TosaveRepairDateSuccess = "'" . $RepairAction->dateTosave($RepairDateSuccess) . "'";
                $RepairPrice = $_POST['txtprice'];
                $toSaveRepairPrice = $RepairAction->strspace($RepairPrice, 2);
                $RepairVender = $_POST['txtvendar'];
                $RepairStatus = $_POST['txtrepairst'];
                $RepairDataST = $_POST['txtstatus'];
                $fdate = $_POST['fdate'];
                $fstf = $_POST['fstf'];

                $InsertRepair =  $RepairAction->InsertRepair($idadgen_6, $RepairPNO, $RepairPNM, $IdProductToSave, $RepairCase, $TosaveRepairDate, $TosaveRepairDateSuccess, $toSaveRepairPrice, $RepairVender, $RepairStatus, $RepairDataST, $fstf, $fdate, $db);
                if ($InsertRepair == '1') {

                    $_SESSION['chkDup'] = '1';
?>
                    <div class="col-xl-4 col-md-12" style="display: none;">
                        <button type="button" class="btn btn-primary btn-sm" id="sa-successrp">confrim</button>
                    </div>


                <?php

                } else {

                    $_SESSION['chkDup'] = '1';
                ?>

                    <div class="col-xl-4 col-md-12" style="display: none;">
                        <button type="button" class="btn btn-primary btn-sm" id="sa-errorrp">confrim</button>
                    </div>
                    <?php
                }
                break;

            case 'Edit':
                $IdRepair = isset($_POST['Idedit']) ? $_POST['Idedit'] : '';
                if ($IdRepair != "") {

                    $RepairCase = $_POST['txtrpcase'];
                    $RepairDate = $_POST['txtrpdate'];
                    $RepairDate == "" ? $TosaveRepairDate = 'null' : $TosaveRepairDate = "'" . $RepairAction->dateTosave($RepairDate) . "'";
                    $RepairDateSuccess = $_POST['textsuccessdate'];
                    $RepairDateSuccess == "" ? $TosaveRepairDateSuccess = 'null' : $TosaveRepairDateSuccess = "'" . $RepairAction->dateTosave($RepairDateSuccess) . "'";
                    $RepairPrice = $_POST['txtprice'];
                    $toSaveRepairPrice = $RepairAction->strspace($RepairPrice, 2);
                    $RepairVender = $_POST['txtvendar'];
                    $RepairStatus = $_POST['txtrepairst'];
                    $RepairDataST = $_POST['txtstatus'];
                    $fdate = $_POST['fdate'];
                    $fstf = $_POST['fstf'];


                    $UpdateRepair = $RepairAction->UpdateRepair($IdRepair, $RepairCase, $TosaveRepairDate, $TosaveRepairDateSuccess, $toSaveRepairPrice, $RepairVender, $RepairStatus, $RepairDataST, $fstf, $fdate, $db);
                    if ($UpdateRepair == '1') {

                        $_SESSION['chkDup'] = '1';
                    ?>
                        <div class="col-xl-4 col-md-12" style="display: none;">
                            <button type="button" class="btn btn-primary btn-sm" id="sa-successrp">confrim</button>
                        </div>


                    <?php

                    } else {

                        $_SESSION['chkDup'] = '1';
                    ?>

                        <div class="col-xl-4 col-md-12" style="display: none;">
                            <button type="button" class="btn btn-primary btn-sm" id="sa-errorrp">confrim</button>
                        </div>
                    <?php
                    }
                } else {

                    $_SESSION['chkDup'] = '1';
                    ?>

                    <div class="col-xl-4 col-md-12" style="display: none;">
                        <button type="button" class="btn btn-primary btn-sm" id="sa-errorrp">confrim</button>
                    </div>
                    <?php

                }

                break;

            case 'Del':

                $IdRepair = isset($_POST['txtiddel']) ? $_POST['txtiddel'] : '';
                if ($IdRepair != "") {

                    $statusDel = '99';
                    $edate = date('Y-m-d H:i:s');
                    $estf = $_SESSION['id'];

                    $DelRepair = $RepairAction->DelRepair($IdRepair, $statusDel, $edate, $estf, $db);
                    if ($DelRepair == '1') {

                        $_SESSION['chkDup'] = '1';
                    ?>
                        <div class="col-xl-4 col-md-12" style="display: none;">
                            <button type="button" class="btn btn-primary btn-sm" id="sa-successrp">confrim</button>
                        </div>


                    <?php

                    } else {

                        $_SESSION['chkDup'] = '1';
                    ?>

                        <div class="col-xl-4 col-md-12" style="display: none;">
                            <button type="button" class="btn btn-primary btn-sm" id="sa-errorrp">confrim</button>
                        </div>
                    <?php
                    }
                } else {

                    $_SESSION['chkDup'] = '1';
                    ?>

                    <div class="col-xl-4 col-md-12" style="display: none;">
                        <button type="button" class="btn btn-primary btn-sm" id="sa-errorrp">confrim</button>
                    </div>
                    <?php

                }

                break;


            case 'Restore':

                $IdRepair = isset($_POST['txtidrestore']) ? $_POST['txtidrestore'] : '';
                if ($IdRepair != "") {

                    $statusDel = '10';
                    $edate = date('Y-m-d H:i:s');
                    $estf = $_SESSION['id'];

                    $DelRepair = $RepairAction->DelRepair($IdRepair, $statusDel, $edate, $estf, $db);
                    if ($DelRepair == '1') {

                        $_SESSION['chkDup'] = '1';
                    ?>
                        <div class="col-xl-4 col-md-12" style="display: none;">
                            <button type="button" class="btn btn-primary btn-sm" id="sa-successrp">confrim</button>
                        </div>


                    <?php

                    } else {

                        $_SESSION['chkDup'] = '1';
                    ?>

                        <div class="col-xl-4 col-md-12" style="display: none;">
                            <button type="button" class="btn btn-primary btn-sm" id="sa-errorrp">confrim</button>
                        </div>
                    <?php
                    }
                } else {

                    $_SESSION['chkDup'] = '1';
                    ?>

                    <div class="col-xl-4 col-md-12" style="display: none;">
                        <button type="button" class="btn btn-primary btn-sm" id="sa-errorrp">confrim</button>
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
            <button type="button" class="btn btn-primary btn-sm" id="sa-errorrp">confrim</button>
        </div>
<?php
    }
} else {
}

?>