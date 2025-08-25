<?php
$_SESSION['chkDup'] = '0';
include 'product_function.php';
$ProductList = new ProductResult();
$ListAllProduct = $ProductList->ListProductDel($db);
$ListAllProductSets = $ProductList->ListProductDelSet($db);

?>

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0"><i class="mdi mdi-trash-can"></i> ถังขยะครุภัณฑ์ </h4>

                    <div class="page-title-right">

                    </div>

                </div>
            </div>
        </div>



        <div class="row">
            <div class="col-xxl-12">

                <div class="card">
                    <div class="card-body">

                        <ul class="nav nav-pills nav-customs nav-danger mb-3" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#border-navs-bins" role="tab"><i class="mdi mdi-triangle"></i> รายการครุภัณฑ์</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#border-navs-binsets" role="tab"><i class="mdi mdi-triforce"></i> รายการชุดครุภัณฑ์</a>
                            </li>

                        </ul><!-- Tab panes -->
                        <div class="tab-content text-muted">
                            <div class="tab-pane active" id="border-navs-bins" role="tabpanel">
                                <div class="row">
                                    <div class="col-12">

                                        <div class="card">
                                            <div class="card-header align-items-center d-flex">
                                                <h4 class="card-title mb-0 flex-grow-1"><i class="mdi mdi-format-list-bulleted"></i> รายการครุภัณฑ์</h4>
                                            </div>
                                            <div class="card-body">

                                                <table id="producrmanage" class="table table-bordered dt-responsive  table-striped align-middle text-wrap table-hover" style="width:100%">
                                                    <thead>
                                                        <tr class="text-center">
                                                            <th hidden>รหัสครุภัณฑ์</th>
                                                            <th>เลขทะเบียนครุภัณฑ์</th>
                                                            <th>ชื่อครุภัณฑ์</th>
                                                            <th>ราคา</th>
                                                            <th>สถานะครุภัณฑ์</th>
                                                            <th>ประเภทของครุภัณฑ์</th>
                                                            <th>ชุดครุภัณฑ์</th>
                                                            <!-- <th>ปีงบประมาณและที่มา</th> -->
                                                            <th>สถานะข้อมูล</th>
                                                            <th width="8%"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        foreach ($ListAllProduct as $key_pro => $value_pro) {
                                                        ?>
                                                            <tr class="text-center">
                                                                <td hidden><?php echo $value_pro['AMS_PRODUCT_ID']; ?></td>
                                                                <td><?php echo $value_pro['AMS_PRODUCT_NO']; ?></td>
                                                                <td><?php echo $value_pro['AMS_PRODUCT_NM']; ?></td>
                                                                <td><?php echo number_format($value_pro['AMS_PRODUCT_PRICE'], 2); ?></td>
                                                                <td>
                                                                    <h5><span class="badge rounded-pill bg-light text-dark"><?php echo $value_pro['AMS_PRODUCT_STNM']; ?></span></h5>
                                                                </td>
                                                                <td><?php echo $value_pro['AMS_DEPRECIATION_TYPE']; ?></td>
                                                                <td><?php echo $value_pro['AMS_PRODUCT_SET']; ?></td>
                                                                <!-- <td>
                                            <h5><span class="badge rounded-pill bg-light text-dark"><?php echo $value_pro['AMS_PRODUCT_YEAR'] . ' ' . $value_pro['AMS_BUDGET_SOURCENM']; ?></span><span class="badge rounded-pill bg-light text-dark"><?php echo $value_pro['AMS_BUDGET_CLASSNM']; ?></span><span class="badge rounded-pill bg-<?php echo $value_pro['AMS_BUDGET_TYPE'] == '301' ? 'success' : 'warning'; ?> text-dark"><?php echo $value_pro['AMS_BUDGET_TYPENM']; ?></span></h5>
                                        </td> -->
                                                                <td>
                                                                    <h5><span class="badge rounded-pill bg-<?php echo $value_pro['AMS_PRODUCT_DELST'] == '99' ? 'danger' : 'info'; ?> text-dark"><i class="mdi mdi-tag"></i> <?php echo $value_pro['AMS_PRODUCT_DELST'] == '99' ? 'ถังขยะ' : 'แบบร่าง'; ?></h5></span>
                                                                </td>
                                                                <td>
                                                                    <?php if ($value_pro['AMS_PRODUCT_SET'] == "") { ?>
                                                                        <button class="btn btn-sm btn-warning2 remove-item-btn text-black" data-bs-toggle="modal" data-bs-target="#RestoreBDRecordModal" data-bs-idbd="<?php echo $value_pro['AMS_PRODUCT_ID']; ?>"><b><i class="mdi mdi-restore"></i> นำข้อมูลกลับไปใช้</b></button>
                                                                        <?php } else {
                                                                        if ($value_pro['AMS_PRODUCTSET_ST'] == '99') {
                                                                            echo 'ชุดข้อมูลอยู่ในถังขยะ';
                                                                        } else {
                                                                        ?>
                                                                            <button class="btn btn-sm btn-warning2 remove-item-btn text-black" data-bs-toggle="modal" data-bs-target="#RestorePDCSetRecordModal" data-bs-idbd="<?php echo $value_pro['AMS_PRODUCT_ID']; ?>" data-bs-idset="<?php echo $value_pro['AMS_PRODUCT_SET']; ?>"><b><i class="mdi mdi-restore"></i> นำข้อมูลกลับไปใช้</b></button>
                                                                    <?php }
                                                                    } ?>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>


                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>

                            <div class="tab-pane" id="border-navs-binsets" role="tabpanel">

                                <div class="row">
                                    <div class="col-12">

                                        <div class="card">
                                            <div class="card-header align-items-center d-flex">
                                                <h4 class="card-title mb-0 flex-grow-1"><i class="mdi mdi-format-list-bulleted"></i> รายการชุดครุภัณฑ์</h4>
                                            </div>
                                            <div class="card-body">

                                                <table id="producrmanage" class="table table-bordered dt-responsive  table-striped align-middle text-wrap table-hover" style="width:100%">
                                                    <thead>
                                                        <tr class="text-center">
                                                            <th hidden>รหัสชุด</th>
                                                            <th>เลขชุดครุภัณฑ์</th>
                                                            <th>ชื่อชุดครุภัณฑ์</th>
                                                            <th>จำนวน</th>
                                                            <th>ราคาต่อหน่วย</th>
                                                            <th>ราคารวม</th>
                                                            <th>สถานะข้อมูล</th>
                                                            <th width="8%"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        foreach ($ListAllProductSets as $key_proset => $value_proset) {
                                                        ?>
                                                            <tr class="text-center">
                                                                <td hidden><?php echo $value_proset['AMS_PRODUCTSET_ID']; ?></td>
                                                                <td><?php echo $value_proset['AMS_PRODUCTSET_NO']; ?></td>
                                                                <td><?php echo $value_proset['AMS_PRODUCTSET_NM']; ?></td>
                                                                <td><?php echo $value_proset['AMS_PRODUCTSET_QTY']; ?></td>
                                                                <td>
                                                                    <?php echo number_format($value_proset['AMS_PRODUCTSET_PRICE'], 2); ?>
                                                                </td>
                                                                <td>

                                                                    <h5><span class="badge rounded-pill bg-light text-dark"><?php echo number_format($value_proset['AMS_PRODUCTSET_TOTAL'], 2); ?></span></h5>
                                                                </td>

                                                                <td>
                                                                    <h5><span class="badge rounded-pill bg-<?php echo $value_proset['AMS_PRODUCTSET_ST'] == '99' ? 'danger' : 'info'; ?> text-dark"><i class="mdi mdi-tag"></i> <?php echo $value_proset['AMS_PRODUCTSET_ST'] == '99' ? 'ถังขยะ' : 'แบบร่าง'; ?></h5></span>
                                                                </td>
                                                                <td>
                                                                    <button class="btn btn-sm btn-warning2 remove-item-btn text-black" data-bs-toggle="modal" data-bs-target="#RestorePDCSetAllRecordModal" data-bs-idbd="<?php echo $value_proset['AMS_PRODUCTSET_ID']; ?>"><b><i class="mdi mdi-restore"></i> นำข้อมูลกลับไปใช้</b></button>

                                                                </td>
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
                    </div><!-- end card-body -->
                </div>
            </div>
            <!--end col-->

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
                <form action="?Page=pdc-result" method="POST">
                    <div class="restore"><input type="hidden" name="txtidrestore" class="form-control"></div>
                    <input type="hidden" class="form-control" id="ActionProduct" name="ActionProduct" value="Restore">
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


<!-- Modal -->
<div class="modal fade zoomIn" id="RestorePDCSetRecordModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btn-close"></button>
            </div>
            <div class="modal-body">
                <form action="?Page=pdc-result" method="POST">
                    <div class="restore"><input type="hidden" name="txtidrestore" class="form-control"></div>
                    <div class="restoreset"><input type="hidden" name="txtidrestoreset" class="form-control"></div>
                    <input type="hidden" class="form-control" id="ActionProduct" name="ActionProduct" value="RestoreSet">
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

<!-- Modal -->
<div class="modal fade zoomIn" id="RestorePDCSetAllRecordModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btn-close"></button>
            </div>
            <div class="modal-body">
                <form action="?Page=pdc-result" method="POST">
                    <div class="restore"><input type="hidden" name="txtidrestore" class="form-control"></div>
                    <input type="hidden" class="form-control" id="ActionProduct" name="ActionProduct" value="RestoreSetAll">
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