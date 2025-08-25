<?php
include 'user_function.php';
$user_List = new UserResult();
// $result_listAllUser = $user_List->ListUserAMS($db);
$result_listAllUser = $user_List->ListUserAMSAPI($_SESSION["token_ams"]);
$_SESSION["chkDup"] = '0';
?>
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0"><i class="mdi mdi-account-lock"></i> จัดการผู้ใช้งาน</h4>

                    <div class="page-title-right">

                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col">

                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">รายชื่อสมาชิก</h4>
                        <div class="text-right"><button class="btn btn-md btn-success3" onClick="location.href='?Page=user-add'"><i class="mdi mdi-account-plus"></i> เพิ่มผู้ใช้งาน</button></div>
                    </div><!-- end card header -->

                    <div class="card-body">
                        <table id="usermanage" class="table table-bordered dt-responsive nowrap table-striped align-middle table-hover" style="width:100%">
                            <thead>
                                <tr class="text-center">
                                    <th hidden>ID</th>
                                    <th>ชื่อ-นามสกุล</th>
                                    <!-- <th>ตำแหน่ง</th> -->
                                    <th>สิทธิการใช้งาน</th>
                                    <th>สถานะข้อมูล</th>
                                    <th width="3%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($result_listAllUser->json_data as $value_user) {
                                ?>
                                    <tr>
                                        <td hidden class="text-center cursor-pointer" data-bs-toggle="modal" data-bs-target="#varyingcontentModal" data-bs-fullname="<?php echo $value_user->AMS_USER_PNAME . $value_user->AMS_USER_FNAME . ' ' . $value_user->AMS_USER_LNAME; ?>" data-bs-id="<?php echo $value_user->AMS_USER_ID; ?>" data-bs-type="<?php echo $value_user->AMS_USER_TYPE == '101' ? 'สายสนับสนุน' : 'สายวิชาการ'; ?>" data-bs-pos="<?php echo $value_user->AMS_POS_NM; ?>" data-bs-grp="<?php echo $value_user->AMS_USER_GRPNM; ?>" data-bs-username="<?php echo $value_user->AMS_USER_USN; ?>" data-bs-status="<?php echo $value_user->AMS_USER_ST == '10' ? 'ใช้งาน' : 'แบบร่าง'; ?>" data-bs-fdate="<?php echo $value_user->AMS_USER_FDATE; ?>"><?php echo $value_user->AMS_USER_ID; ?></td>
                                        <td class="cursor-pointer" data-bs-toggle="modal" data-bs-target="#varyingcontentModal" data-bs-fullname="<?php echo $value_user->AMS_USER_PNAME . $value_user->AMS_USER_FNAME . ' ' . $value_user->AMS_USER_LNAME; ?>" data-bs-id="<?php echo $value_user->AMS_USER_ID; ?>" data-bs-type="<?php echo $value_user->AMS_USER_TYPE == '101' ? 'สายสนับสนุน' : 'สายวิชาการ'; ?>" data-bs-pos="<?php echo $value_user->AMS_POS_NM; ?>" data-bs-grp="<?php echo $value_user->AMS_USER_GRPNM; ?>" data-bs-username="<?php echo $value_user->AMS_USER_USN; ?>" data-bs-status="<?php echo $value_user->AMS_USER_ST == '10' ? 'ใช้งาน' : 'แบบร่าง'; ?>" data-bs-fdate="<?php echo $value_user->AMS_USER_FDATE; ?>"><?php echo $value_user->AMS_USER_PNAME . $value_user->AMS_USER_FNAME . ' ' . $value_user->AMS_USER_LNAME; ?></td>
                                        <!-- <td><?php echo $value_user->AMS_POS_NM; ?></td> -->
                                        <td class="text-center cursor-pointer" data-bs-toggle="modal" data-bs-target="#varyingcontentModal" data-bs-fullname="<?php echo $value_user->AMS_USER_PNAME . $value_user->AMS_USER_FNAME . ' ' . $value_user->AMS_USER_LNAME; ?>" data-bs-id="<?php echo $value_user->AMS_USER_ID; ?>" data-bs-type="<?php echo $value_user->AMS_USER_TYPE == '101' ? 'สายสนับสนุน' : 'สายวิชาการ'; ?>" data-bs-pos="<?php echo $value_user->AMS_POS_NM; ?>" data-bs-grp="<?php echo $value_user->AMS_USER_GRPNM; ?>" data-bs-username="<?php echo $value_user->AMS_USER_USN; ?>" data-bs-status="<?php echo $value_user->AMS_USER_ST == '10' ? 'ใช้งาน' : 'แบบร่าง'; ?>" data-bs-fdate="<?php echo $value_user->AMS_USER_FDATE; ?>">
                                            <h5><span class="badge badge-soft-secondary"><i class="mdi mdi-shield-account"></i> <?php echo $value_user->AMS_USER_GRPNM; ?></span></h5>
                                        </td>
                                        <td class="text-center cursor-pointer" data-bs-toggle="modal" data-bs-target="#varyingcontentModal" data-bs-fullname="<?php echo $value_user->AMS_USER_PNAME . $value_user->AMS_USER_FNAME . ' ' . $value_user->AMS_USER_LNAME; ?>" data-bs-id="<?php echo $value_user->AMS_USER_ID; ?>" data-bs-type="<?php echo $value_user->AMS_USER_TYPE == '101' ? 'สายสนับสนุน' : 'สายวิชาการ'; ?>" data-bs-pos="<?php echo $value_user->AMS_POS_NM; ?>" data-bs-grp="<?php echo $value_user->AMS_USER_GRPNM; ?>" data-bs-username="<?php echo $value_user->AMS_USER_USN; ?>" data-bs-status="<?php echo $value_user->AMS_USER_ST == '10' ? 'ใช้งาน' : 'แบบร่าง'; ?>" data-bs-fdate="<?php echo $value_user->AMS_USER_FDATE; ?>">
                                            <h5><span class="badge bg-<?php echo $value_user->AMS_USER_ST == '10' ? 'info' : 'danger'; ?> text-dark"><i class="mdi mdi-tag"></i> <?php echo $value_user->AMS_USER_ST == '10' ? 'ใช้งาน' : 'แบบร่าง'; ?></span></h5>
                                        </td>
                                        <td class="text-center">
                                           
                                            <form action="?Page=user-add" method="POST">
                                                <input type="hidden" value="<?php echo $value_user->AMS_USER_ID; ?>" name="editIdValue">
                                                <button class="btn btn-sm btn-outline-dark dropdown-item dropdown-item2 edit-item-btn"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</button>
                                            </form>
                                            <button class="btn btn-sm btn-outline-dark dropdown-item dropdown-item2 remove-item-btn" data-bs-toggle="modal" data-bs-target="#DeletebudgetModal" data-bs-idbd="<?php echo $value_user->AMS_USER_ID; ?>" data-bs-delnm="<?php echo $value_user->AMS_USER_ID; ?>" >
                                                <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete
                                            </button>
                                        </td>
                                    </tr>

                                <?php } ?>

                            </tbody>
                        </table>

                    </div>
                </div>


            </div> <!-- end col -->


        </div>

    </div>
    <!-- container-fluid -->
