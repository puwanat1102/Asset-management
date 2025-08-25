<?php
$_SESSION['chkDup'] = '0';
include 'deprec_function.php';
$DeprecList = new DeprecResult();
$TypeSearch = isset($_POST['txtprotype']) ? $_POST['txtprotype'] : '';
$TimeSearch = isset($_POST['txtprotime']) ? $_POST['txtprotime'] : '';
$StatusSearch = isset($_POST['txtdcst']) ? $_POST['txtdcst'] : '';
$dataAllDeprec = $DeprecList->DeprceList($TypeSearch, $TimeSearch, $StatusSearch, $db);

?>

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0"><i class="mdi mdi-calculator"></i> จัดการประเภทครุภัณฑ์ </h4>

                    <div class="page-title-right">

                    </div>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1"><i class="mdi mdi-database-search"></i> ค้นหาข้อมูลประเภทครุภัณฑ์</h4>
                    </div><!-- end card header -->
                    <div class="card-body">

                        <form class="form-horizontal" id="f_deprec" name="f_deprec" action="?Page=deprec-setting" method="post" autocomplete="off">
                            <div class="row gy-4">
                                <div class="col-xxl-4 col-md-6">
                                    <div>
                                        <label for="txtprotype" class="form-label"><b>ประเภทของครุภัณฑ์</b></label>
                                        <input type="text" class="form-control" name="txtprotype">
                                    </div>
                                </div>
                                <!--end col-->
                                <!-- <div class="col-xxl-2 col-md-6">
                                    <div>
                                        <label for="txtprotime" class="form-label"><b>ระยะเวลาเสื่อมราคา</b></label>
                                        <input type="number" class="form-control" name="txtprotime" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==2) return false;" />
                                    </div>
                                </div> -->
                                <!--end col-->
                                <div class="col-xxl-2 col-md-6">
                                    <div>
                                        <label for="txtdcst" class="form-label"><b>สถานะข้อมูล</b></label>
                                        <select class="form-select" id="txtbdst" name="txtdcst" style="width: 100%; height:36px;">
                                            <option name="txtdcst" value="">ทั้งหมด</option>
                                            <option name="txtdcst" value="10">ใช้งาน</option>
                                            <option name="txtdcst" value="20">แบบร่าง</option>
                                        </select>
                                    </div>
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                            <br>
                            <div class="border-top">
                                <div class="card-body text-right">
                                    <button type="submit" class="btn btn-info2 text-light"><i class="mdi mdi-database-search"></i> ค้นหา</button>
                                    <button type="button" class="btn btn-warning2 text-light" onClick="window.location.href = '?Page=deprec-setting'"><i class="mdi mdi-backup-restore"></i> Reset</button>
                                </div>
                            </div>
                        </form>



                    </div>
                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1"><i class="mdi mdi-format-list-bulleted"></i> รายการประเภทครุภัณฑ์</h4>
                        <div class="text-right"><button class="btn btn-md btn-success3" onClick="location.href='?Page=deprec-add'"><i class="mdi mdi-cash-plus"></i> เพิ่มรายการประเภทครุภัณฑ์</button></div>
                    </div><!-- end card header -->
                    <div class="card-body">

                        <table id="deprecmanage" class="table table-bordered dt-responsive nowrap table-striped align-middle table-hover" style="width:100%">
                            <thead>
                                <tr class="text-center">
                                    <th hidden>รหัสประเภทครุภัณฑ์</th>
                                    <th>ประเภทของครุภัณฑ์</th>
                                    <!-- <th>ระยะเวลาเสื่อมราคา</th>
                                    <th>อัตราการเสื่อมราคา</th> -->
                                    <th>สถานะข้อมูล</th>
                                    <th width="3%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($dataAllDeprec as $key_deprec => $value_deprec) {?>
                                    <tr class="text-center">
                                        <td hidden><?php echo $value_deprec['AMS_DEPRECIATION_ID']; ?></td>
                                        <td><?php echo $value_deprec['AMS_DEPRECIATION_TYPE']; ?></td>
                                        <!-- <td><?php echo $value_deprec['AMS_DEPRECIATION_YEAR']; ?></td> -->
                                        <!-- <td>
                                            <h5><span class="badge rounded-pill bg-light text-dark"><?php echo number_format($value_deprec['AMS_DEPRECIATION_RATE'], 2); ?></span></h5>
                                        </td> -->
                                        <td>
                                            <h5><span class="badge rounded-pill bg-<?php echo $value_deprec['AMS_DEPRECIATION_ST'] == '10' ? 'info' : 'danger'; ?> text-dark"><i class="mdi mdi-tag"></i> <?php echo $value_deprec['AMS_DEPRECIATION_ST'] == '10' ? 'ใช้งาน' : 'แบบร่าง'; ?></h5></span>
                                        </td>
                                        <td>

                                            <form action="?Page=deprec-add" method="POST">
                                                <input type="hidden" value="<?php echo $value_deprec['AMS_DEPRECIATION_ID']; ?>" name="editIdValue">
                                                <button class="btn btn-sm btn-outline-dark dropdown-item dropdown-item2 edit-item-btn"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</button>
                                            </form>
                                            <button class="btn btn-sm btn-outline-dark dropdown-item dropdown-item2 remove-item-btn" data-bs-toggle="modal" data-bs-target="#DeletebudgetModal" data-bs-idbd="<?php echo $value_deprec['AMS_DEPRECIATION_ID']; ?>" data-bs-delnm="<?php echo $value_deprec["AMS_DEPRECIATION_TYPE"]; ?>" >
                                                <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete
                                            </button>

                                        </td>
                                    </tr>
                                <?php }?>

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
                <form action="?Page=deprec-result" method="POST">
                    <div class="iddel"><input type="hidden" name="txtiddel" class="form-control"></div>
                    <input type="hidden" name="Actiondeprec" value="Del" class="form-control">
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