<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0"><i class="mdi mdi-account-lock"></i> จัดการรหัสผ่าน </h4>

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

                            <form class="form-horizontal" id="f_userspass" name="f_userspass" action="?Page=user-result&action=Pass" method="post" autocomplete="off">


                                <div class="form-group row">
                                    <label for="txtpassword" class="col-sm-3 text-right control-label col-form-label">รหัสผ่านเดิม :</label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control" id="txtpasswordold" name="txtpasswordold" placeholder="--กรุณาระบุรหัสผ่านเดิม--">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="txtpassword" class="col-sm-3 text-right control-label col-form-label">รหัสผ่านใหม่ :</label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control" id="txtpassword" name="txtpassword" placeholder="--กรุณาระบุรหัสผ่านใหม่--">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="txtconpassword" class="col-sm-3 text-right control-label col-form-label">ยืนยันรหัสผ่าน :</label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control" id="txtconpassword" name="txtconpassword" placeholder="--กรุณายืนยันรหัสผ่าน--">
                                        <input type="hidden" class="form-control" id="fdate" name="fdate" value="<?= date('Y-m-d H:i:s'); ?>">
                                        <input type="hidden" class="form-control" id="fstf" name="fstf" value="<?php echo $_SESSION['id']; ?>">
                                        <input type="hidden" class="form-control" id="userid" name="userid" value="<?php echo $_SESSION['id']; ?>">
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
<?php
$_SESSION['chkDup'] = '0';
?>