</div>
<!-- End Page-content -->


<!-- Varying modal content -->
<div class="modal fade" id="varyingcontentModal" tabindex="-1" aria-labelledby="varyingcontentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="varyingcontentModalLabel">รายละเอียดข้อมูล</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3 dspname">
                        <label for="txtdspnamemodal" class="col-form-label dspname"><b>ชื่อ-นามสกุล:</b></label>
                        <input type="text" class="form-control" id="txtdspnamemodal" disabled="disabled">
                    </div>
                    <div class="mb-3 type">
                        <label for="txttypemodal" class="col-form-label"><b>ประเภท:</b></label>
                        <input type="text" class="form-control" id="txttypemodal" disabled="disabled">
                    </div>
                    <div class="mb-3 position">
                        <label for="txtposmodal" class="col-form-label"><b>ตำแหน่ง:</b></label>
                        <input type="text" class="form-control" id="txtposmodal" disabled="disabled">
                    </div>
                    <div class="mb-3 grp">
                        <label for="txtgrpmodal" class="col-form-label"><b>สิทธิการใช้งาน:</b></label>
                        <input type="text" class="form-control" id="txtgrpmodal" disabled="disabled">
                    </div>
                    <div class="mb-3 username">
                        <label for="txtusernamemodal" class="col-form-label"><b>Username:</b></label>
                        <input type="text" class="form-control" id="txtusernamemodal" disabled="disabled">
                    </div>
                    <div class="mb-3 status">
                        <label for="txtstatusmodal" class="col-form-label"><b>สถานะข้อมูล:</b></label>
                        <input type="text" class="form-control" id="txtstatusmodal" disabled="disabled">
                    </div>
                    <div class="mb-3 fdate">
                        <label for="txtfdatemodal" class="col-form-label"><b>วันที่บันทึก:</b></label>
                        <input type="text" class="form-control" id="txtfdatemodal" disabled="disabled">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">ปิด</button>
                <!-- <button type="button" class="btn btn-primary">Send message</button> -->
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
                <form action="?Page=user-result&action=Del" method="POST">
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