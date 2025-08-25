<?php
include 'user_function.php';
$user_ListLct = new UserResult();
$ActionLctEdit = isset($_POST['editIdValuelct']) ? $_POST['editIdValuelct'] : '';
$_SESSION['chkDup'] = '0';
$listLct = $user_ListLct->ListLct($db);
?>

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0"><i class="mdi mdi-hoop-house"></i> หน่วยงาน </h4>

                    <div class="page-title-right">

                    </div>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-body">

                        <?php if ($ActionLctEdit == "") { ?>
                            <form class="form-horizontal" id="f_lct" name="f_lct" action="?Page=user-result&action=AddLct" method="post" autocomplete="off">
                                <div class="row gy-4">
                                    <div class="col-xxl-8 col-md-6">
                                        <div>
                                            <label for="txtlcts" class="form-label"><b>หน่วยงาน</b></label>
                                            <input type="text" class="form-control" name="txtlcts" required>
                                            <input type="hidden" class="form-control" id="fdate" name="fdate" value="<?= date('Y-m-d H:i:s'); ?>">
                                            <input type="hidden" class="form-control" id="fstf" name="fstf" value="<?php echo $_SESSION['id']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-xxl-4 col-md-6">
                                        <div>
                                            <label for="txtlctst" class="form-label"><b>สถานะข้อมูล</b></label>
                                            <select class="form-select" id="txtbdst" name="txtlctst" style="width: 100%; height:36px;" required>
                                                <option name="txtlctst" value="10">ใช้งาน</option>
                                                <option name="txtlctst" value="20">แบบร่าง</option>
                                            </select>

                                        </div>
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->

                                <br>
                                <div class="border-top">
                                    <div class="card-body text-right">
                                        <button type="submit" class="btn btn-info2"><i class="mdi mdi-content-save"></i> บันทึกข้อมูล</button>
                                    </div>
                                </div>
                            </form>
                        <?php } else { 
                           $ResultEditLct = $user_ListLct->ListLctEdit($ActionLctEdit,$db);
                            
                        ?>

                            <form class="form-horizontal" id="f_lct" name="f_lct" action="?Page=user-result&action=EditLct" method="post" autocomplete="off">
                                <div class="row gy-4">
                                    <div class="col-xxl-8 col-md-6">
                                        <div>
                                            <label for="txtlcts" class="form-label"><b>หน่วยงาน</b></label>
                                            <input type="text" class="form-control" name="txtlcts" value="<?php echo $ResultEditLct['0']['AMS_LCT_NM']; ?>" required>
                                            <input type="hidden" class="form-control" id="fdate" name="fdate" value="<?= date('Y-m-d H:i:s'); ?>">
                                            <input type="hidden" class="form-control" id="fstf" name="fstf" value="<?php echo $_SESSION['id']; ?>">
                                            <input type="hidden" class="form-control" id="Ideditlct" name="Ideditlct" value="<?php echo $ResultEditLct['0']['AMS_LCT_ID']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-xxl-4 col-md-6">
                                        <div>
                                            <label for="txtlctst" class="form-label"><b>สถานะข้อมูล</b></label>
                                            <select class="form-select" id="txtlctst" name="txtlctst" style="width: 100%; height:36px;" required>
                                                <option name="txtlctst" value="10" <?php if ($ResultEditLct['0']['AMS_LCT_ST'] == '20') {
                                                                            echo 'selected';
                                                                        } else {
                                                                        } ?>>ใช้งาน</option>
                                                <option name="txtlctst" value="20" <?php if ($ResultEditLct['0']['AMS_LCT_ST'] == '20') {
                                                                            echo 'selected';
                                                                        } else {
                                                                        } ?>>แบบร่าง</option>
                                            </select>

                                        </div>
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->

                                <br>
                                <div class="border-top">
                                    <div class="card-body text-right">
                                        <button type="submit" class="btn btn-danger2 text-light"><i class="mdi mdi-content-save"></i> แก้ไขข้อมูล</button>
                                    </div>
                                </div>
                            </form>

                        <?php } ?>


                    </div>
                </div>

            </div>
        </div>


        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-body">

                        <table id="userbins" class="table table-bordered dt-responsive nowrap table-striped align-middle table-hover" style="width:100%">
                            <thead>
                                <tr class="text-center">
                                    <th>ID</th>
                                    <th>หน่วยงาน</th>
                                    <th>สถานะข้อมูล</th>
                                    <th width="3%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($listLct as $key_lct => $value_lct) {
                                ?>
                                    <tr class="text-center">
                                        <td><?php echo $value_lct['AMS_LCT_ID']; ?></td>
                                        <td><?php echo $value_lct['AMS_LCT_NM']; ?></td>
                                        <td class="text-center">
                                            <h5><span class="badge bg-<?php echo $value_lct['AMS_LCT_ST'] == '10' ? 'info' : 'danger'; ?> text-dark"><i class="mdi mdi-tag"></i> <?php echo $value_lct['AMS_LCT_ST'] == '10' ? 'ใช้งาน' : 'แบบร่าง'; ?></span></h5>
                                        </td>
                                        <td>
                                            <form action="" method="POST">
                                                <input type="hidden" value="<?php echo $value_lct['AMS_LCT_ID']; ?>" name="editIdValuelct">
                                                <button type="submit" class="btn btn-sm btn-outline-dark dropdown-item dropdown-item2 remove-item-btn"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</button>
                                            </form>
                                            <button class="btn btn-sm btn-outline-dark dropdown-item dropdown-item2 remove-item-btn" data-bs-toggle="modal" data-bs-target="#DeletebudgetModal" data-bs-idbd="<?php echo $value_lct['AMS_LCT_ID']; ?>" data-bs-delnm="<?php echo $value_lct['AMS_LCT_NM']; ?>" >
                                                <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete
                                            </button>
                                        </td>

                                        </td>
                                    </tr>

                                <?php
                                }
                                ?>

                            </tbody>
                        </table>

                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

<!-- Modal -->
<div class="modal fade zoomIn" id="DeletebudgetModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btn-close"></button>
            </div>
            <div class="modal-body">
                <form action="?Page=user-result&action=DelLct" method="POST">
                    <div class="iddel"><input type="hidden" name="txtiddel" class="form-control"></div>
                    <div class="mt-2 text-center">
                        <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                        <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5 delname">
                            <h4>คุณต้องการลบข้อมูล</h4>
                            <b></b>
                            <h4>หรือไม่ ?</h4>
                            <p class="text-muted mx-4 mb-0">ถ้าต้องการลบกรุณากดปุ่มยืนยัน ?</p>
                        </div>
                    </div>
                    <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                        <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">ยกเลิก</button>
                        <button type="submit" class="btn w-sm btn-danger2 " id="delete-record">ยืนยันลบข้อมูล</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--end modal -->