<?php
$_SESSION['chkDup'] = '0';
include 'repair_function.php';
$RepairResult = new RepairResult();
$ListAllRepair = $RepairResult->ListRepairDel($db);
?>

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0"><i class="mdi mdi-trash-can"></i> ถังขยะการซ่อม</h4>

                    <div class="page-title-right">

                    </div>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1"><i class="mdi mdi-format-list-bulleted"></i> รายการซ่อม</h4>
                    </div>
                    <div class="card-body">

                        <table id="repairmanageall" class="table table-bordered dt-responsive  table-striped align-middle text-wrap table-hover" style="width:100%">
                            <thead>
                                <tr class="text-center">
                                    <th hidden></th>
                                    <th>รหัสส่งซ่อม</th>
                                    <th>วันที่ส่งซ่อม</th>
                                    <th>เลขทะเบียนครุภัณฑ์</th>
                                    <th>ชื่อครุภัณฑ์</th>
                                    <th>คนบันทึกซ่อม</th>
                                    <th>สถานะการส่งซ่อม</th>
                                    <th>สถานะข้อมูล</th>
                                    <th width="8%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($ListAllRepair as $key_del => $value_del) { ?>
                                    <tr class="text-center">
                                        <td hidden><?php echo $value_del['AMS_REPAIR_DATE']; ?></td>
                                        <td class="cursor-pointer">
                                            <?php echo $value_del['AMS_REPAIR_ID']; ?>
                                        </td>
                                        <td class="cursor-pointer">
                                            <?php echo $RepairResult->dateToThai($value_del['AMS_REPAIR_DATE']); ?>
                                        </td>
                                        <td class="cursor-pointer">
                                            <?php echo $value_del['AMS_PRODUCT_NO']; ?>
                                        </td>
                                        <td class="cursor-pointer">
                                            <?php echo $value_del['AMS_PRODUCT_NM']; ?>
                                        </td>
                                        <td class="cursor-pointer">
                                            <?php echo $value_del['AMS_USER_FNAME'] . ' ' . $value_del['AMS_USER_LNAME']; ?>
                                        </td>
                                        <td class="cursor-pointer">
                                            <h5><span class="badge rounded-pill bg-<?php echo $value_del['AMS_REPAIR_RST'] == '1' ? 'success' : 'warning'; ?> text-dark"><i class="mdi mdi-tag"></i> <?php echo $value_del['AMS_REPAIR_RSTNM']; ?></h5></span>
                                        </td>
                                        <td class="cursor-pointer">
                                            <h5><span class="badge rounded-pill bg-<?php echo $value_del['AMS_REPAIR_ST'] == '99' ? 'danger' : 'danger'; ?> text-dark"><i class="mdi mdi-tag"></i> <?php echo $value_del['AMS_REPAIR_ST'] == '99' ? 'ถังขยะ' : 'ไม่ใช้งาน'; ?></h5></span>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-warning2 remove-item-btn text-black" data-bs-toggle="modal" data-bs-target="#RestoreBDRecordModal" data-bs-idbd="<?php echo $value_del['AMS_REPAIR_ID']; ?>"><b><i class="mdi mdi-restore"></i> นำข้อมูลกลับไปใช้</b></button>
                                        </td>

                                    </tr>


                                <?php  } ?>

                            </tbody>
                        </table>


                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

<!-- Modal -->
<div class="modal fade zoomIn" id="RestoreBDRecordModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btn-close"></button>
            </div>
            <div class="modal-body">
                <form action="?Page=rp-result" method="POST">
                    <div class="restore"><input type="hidden" name="txtidrestore" class="form-control"></div>
                    <input type="hidden" class="form-control" id="Actionrepair" name="Actionrepair" value="Restore">
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