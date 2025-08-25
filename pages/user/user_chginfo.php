<?php

include 'user_function.php';
$userAdd = new UserResult();
// Position
$positionData = $userAdd->PosAMS($db);
$actionEdit = isset($_SESSION['id']) ? $_SESSION['id'] : '';
$EditData = $userAdd->ListUserAMSEdit($db, $actionEdit);
$_SESSION['chkDup'] = '0';

?>


<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0"><i class="mdi mdi-account-lock"></i> จัดการข้อมูลส่วนตัว <?php echo $_SESSION['id']; ?></h4>

                    <div class="page-title-right">

                    </div>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-body">
                        <div class="live-preview">

                            <form class="form-horizontal" id="f_usersed" name="f_usersed" action="?Page=user-result&action=Info" method="post" autocomplete="off">
                            <div class="form-group row mt-3">
                                        <label for="txtbrandsnm" class="col-sm-3 text-right control-label col-form-label">คำนำหน้า :</label>
                                        <div class="col-sm-9">
                                            <select class="required select2 form-select" id="txtpname" name="txtpname" style="width: 100%; height:36px;" required onclick="seletShowPname(this.value);">
                                                <option value="นาย" <?php if ($EditData['0']['AMS_USER_PNAME'] == "นาย") {
                                                                        echo 'selected';
                                                                    } else {
                                                                    } ?>>นาย</option>
                                                <option value="นาง" <?php if ($EditData['0']['AMS_USER_PNAME'] == "นาง") {
                                                                        echo 'selected';
                                                                    } else {
                                                                    } ?>>นาง</option>
                                                <option value="นางสาว" <?php if ($EditData['0']['AMS_USER_PNAME'] == "นางสาว") {
                                                                            echo 'selected';
                                                                        } else {
                                                                        } ?>>นางสาว</option>
                                                <option value="ดร." <?php if ($EditData['0']['AMS_USER_PNAME'] == "ดร.") {
                                                                        echo 'selected';
                                                                    } else {
                                                                    } ?>>ดร.</option>
                                                <option value="ผู้ช่วยศาสตราจารย์" <?php if ($EditData['0']['AMS_USER_PNAME'] == "ผู้ช่วยศาสตราจารย์") {
                                                                                        echo 'selected';
                                                                                    } else {
                                                                                    } ?>>ผู้ช่วยศาสตราจารย์</option>
                                                <option value="ผู้ช่วยศาสตราจารย์ ดร." <?php if ($EditData['0']['AMS_USER_PNAME'] == "ผู้ช่วยศาสตราจารย์ ดร.") {
                                                                                            echo 'selected';
                                                                                        } else {
                                                                                        } ?>>ผู้ช่วยศาสตราจารย์ ดร.</option>
                                                <option value="รองศาสตราจารย์" <?php if ($EditData['0']['AMS_USER_PNAME'] == "รองศาสตราจารย์") {
                                                                                    echo 'selected';
                                                                                } else {
                                                                                } ?>>รองศาสตราจารย์</option>
                                                <option value="รองศาสตราจารย์ ดร." <?php if ($EditData['0']['AMS_USER_PNAME'] == "รองศาสตราจารย์ ดร.") {
                                                                                        echo 'selected';
                                                                                    } else {
                                                                                    } ?>>รองศาสตราจารย์ ดร.</option>
                                                <option value="ศาสตราจารย์" <?php if ($EditData['0']['AMS_USER_PNAME'] == "ศาสตราจารย์") {
                                                                                echo 'selected';
                                                                            } else {
                                                                            } ?>>ศาสตราจารย์</option>
                                                <option value="ศาสตราจารย์ ดร." <?php if ($EditData['0']['AMS_USER_PNAME'] == "ศาสตราจารย์ ดร.") {
                                                                                    echo 'selected';
                                                                                } else {
                                                                                } ?>>ศาสตราจารย์ ดร.</option>
                                                <option value="อื่นๆ" <?php if ($EditData['0']['AMS_USER_PNAME'] != "นาย" && $EditData['0']['AMS_USER_PNAME'] != "นาง" && $EditData['0']['AMS_USER_PNAME'] != "นางสาว" && $EditData['0']['AMS_USER_PNAME'] != "ดร." && $EditData['0']['AMS_USER_PNAME'] != "ผู้ช่วยศาสตราจารย์" && $EditData['0']['AMS_USER_PNAME'] != "ผู้ช่วยศาสตราจารย์ ดร." && $EditData['0']['AMS_USER_PNAME'] != "รองศาสตราจารย์" && $EditData['0']['AMS_USER_PNAME'] != "รองศาสตราจารย์ ดร." && $EditData['0']['AMS_USER_PNAME'] != "ศาสตราจารย์" && $EditData['0']['AMS_USER_PNAME'] != "ศาสตราจารย์ ดร.") {
                                                                            echo 'selected';
                                                                        } else {
                                                                        } ?>>อื่นๆ</option>
                                            </select>


                                            <div class="form-check-inline" style="display:<?php if ($EditData['0']['AMS_USER_PNAME'] != "นาย" && $EditData['0']['AMS_USER_PNAME'] != "นาง" && $EditData['0']['AMS_USER_PNAME'] != "นางสาว" && $EditData['0']['AMS_USER_PNAME'] != "ดร." && $EditData['0']['AMS_USER_PNAME'] != "ผู้ช่วยศาสตราจารย์" && $EditData['0']['AMS_USER_PNAME'] != "ผู้ช่วยศาสตราจารย์ ดร." && $EditData['0']['AMS_USER_PNAME'] != "รองศาสตราจารย์" && $EditData['0']['AMS_USER_PNAME'] != "รองศาสตราจารย์ ดร." && $EditData['0']['AMS_USER_PNAME'] != "ศาสตราจารย์" && $EditData['0']['AMS_USER_PNAME'] != "ศาสตราจารย์ ดร.") {
                                                                                                echo 'block';
                                                                                            } else {
                                                                                                echo 'none';
                                                                                            } ?>;" id="pnameshow">
                                                <input class="form-control" type="text" id="txtpname5" name="txtpnameother" placeholder="ระบุคำนำหน้า" value="<?php echo $EditData['0']['AMS_USER_PNAME']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                <div class="form-group row">
                                    <label for="txtfname" class="col-sm-3 text-right control-label col-form-label">ชื่อ :</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="required form-control" id="txtfname" name="txtfname" value="<?php echo $EditData['0']['AMS_USER_FNAME']; ?>" placeholder="--กรุณาระบุชื่อ--" disabled>
                                        <input type="hidden" class="form-control" id="fdate" name="fdate" value="<?= date('Y-m-d H:i:s'); ?>">
                                        <input type="hidden" class="form-control" id="fstf" name="fstf" value="<?php echo $_SESSION['id']; ?>">
                                        <input type="hidden" class="form-control" id="userid" name="userid" value="<?php echo $EditData['0']['AMS_USER_ID']; ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="txtlname" class="col-sm-3 text-right control-label col-form-label">นามสกุล :</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="required form-control" id="txtlname" name="txtlname" value="<?php echo $EditData['0']['AMS_USER_LNAME']; ?>" placeholder="--กรุณาระบุนามสกุล--" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="txttype" class="col-sm-3 text-right control-label col-form-label">ประเภท :</label>
                                    <div class="col-sm-9">
                                        <select class="required select2 form-select" id="txttype" name="txttype" style="width: 100%; height:36px;" disabled>
                                            <option name="txttype" value="">--กรุณาเลือกประเภท--</option>
                                            <option name="txttype" value="101" <?php echo $EditData['0']['AMS_USER_TYPE'] == '101' ? 'selected' : ''; ?>>สายสนับสนุน</option>
                                            <option name="txttype" value="102" <?php echo $EditData['0']['AMS_USER_TYPE'] == '102' ? 'selected' : ''; ?>>สายวิชาการ</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="txtgrp" class="col-sm-3 text-right control-label col-form-label">ตำแหน่ง :</label>
                                    <div class="col-sm-9">
                                        <select class="required js-example-basic-single" id="txtgrp" name="txtgrp" style="width: 100%; height:36px;" required>
                                            <option name="txtgrp" value="">--กรุณาเลือกตำแหน่ง--</option>
                                            <?php foreach ($positionData as $key => $value_pos) { ?>
                                                <option name="txtgrp" value="<?php echo $value_pos['AMS_POS_ID']; ?>" <?php echo $EditData['0']['AMS_USER_POS'] == $value_pos['AMS_POS_ID'] ? 'selected' : ''; ?>><?php echo $value_pos['AMS_POS_NM']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="txtusernm" class="col-sm-3 text-right control-label col-form-label">ชื่อผู้ใช้งาน :</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="required form-control" id="txtusernm" name="txtusernm" value="<?php echo $EditData['0']['AMS_USER_USN']; ?>" placeholder="--กรุณาระบุชื่อผู้ใช้งาน--" disabled>
                                        <input type="hidden" class="form-control" id="txtusernmchk" name="txtusernmchk" value="<?php echo $EditData['0']['AMS_USER_USN']; ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="txtusertype" class="col-sm-3 text-right control-label col-form-label">สิทธิการใช้งาน :</label>
                                    <div class="col-sm-9">
                                        <select class="required form-select" id="txtusertype" name="txtusertype" style="width: 100%; height:36px;" disabled>
                                            <option name="txtusertype" value="">--กรุณาเลือกสิทธิการใช้งาน--</option>
                                            <option name="txtusertype" value="201" <?php echo $EditData['0']['AMS_USER_GRP'] == '201' ? 'selected' : ''; ?>>ทั่วไป</option>
                                            <option name="txtusertype" value="202" <?php echo $EditData['0']['AMS_USER_GRP'] == '202' ? 'selected' : ''; ?>>เจ้าหน้าที่พัสดุ</option>
                                            <option name="txtusertype" value="203" <?php echo $EditData['0']['AMS_USER_GRP'] == '203' ? 'selected' : ''; ?>>ผู้ดูแลครุภัณฑ์</option>
                                            <option name="txtusertype" value="204" <?php echo $EditData['0']['AMS_USER_GRP'] == '204' ? 'selected' : ''; ?>>Admin</option>
                                            <option name="txtusertype" value="205" <?php echo $EditData['0']['AMS_USER_GRP'] == '205' ? 'selected' : ''; ?>>ผู้บริหาร</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="txtuserst" class="col-sm-3 text-right control-label col-form-label">สถานะข้อมูล :</label>
                                    <div class="col-sm-9">
                                        <select class="required form-select" id="txtuserst" name="txtuserst" style="width: 100%; height:36px;" disabled>
                                            <option name="txtuserst" value="10" <?php echo $EditData['0']['AMS_USER_ST'] == '10' ? 'selected' : ''; ?>>ใช้งาน</option>
                                            <option name="txtuserst" value="20" <?php echo $EditData['0']['AMS_USER_ST'] == '20' ? 'selected' : ''; ?>>แบบร่าง</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="border-top">
                                    <div class="card-body text-right">
                                        <button type="submit" class="btn btn-info2"><i class="mdi mdi-content-save"></i> บันทึกข้อมูล</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>


<script>
    function seletShowPname(val) {
        if (val == 'อื่นๆ') {
            document.getElementById('pnameshow').style.display = 'block';
        } else {
            document.getElementById('pnameshow').style.display = 'none';
        }
    }
</script>