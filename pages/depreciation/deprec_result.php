<!-- <div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body"> -->
<?php
include 'deprec_function.php';
$deprecAction = new DeprecResult();
$action = isset($_POST['Actiondeprec']) ? $_POST['Actiondeprec'] : '';
$chkDup = isset($_SESSION['chkDup']) ? $_SESSION['chkDup'] : '0';

if (isset($p)) {

    if ($chkDup == '0') {

        switch ($action) {
            case 'Add':
                // echo 'Add';
                // genidDeprecation
                $yearMonth = substr(date("Y") + 543, -2);
                $Month = substr(date("m"), -2);
                $year_MaxId = $yearMonth . $Month . '6';
                $data_ad = $deprecAction->show_maxidNew($year_MaxId, $db);
                $maxId = substr($data_ad['0']['MAX_ID'], -4);

                $maxId = ($maxId + 1);
                $maxId = substr("0000" . $maxId, -4);
                $maxId = $Month . "6" . substr("0000" . $maxId, -4);
                $idadgen_3 = $yearMonth . $maxId;
                // echo $idadgen_3;

                $protype = $_POST['txtprotype'];
                $protypesave = str_replace(' ', '', "$protype");
                // $protim = $_POST['txtprotime'];
                // $derate = number_format($_POST['txtrate'], 2);
                // $toSavederate = str_replace(',', '', $derate, $var);
                $protim ='0';
                $toSavederate='0';
                $destatus = $_POST['txtdcst'];
                $fdate = $_POST['fdate'];
                $fstf = $_POST['fstf'];


                $InsertResultDeprec = $deprecAction->InsertDepre($idadgen_3, $protypesave, $protim, $toSavederate, $destatus, $fstf, $fdate, $db);

                if ($InsertResultDeprec == '1') {

                    $_SESSION['chkDup'] = '1';
?>
                    <div class="row">
                        <div class="col-xl-4 col-md-12"></div>
                        <div class="col-xl-4 col-md-12">
                            
                        </div>
                        <div class="col-xl-4 col-md-12" style="display: none;">
                            <button type="button" class="btn btn-primary btn-sm" id="sa-successdep">confrim</button>
                        </div>
                    </div>
                <?php

                } else {

                    $_SESSION['chkDup'] = '1';
                ?>
                    <div class="row">
                        <div class="col-xl-4 col-md-12"></div>
                        <div class="col-xl-4 col-md-12">
                          
                        </div>
                        <div class="col-xl-4 col-md-12" style="display: none;">
                            <button type="button" class="btn btn-primary btn-sm" id="sa-errordep">confrim</button>
                        </div>
                    </div>
                    <?php
                }

                break;

            case 'Edit':
                // echo 'Edit';
                if ($_POST['Idedit'] != "") {

                    // echo 'Update';
                    $idedit = $_POST['Idedit'];
                    $protype = $_POST['txtprotype'];
                    $protypesave = str_replace(' ', '', "$protype");
                    // $protim = $_POST['txtprotime'];
                    // $derate = number_format($_POST['txtrate'], 2);
                    // $toSavederate = str_replace(',', '', $derate, $var);
                    $protim ='0';
                    $toSavederate='0';
                    $destatus = $_POST['txtdcst'];
                    $fdate = $_POST['fdate'];
                    $fstf = $_POST['fstf'];

                    $updatedp = $deprecAction->UpdateDeprec($idedit, $protypesave, $protim, $toSavederate, $destatus, $fstf, $fdate, $db);


                    if ($updatedp == '1') {

                        $_SESSION['chkDup'] = '1';
                    ?>
                        <div class="col-xl-4 col-md-12" style="display: none;">
                            <button type="button" class="btn btn-primary btn-sm" id="sa-successdep">confrim</button>
                        </div>
                    <?php

                    } else {

                        $_SESSION['chkDup'] = '1';
                    ?>
                        <div class="col-xl-4 col-md-12" style="display: none;">
                            <button type="button" class="btn btn-primary btn-sm" id="sa-errordep">confrim</button>
                        </div>
                    <?php
                    }
                } else {

                    $_SESSION['chkDup'] = '1';
                    ?>
                    <div class="col-xl-4 col-md-12" style="display: none;">
                        <button type="button" class="btn btn-primary btn-sm" id="sa-errordep">confrim</button>
                    </div>
                    <?php

                }
                break;

            case 'Restore':
                // echo 'del';
                if ($_POST['txtidrestore'] != "") {

                    $idre = $_POST['txtidrestore'];
                    $edstf = $_SESSION['id'];
                    $eddate = date('Y-m-d H:i:s');
                    $delstatus = '10';

                    $DelDeptrc = $deprecAction->UpdateDeprecDel($idre, $delstatus, $edstf, $eddate, $db);

                    if ($DelDeptrc == '1') {

                        $_SESSION['chkDup'] = '1';
                    ?>
                        <div class="col-xl-4 col-md-12" style="display: none;">
                            <button type="button" class="btn btn-primary btn-sm" id="sa-successdep">confrim</button>
                        </div>
                    <?php

                    } else {

                        $_SESSION['chkDup'] = '1';
                    ?>
                        <div class="col-xl-4 col-md-12" style="display: none;">
                            <button type="button" class="btn btn-primary btn-sm" id="sa-errordep">confrim</button>
                        </div>
                    <?php
                    }
                } else {
                    $_SESSION['chkDup'] = '1';
                    ?>
                    <div class="col-xl-4 col-md-12" style="display: none;">
                        <button type="button" class="btn btn-primary btn-sm" id="sa-errordep">confrim</button>
                    </div>
                    <?php
                }

                break;

            case 'Del':
                // echo 'del';
                if ($_POST['txtiddel'] != "") {

                    $iddel = $_POST['txtiddel'];
                    $edstf = $_SESSION['id'];
                    $eddate = date('Y-m-d H:i:s');
                    $delstatus = '99';

                    $DelDeptrc = $deprecAction->UpdateDeprecDel($iddel, $delstatus, $edstf, $eddate, $db);

                    if ($DelDeptrc == '1') {

                        $_SESSION['chkDup'] = '1';
                    ?>
                        <div class="col-xl-4 col-md-12" style="display: none;">
                            <button type="button" class="btn btn-primary btn-sm" id="sa-successdep">confrim</button>
                        </div>
                    <?php

                    } else {

                        $_SESSION['chkDup'] = '1';
                    ?>
                        <div class="col-xl-4 col-md-12" style="display: none;">
                            <button type="button" class="btn btn-primary btn-sm" id="sa-errordep">confrim</button>
                        </div>
                    <?php
                    }
                } else {
                    $_SESSION['chkDup'] = '1';
                    ?>
                    <div class="col-xl-4 col-md-12" style="display: none;">
                        <button type="button" class="btn btn-primary btn-sm" id="sa-errordep">confrim</button>
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
            <button type="button" class="btn btn-primary btn-sm" id="sa-errordep">confrim</button>
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