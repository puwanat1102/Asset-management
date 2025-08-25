<!-- <div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body"> -->
<?php

include 'user_function.php';
$useradd = new UserResult();
$action = isset($_GET['action']) ? $_GET['action'] : '';
$chkDup = isset($_SESSION['chkDup']) ? $_SESSION['chkDup'] : '0';
if (isset($p)) {

    if ($chkDup == '0') {

        switch ($action) {
            case 'Add':


                $yearMonth = substr(date("Y") + 543, -2);
                $Month = substr(date("m"), -2);
                // GenerateIDUser
                $year_MaxId = $yearMonth . $Month . '1';
                $data_ad = $useradd->show_maxidNew($year_MaxId, $db);
                $maxId = substr($data_ad['0']['MAX_ID'], -4);

                $maxId = ($maxId + 1);
                $maxId = substr("0000" . $maxId, -4);
                $maxId = $Month . "1" . substr("0000" . $maxId, -4);
                $idadgen_1 = $yearMonth . $maxId;
                // echo $idadgen_1;
                // GenerateIDUser
                $user_fname = $_POST['txtfname'];
                $user_lname = $_POST['txtlname'];
                if ($_POST['txtpname'] == 'อื่นๆ') {
                    $user_pname = $_POST['txtpnameother'];
                } else {
                    $user_pname = $_POST['txtpname'];
                }
                $user_type = $_POST['txttype'];
                $user_pos = $_POST['txtgrp'];
                $user_sid = $_POST['txtusertype'];
                $user_username = $_POST['txtusernm'];
                $user_password = md5($_POST['txtpassword']);
                $user_st = $_POST['txtuserst'];
                $user_stf = $_POST['fstf'];
                $user_fdate = $_POST['fdate'];

                $InsertUserAll = $useradd->InsertUser($idadgen_1, $user_fname, $user_lname, $user_pname, $user_type, $user_pos, $user_sid, $user_username, $user_password, $user_st, $user_stf, $user_fdate, $db);
                if ($InsertUserAll == '1') {

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
                                                                    <button class="btn btn-success" onClick="location.href='?Page=user-manage'">
                                                                        ตกลง
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> -->
                            <!-- end card -->
                        </div><!-- end col -->
                        <div class="col-xl-4 col-md-12" style="display: none;">
                            <button type="button" class="btn btn-primary btn-sm" id="sa-successuser">confrim</button>
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
                                                                    <button class="btn btn-danger" onClick="location.href='?Page=user-manage'">
                                                                        ตกลง
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> -->
                            <!-- end card -->
                        </div><!-- end col -->
                        <div class="col-xl-4 col-md-12" style="display: none;">
                            <button type="button" class="btn btn-primary btn-sm" id="sa-erroruser">confrim</button>
                        </div>
                    </div>
                <?php
                }



                break;
            case 'Edit':

                $user_fname = $_POST['txtfname'];
                $user_lname = $_POST['txtlname'];
                if ($_POST['txtpname'] == 'อื่นๆ') {
                    $user_pname = $_POST['txtpnameother'];
                } else {
                    $user_pname = $_POST['txtpname'];
                }
                $user_type = $_POST['txttype'];
                $user_pos = $_POST['txtgrp'];
                $user_sid = $_POST['txtusertype'];
                $user_username = $_POST['txtusernm'];
                $user_password = md5($_POST['txtpassword']);
                $user_st = $_POST['txtuserst'];
                $user_stf = $_POST['fstf'];
                $user_fdate = $_POST['fdate'];
                $iduser = $_POST['userid'];
                $chkpassword = $useradd->ListUserAMSEdit($db, $iduser);
                if ($_POST['txtpassword'] == "") {
                    $txtpassworded = $chkpassword['0']['AMS_USER_PW'];
                } else {

                    $txtpassworded = md5($_POST['txtpassword']);
                }

                $updateAMSUser = $useradd->UpdateUserAMS($iduser, $user_fname, $user_lname, $user_pname, $user_type, $user_pos, $user_sid, $user_username, $txtpassworded, $user_st, $user_stf, $user_fdate, $db);
                if ($updateAMSUser == '1') {
                    $_SESSION['chkDup'] = '1';
                ?>

                    <div class="col-xl-4 col-md-12" style="display: none;">
                        <button type="button" class="btn btn-primary btn-sm" id="sa-successuser">confrim</button>
                    </div>


                <?php } else {
                    $_SESSION['chkDup'] = '1';
                ?>

                    <div class="col-xl-4 col-md-12" style="display: none;">
                        <button type="button" class="btn btn-primary btn-sm" id="sa-erroruser">confrim</button>
                    </div>


                <?php
                }


                break;

            case 'Info':

                if ($_POST['txtpname'] == 'อื่นๆ') {
                    $user_pname = $_POST['txtpnameother'];
                } else {
                    $user_pname = $_POST['txtpname'];
                }
                $user_pos = $_POST['txtgrp'];
                $user_stf = $_POST['fstf'];
                $user_fdate = $_POST['fdate'];
                $iduserinfo = $_POST['userid'];

                $updateAMSUserInfo = $useradd->UpdateUserInfoAMS($iduserinfo, $user_pname, $user_pos, $user_stf, $user_fdate, $db);

                if ($updateAMSUserInfo == '1') {
                    $_SESSION['chkDup'] = '1';
                ?>
                    <div class="col-xl-4 col-md-12" style="display: none;">
                        <button type="button" class="btn btn-primary btn-sm" id="sa-successuserinfo">confrim</button>
                    </div>


                <?php } else {
                    $_SESSION['chkDup'] = '1';
                ?>


                    <div class="col-xl-4 col-md-12" style="display: none;">
                        <button type="button" class="btn btn-primary btn-sm" id="sa-erroruserinfo">confrim</button>
                    </div>


                <?php
                }

                break;

            case 'Pass':
                $user_password = md5($_POST['txtpassword']);
                $user_stf = $_POST['fstf'];
                $user_fdate = $_POST['fdate'];
                $iduserinfo = $_POST['userid'];
                $update_password = $useradd->UpdatePassWord($iduserinfo, $user_password, $user_stf, $user_fdate, $db);

                if ($update_password == '1') {
                    $_SESSION['chkDup'] = '1';
                ?>
                    <div class="col-xl-4 col-md-12" style="display: none;">
                        <button type="button" class="btn btn-primary btn-sm" id="sa-successuserpass">confrim</button>
                    </div>

                <?php } else {
                    $_SESSION['chkDup'] = '1';

                ?>


                    <div class="col-xl-4 col-md-12" style="display: none;">
                        <button type="button" class="btn btn-primary btn-sm" id="sa-erroruserpass">confrim</button>
                    </div>


                <?php
                }
                break;

            case 'Del':

                $id =  $_POST['txtiddel'];
                $user_st = '99';
                $user_stf = $_SESSION['id'];
                $user_fdate = date('Y-m-d H:i:s');

                $DeluserTobins = $useradd->UpdateDelstatus($id, $user_st, $user_stf, $user_fdate, $db);


                if ($DeluserTobins == '1') {
                    $_SESSION['chkDup'] = '1';

                ?>

                    <div class="col-xl-4 col-md-12" style="display: none;">
                        <button type="button" class="btn btn-primary btn-sm" id="sa-successuser">confrim</button>
                    </div>


                <?php } else {
                    $_SESSION['chkDup'] = '1';
                ?>


                    <div class="col-xl-4 col-md-12" style="display: none;">
                        <button type="button" class="btn btn-primary btn-sm" id="sa-erroruser">confrim</button>
                    </div>


                <?php
                }

                break;

            case 'Restore':

                $id =  $_POST['txtidrestore'];
                $user_st = '10';
                $user_stf = $_SESSION['id'];
                $user_fdate = date('Y-m-d H:i:s');

                $RestoreuserToUse = $useradd->UpdateDelstatus($id, $user_st, $user_stf, $user_fdate, $db);
                if ($RestoreuserToUse == '1') {
                    $_SESSION['chkDup'] = '1';

                ?>

                    <div class="col-xl-4 col-md-12" style="display: none;">
                        <button type="button" class="btn btn-primary btn-sm" id="sa-successuser">confrim</button>
                    </div>


                <?php } else {
                    $_SESSION['chkDup'] = '1';
                ?>


                    <div class="col-xl-4 col-md-12" style="display: none;">
                        <button type="button" class="btn btn-primary btn-sm" id="sa-erroruser">confrim</button>
                    </div>


                <?php
                }


                break;

            case 'AddLct':

                $fdate = $_POST['fdate'];
                $fstf = $_POST['fstf'];
                $resultLct = $_POST['txtlcts'];
                $resultLctsave = str_replace(' ', '', "$resultLct");
                $statuslct = $_POST['txtlctst'];
                $InsertLctTodata = $useradd->InsertLct($resultLctsave, $statuslct, $fdate, $fstf, $db);

                if ($InsertLctTodata == '1') {

                    $_SESSION['chkDup'] = '1';
                ?> <div class="col-xl-4 col-md-12" style="display: none;">
                        <button type="button" class="btn btn-primary btn-sm" id="sa-successuserlct">confrim</button>
                    </div>
                <?php

                } else {

                    $_SESSION['chkDup'] = '1';
                ?>

                    <div class="col-xl-4 col-md-12" style="display: none;">
                        <button type="button" class="btn btn-primary btn-sm" id="sa-erroruserlct">confrim</button>
                    </div>
                <?php
                }
                break;

            case 'EditLct':

                $fdate = date('Y-m-d H:i:s');
                $fstf = $_SESSION['id'];
                $resultLct = $_POST['txtlcts'];
                $resultLctsave = str_replace(' ', '', "$resultLct");
                $statuslct = $_POST['txtlctst'];
                $idedit = $_POST['Ideditlct'];
                $UpdateLct = $useradd->UpdateLct($idedit, $resultLctsave, $statuslct, $fdate, $fstf, $db);

                if ($UpdateLct == '1') {

                    $_SESSION['chkDup'] = '1';
                ?>
                    <div class="col-xl-4 col-md-12" style="display: none;">
                        <button type="button" class="btn btn-primary btn-sm" id="sa-successuserlct">confrim</button>
                    </div>
                <?php

                } else {

                    $_SESSION['chkDup'] = '1';
                ?>
                    <div class="col-xl-4 col-md-12" style="display: none;">
                        <button type="button" class="btn btn-primary btn-sm" id="sa-erroruserlct">confrim</button>
                    </div>
        <?php
                }
                break;

                case 'DelLct':

                    $id =  $_POST['txtiddel'];
                    $user_st = '99';
                    $user_stf = $_SESSION['id'];
                    $user_fdate = date('Y-m-d H:i:s');
    
                    $DellctTobins = $useradd->UpdateDelstatusLct($id, $user_st, $user_stf, $user_fdate);
    
    
                    if ($DellctTobins == '1') {
                        $_SESSION['chkDup'] = '1';
    
                    ?>
    
                        <div class="col-xl-4 col-md-12" style="display: none;">
                            <button type="button" class="btn btn-primary btn-sm" id="sa-successuserlct">confrim</button>
                        </div>
    
    
                    <?php } else {
                        $_SESSION['chkDup'] = '1';
                    ?>
    
    
                        <div class="col-xl-4 col-md-12" style="display: none;">
                            <button type="button" class="btn btn-primary btn-sm" id="sa-erroruserlct">confrim</button>
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
            <button type="button" class="btn btn-primary btn-sm" id="sa-erroruser">confrim</button>
        </div>


<?php

    }
} else {
}
?>
<!-- </div>
                </div>
            </div>
        </div>

    </div>
</div> -->