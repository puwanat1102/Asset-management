<?php
$_SESSION['chkDup'] = '0';
include 'article_function.php';
$ArticleList = new ArticleResult();
$Atcfdate =  isset($_POST['txtexpdatewar']) ? $ArticleList->dateTosave($_POST['txtexpdatewar']) : '';
$Atcldate =  isset($_POST['txtexpdatewar2']) ? $ArticleList->dateTosave($_POST['txtexpdatewar2']) : '';
$Atcstatus =  isset($_POST['txtatcst']) ? $_POST['txtatcst'] : '';
$AtcexpdateST =  isset($_POST['warrantycheck']) ? $_POST['warrantycheck'] : '0';



$AllArticel = $ArticleList->ListArticleAllWarranty($AtcexpdateST, $Atcfdate, $Atcldate, $Atcstatus, $db);
$dateNowWar = date('Y-m-d');
?>

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0"><i class="mdi mdi-treasure-chest"></i> จัดการวัสดุ </h4>

                    <div class="page-title-right">

                    </div>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1"><i class="mdi mdi-database-search"></i> ค้นหาข้อมูลวัสดุ [ การรับประกัน ]</h4>
                    </div><!-- end card header -->
                    <div class="card-body">

                        <form class="form-horizontal" id="f_satcwar" name="f_satcwar" action="?Page=atc-war" method="post" autocomplete="off">
                            <div class="row gy-4">
                                <div class="col-xxl-6 col-md-6 text-center">
                                    <br>
                                    <div class="form-check form-check-inline">

                                        <input type="radio" class="btn-check" name="warrantycheck" id="curren" onchange='if(this.value != 9) { this.form.submit(); }' value="0" <?php if ($AtcexpdateST == '0') {
                                                                                                                                                                                    echo 'checked';
                                                                                                                                                                                } else {
                                                                                                                                                                                } ?> required>
                                        <label class="btn btn-outline-success shadow-none" for="curren"><i class="mdi mdi-calendar-check-outline"></i> ยังอยู่ในประกัน</label>

                                        <input type="radio" class="btn-check" name="warrantycheck" id="exp" onchange='if(this.value != 9) { this.form.submit(); }' value="1" <?php if ($AtcexpdateST == '1') {
                                                                                                                                                                                    echo 'checked';
                                                                                                                                                                                } else {
                                                                                                                                                                                } ?> required>
                                        <label class="btn btn-outline-danger2 shadow-none" for="exp"><i class="mdi mdi-calendar-clock-outline"></i> ประกันหมดอายุ</label>

                                        <input type="radio" class="btn-check" name="warrantycheck" id="Nowexp" onchange='if(this.value != 9) { this.form.submit(); }' value="2" <?php if ($AtcexpdateST == '2') {
                                                                                                                                                                                    echo 'checked';
                                                                                                                                                                                } else {
                                                                                                                                                                                } ?> required>
                                        <label class="btn btn-outline-secondary shadow-none" for="Nowexp"><i class="mdi mdi-calendar-cursor"></i>หมดอายุเดือนนี้</label>

                                        <input type="radio" class="btn-check" name="warrantycheck" id="allexp" onchange='if(this.value != 9) { this.form.submit(); }' value="3" <?php if ($AtcexpdateST == '3') {
                                                                                                                                                                                    echo 'checked';
                                                                                                                                                                                } else {
                                                                                                                                                                                } ?> required>
                                        <label class="btn btn-outline-primary2 shadow-none" for="allexp"><i class="mdi mdi-calendar-multiple"></i> ทั้งหมด</label>

                                    </div>

                                </div>
                                <!--end col-->
                                <div class="col-xxl-2 col-md-6">
                                    <div>
                                        <label for="txtexpdatewar" class="form-label"><b>วันที่สิ้นสุดรับประกันตั้งแต่</b></label>
                                        <input type="text" class="form-control" id="txtexpdatewar" name="txtexpdatewar">
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-2 col-md-6">
                                    <div>
                                        <label for="txtexpdatewar2" class="form-label"><b>ถึง</b></label>
                                        <input type="text" class="form-control" id="txtexpdatewar2" name="txtexpdatewar2">
                                    </div>
                                </div>
                                <!--end col-->

                                <div class="col-xxl-2 col-md-6">
                                    <div>
                                        <label for="txtatcst" class="form-label"><b>สถานะข้อมูล</b></label>
                                        <select class="form-select" id="txtatcst" name="txtatcst">
                                            <option value="">ทั้งหมด</option>
                                            <option value="10">ใช้งาน</option>
                                            <option value="20">แบบร่าง</option>
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
                                    <button type="button" class="btn btn-warning2 text-light" onClick="window.location.href = '?Page=atc-war'"><i class="mdi mdi-backup-restore"></i> Reset</button>
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
                        <h4 class="card-title mb-0 flex-grow-1"><i class="mdi mdi-format-list-bulleted"></i> รายการวัสดุ</h4>

                    </div><!-- end card header -->
                    <div class="card-body">

                        <table id="articlewaranty" class="table table-bordered dt-responsive  table-striped align-middle text-wrap table-hover" style="width:100%">
                            <thead>
                                <tr class="text-center">
                                    <th hidden></th>
                                    <th>วันสิ้นสุดรับประกัน</th>
                                    <th>ชื่อวัสดุ</th>
                                    <th>ประเภทวัสดุ</th>
                                    <th>จำนวน</th>
                                    <th>ราคาต่อหน่วย</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($AllArticel as $key_atc => $value_atc) {
                                    $Yearsource = $value_atc["AMS_BUDGET_YEAR"] + 543;
                                ?>
                                    <tr class="text-center cursor-pointer">
                                        <td hidden><?php echo $value_atc["AMS_ARTICLE_EXPDATE"]; ?></td>
                                        <td data-bs-toggle="modal" data-bs-target="#ArticlecontentModal" data-bs-id="<?php echo $value_atc["AMS_ARTICLE_ID"]; ?>" data-bs-atcnm="<?php echo $value_atc["AMS_ARTICLE_NM"]; ?>" data-bs-type="<?php echo $value_atc["AMS_ARTICLE_TYPENM"]; ?>" data-bs-cnt="<?php echo $value_atc["AMS_ARTICLE_QTY"]; ?>" data-bs-price="<?php echo number_format($value_atc["AMS_ARTICLE_PRICE"], 2); ?>" data-bs-expdate="<?php echo $ArticleList->dateToThai($value_atc["AMS_ARTICLE_EXPDATE"]); ?>" data-bs-year="<?php echo $Yearsource . ' ' . $value_atc['AMS_BUDGET_SOURCENM'] . ' ' . $value_atc['AMS_BUDGET_CLASSNM'] . ' ' . $value_atc['AMS_BUDGET_TYPENM']; ?>" data-bs-lct="<?php echo $value_atc["AMS_LCT_NM"]; ?>" data-bs-bl="<?php echo $value_atc["AMS_ARTICLE_BALANCE"]; ?>" data-bs-bldate="<?php echo $ArticleList->dateToThai($value_atc["AMS_ARTICLE_DBL"]); ?>" data-bs-status="<?php echo $value_atc['AMS_ARTICLE_ST'] == '10' ? 'ใช้งาน' : 'แบบร่าง'; ?>" data-bs-unit="<?php echo $value_atc["AMS_ARTICLE_UNIT"]; ?>" data-bs-fdate="<?php echo $value_atc["AMS_ARTICLE_FDATE"]; ?>">
                                            <h5><span class="badge rounded-pill bg-<?php echo $value_atc['AMS_ARTICLE_EXPDATE'] < $dateNowWar ? 'danger' : 'success'; ?> text-dark"><i class="mdi mdi-sort-calendar-ascending"></i> <?php echo $ArticleList->dateToThai($value_atc["AMS_ARTICLE_EXPDATE"]); ?></span></h5>
                                        </td>
                                        <td data-bs-toggle="modal" data-bs-target="#ArticlecontentModal" data-bs-id="<?php echo $value_atc["AMS_ARTICLE_ID"]; ?>" data-bs-atcnm="<?php echo $value_atc["AMS_ARTICLE_NM"]; ?>" data-bs-type="<?php echo $value_atc["AMS_ARTICLE_TYPENM"]; ?>" data-bs-cnt="<?php echo $value_atc["AMS_ARTICLE_QTY"]; ?>" data-bs-price="<?php echo number_format($value_atc["AMS_ARTICLE_PRICE"], 2); ?>" data-bs-expdate="<?php echo $ArticleList->dateToThai($value_atc["AMS_ARTICLE_EXPDATE"]); ?>" data-bs-year="<?php echo $Yearsource . ' ' . $value_atc['AMS_BUDGET_SOURCENM'] . ' ' . $value_atc['AMS_BUDGET_CLASSNM'] . ' ' . $value_atc['AMS_BUDGET_TYPENM']; ?>" data-bs-lct="<?php echo $value_atc["AMS_LCT_NM"]; ?>" data-bs-bl="<?php echo $value_atc["AMS_ARTICLE_BALANCE"]; ?>" data-bs-bldate="<?php echo $ArticleList->dateToThai($value_atc["AMS_ARTICLE_DBL"]); ?>" data-bs-status="<?php echo $value_atc['AMS_ARTICLE_ST'] == '10' ? 'ใช้งาน' : 'แบบร่าง'; ?>" data-bs-unit="<?php echo $value_atc["AMS_ARTICLE_UNIT"]; ?>" data-bs-fdate="<?php echo $value_atc["AMS_ARTICLE_FDATE"]; ?>"><?php echo $value_atc["AMS_ARTICLE_NM"]; ?></td>
                                        <td data-bs-toggle="modal" data-bs-target="#ArticlecontentModal" data-bs-id="<?php echo $value_atc["AMS_ARTICLE_ID"]; ?>" data-bs-atcnm="<?php echo $value_atc["AMS_ARTICLE_NM"]; ?>" data-bs-type="<?php echo $value_atc["AMS_ARTICLE_TYPENM"]; ?>" data-bs-cnt="<?php echo $value_atc["AMS_ARTICLE_QTY"]; ?>" data-bs-price="<?php echo number_format($value_atc["AMS_ARTICLE_PRICE"], 2); ?>" data-bs-expdate="<?php echo $ArticleList->dateToThai($value_atc["AMS_ARTICLE_EXPDATE"]); ?>" data-bs-year="<?php echo $Yearsource . ' ' . $value_atc['AMS_BUDGET_SOURCENM'] . ' ' . $value_atc['AMS_BUDGET_CLASSNM'] . ' ' . $value_atc['AMS_BUDGET_TYPENM']; ?>" data-bs-lct="<?php echo $value_atc["AMS_LCT_NM"]; ?>" data-bs-bl="<?php echo $value_atc["AMS_ARTICLE_BALANCE"]; ?>" data-bs-bldate="<?php echo $ArticleList->dateToThai($value_atc["AMS_ARTICLE_DBL"]); ?>" data-bs-status="<?php echo $value_atc['AMS_ARTICLE_ST'] == '10' ? 'ใช้งาน' : 'แบบร่าง'; ?>" data-bs-unit="<?php echo $value_atc["AMS_ARTICLE_UNIT"]; ?>" data-bs-fdate="<?php echo $value_atc["AMS_ARTICLE_FDATE"]; ?>"><?php echo $value_atc["AMS_ARTICLE_TYPENM"]; ?></td>
                                        <td data-bs-toggle="modal" data-bs-target="#ArticlecontentModal" data-bs-id="<?php echo $value_atc["AMS_ARTICLE_ID"]; ?>" data-bs-atcnm="<?php echo $value_atc["AMS_ARTICLE_NM"]; ?>" data-bs-type="<?php echo $value_atc["AMS_ARTICLE_TYPENM"]; ?>" data-bs-cnt="<?php echo $value_atc["AMS_ARTICLE_QTY"]; ?>" data-bs-price="<?php echo number_format($value_atc["AMS_ARTICLE_PRICE"], 2); ?>" data-bs-expdate="<?php echo $ArticleList->dateToThai($value_atc["AMS_ARTICLE_EXPDATE"]); ?>" data-bs-year="<?php echo $Yearsource . ' ' . $value_atc['AMS_BUDGET_SOURCENM'] . ' ' . $value_atc['AMS_BUDGET_CLASSNM'] . ' ' . $value_atc['AMS_BUDGET_TYPENM']; ?>" data-bs-lct="<?php echo $value_atc["AMS_LCT_NM"]; ?>" data-bs-bl="<?php echo $value_atc["AMS_ARTICLE_BALANCE"]; ?>" data-bs-bldate="<?php echo $ArticleList->dateToThai($value_atc["AMS_ARTICLE_DBL"]); ?>" data-bs-status="<?php echo $value_atc['AMS_ARTICLE_ST'] == '10' ? 'ใช้งาน' : 'แบบร่าง'; ?>" data-bs-unit="<?php echo $value_atc["AMS_ARTICLE_UNIT"]; ?>" data-bs-fdate="<?php echo $value_atc["AMS_ARTICLE_FDATE"]; ?>"><?php echo $value_atc["AMS_ARTICLE_QTY"]; ?></td>
                                        <td data-bs-toggle="modal" data-bs-target="#ArticlecontentModal" data-bs-id="<?php echo $value_atc["AMS_ARTICLE_ID"]; ?>" data-bs-atcnm="<?php echo $value_atc["AMS_ARTICLE_NM"]; ?>" data-bs-type="<?php echo $value_atc["AMS_ARTICLE_TYPENM"]; ?>" data-bs-cnt="<?php echo $value_atc["AMS_ARTICLE_QTY"]; ?>" data-bs-price="<?php echo number_format($value_atc["AMS_ARTICLE_PRICE"], 2); ?>" data-bs-expdate="<?php echo $ArticleList->dateToThai($value_atc["AMS_ARTICLE_EXPDATE"]); ?>" data-bs-year="<?php echo $Yearsource . ' ' . $value_atc['AMS_BUDGET_SOURCENM'] . ' ' . $value_atc['AMS_BUDGET_CLASSNM'] . ' ' . $value_atc['AMS_BUDGET_TYPENM']; ?>" data-bs-lct="<?php echo $value_atc["AMS_LCT_NM"]; ?>" data-bs-bl="<?php echo $value_atc["AMS_ARTICLE_BALANCE"]; ?>" data-bs-bldate="<?php echo $ArticleList->dateToThai($value_atc["AMS_ARTICLE_DBL"]); ?>" data-bs-status="<?php echo $value_atc['AMS_ARTICLE_ST'] == '10' ? 'ใช้งาน' : 'แบบร่าง'; ?>" data-bs-unit="<?php echo $value_atc["AMS_ARTICLE_UNIT"]; ?>" data-bs-fdate="<?php echo $value_atc["AMS_ARTICLE_FDATE"]; ?>"><?php echo number_format($value_atc["AMS_ARTICLE_PRICE"], 2); ?></td>
                                      
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
<div class="modal fade" id="ArticlecontentModal" tabindex="-1" aria-labelledby="ArticlecontentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ArticlecontentModalLabel">รายละเอียดข้อมูล</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-md-6  atcname">
                            <label for="txtdatcnamemodal" class="col-form-label"><b>ชื่อวัสดุ:</b></label>
                            <input type="text" class="form-control" id="txtatcnamemodal" disabled="disabled">
                        </div>
                        <div class="col-md-6  type">
                            <label for="txttypemodal" class="col-form-label"><b>ประเภท:</b></label>
                            <input type="text" class="form-control" id="txttypemodal" disabled="disabled">
                        </div>
                        <div class="col-md-6  cnt">
                            <label for="txtcntmodal" class="col-form-label"><b>จำนวน:</b></label>
                            <input type="text" class="form-control" id="txtcntmodal" disabled="disabled">
                        </div>
                        <div class="col-md-6  price">
                            <label for="txtpricemodal" class="col-form-label"><b>ราคาต่อหน่วย:</b></label>
                            <input type="text" class="form-control" id="txtpricemodal" disabled="disabled">
                        </div>
                        <div class="col-md-6  unit">
                            <label for="txtunitmodal" class="col-form-label"><b>หน่วยนับ:</b></label>
                            <input type="text" class="form-control" id="txtunitmodal" disabled="disabled">
                        </div>
                        <div class="col-md-6  expdate">
                            <label for="txtexpdatemodal" class="col-form-label"><b>วันสิ้นสุดการรับประกัน:</b></label>
                            <input type="text" class="form-control" id="txtexpdatemodal" disabled="disabled">
                        </div>
                        <div class="col-md-6  year">
                            <label for="txtyearmodal" class="col-form-label"><b>ปีงบประมาณและแหล่งที่มา:</b></label>
                            <input type="text" class="form-control" id="txtyearmodal" disabled="disabled">
                        </div>
                        <div class="col-md-6  lct">
                            <label for="txtlctmodal" class="col-form-label"><b>หน่วยงานรับผิดชอบ:</b></label>
                            <input type="text" class="form-control" id="txtlctmodal" disabled="disabled">
                        </div>
                        <div class="col-md-6  bl">
                            <label for="txtblmodal" class="col-form-label"><b>จำนวนคงเหลือ:</b></label>
                            <input type="text" class="form-control" id="txtblmodal" disabled="disabled">
                        </div>
                        <div class="col-md-6  bldate">
                            <label for="txtbldatemodal" class="col-form-label"><b>วันที่ตรวจสอบยอด:</b></label>
                            <input type="text" class="form-control" id="txtbldatemodal" disabled="disabled">
                        </div>
                        <div class="col-md-6  status">
                            <label for="txtstatusmodal" class="col-form-label"><b>สถานะข้อมูล:</b></label>
                            <input type="text" class="form-control" id="txtstatusmodal" disabled="disabled">
                        </div>
                        <div class="col-md-6  fdate">
                            <label for="txtfdatemodal" class="col-form-label"><b>วันที่บันทึก:</b></label>
                            <input type="text" class="form-control" id="txtfdatemodal" disabled="disabled">
                        </div>
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
<!--end modal -->