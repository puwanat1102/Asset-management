<?php
include 'user_function.php';
$user_ListDel = new UserResult();
$result_listAllUserDel = $user_ListDel->ListUserAMSDel($db);
$_SESSION['chkDup'] = '0';
?>

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0"><i class="mdi mdi-trash-can"></i> ถังขยะผู้ใช้งาน </h4>

                    <div class="page-title-right">

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
                                    <th>ชื่อ-นามสกุล</th>
                                    <th>สิทธิการใช้งาน</th>
                                    <th>สถานะข้อมูล</th>
                                    <th width="5%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($result_listAllUserDel as $key => $value_del) {  ?>
                                    <tr>
                                        <td class="text-center"><?php echo $value_del['AMS_USER_ID']; ?></td>
                                        <td><?php echo $value_del['AMS_USER_PNAME'] . $value_del['AMS_USER_FNAME'] . ' ' . $value_del['AMS_USER_LNAME']; ?></td>
                                        <td class="text-center">
                                            <h5><span class="badge badge-soft-secondary"><i class="mdi mdi-shield-account"></i> <?php echo $value_del['AMS_USER_GRPNM']; ?></span></h5>
                                        </td>
                                        <td class="text-center">
                                            <h5><span class="badge bg-<?php echo $value_del['AMS_USER_ST'] == '99' ? 'danger' : 'info'; ?>"><i class="mdi mdi-tag"></i> <?php echo $value_del['AMS_USER_ST'] == '99' ? 'ถังขยะ' : ''; ?></span></h5>
                                        </td>
                                        <td><button class="btn btn-sm btn-warning remove-item-btn text-black" data-bs-toggle="modal" data-bs-target="#RestoreRecordModal" data-bs-iduser="<?php echo $value_del['AMS_USER_ID']; ?>"><b><i class="mdi mdi-restore"></i> นำข้อมูลกลับไปใช้</b></button></td>
                                    </tr>

                                <?php } ?>

                            </tbody>
                        </table>

                    </div>
                </div>

            </div>
        </div>

    </div>
</div>


<!-- Modal -->
<div class="modal fade zoomIn" id="RestoreRecordModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btn-close"></button>
            </div>
            <div class="modal-body">
                <form action="?Page=user-result&action=Restore" method="POST">
                    <div class="restore"><input type="hidden" name="txtidrestore" class="form-control"></div>
                    <div class="mt-2 text-center">
                        <lord-icon src="https://cdn.lordicon.com/dxjqoygy.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                        <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                            <h4>คุณต้องการนำข้อมูลกลับไปใช้หรือไม่ ?</h4>
                            <p class="text-muted mx-4 mb-0">ถ้าต้องการกรุณากดปุ่มยืนยัน ?</p>
                        </div>
                    </div>
                    <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                        <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">ยกเลิก</button>
                        <button type="submit" class="btn w-sm btn-success " id="restore-record">ยืนยัน</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--end modal -->