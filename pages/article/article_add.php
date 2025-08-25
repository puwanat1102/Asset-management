<?php
$_SESSION['chkDup'] = '0';
include 'article_function.php';
$ArticleEdit = new ArticleResult();
$editId = isset($_POST['editIdValue']) ? $_POST['editIdValue'] : '';
$EditResultact = $ArticleEdit->ResultEditAtc($editId,$db);
$lctList = $ArticleEdit->Lctlist($db);
$YearbudgetAll = $ArticleEdit->YearBudgets($db);
// print_r($lctList);
?>

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0"><i class="mdi mdi-calculator"></i> จัดการวัสดุ </h4>

                    <div class="page-title-right">

                    </div>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1"><i class="mdi mdi-plus-box"></i> <?php echo $editId == "" ? 'เพิ่ม' : 'แก้ไข'; ?>ข้อมูลวัสดุ <?php echo $editId; ?></h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <?php if ($editId == "") { ?>
                            <form class="form-horizontal" id="f_article" name="f_article" action="?Page=atc-result" method="post" autocomplete="off">
                                <div class="row gy-4">
                                    <div class="col-xxl-6 col-md-6">
                                        <div>
                                            <label for="txtnameatc" class="form-label"><b>ชื่อวัสดุ</b></label>
                                            <input type="text" class="required form-control" id="txtnameatc" name="txtnameatc" required>
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-xxl-6 col-md-6">
                                        <div>
                                            <label for="txttypeatc" class="form-label"><b>ประเภทของวัสดุ</b></label>
                                            <select class="required form-select" id="txttypeatc" name="txttypeatc" style="width: 100%; height:36px;" required>
                                                <option value="">เลือกประเภทของวัสดุ</option>
                                                <option value="10">วัสดุสิ้นเปลือง</option>
                                                <option value="20">วัสดุคงทน</option>
                                            </select>

                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-xxl-3 col-md-6">
                                        <div>
                                            <label for="txtcnt" class="form-label"><b>จำนวน</b></label>
                                            <input type="number" class="required form-control" id="txtcnt" name="txtcnt" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==6) return false;" required />
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-xxl-3 col-md-6">
                                        <div>
                                            <label for="txtunit" class="form-label"><b>หน่วยนับ</b></label>
                                            <input type="text" class="required form-control" name="txtunit" required>
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-xxl-3 col-md-6">
                                        <div>
                                            <label for="txtprice" class="form-label"><b>ราคาต่อหน่วย</b></label>
                                            <!-- <input type="number" class="form-control" name="txtrate" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==8) return false;" required /> -->
                                            <input type="text" class="required form-control"  name="txtprice" id="txtprice" data-type="currency">
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-xxl-3 col-md-6">
                                        <div>
                                            <label for="txtexpdate" class="form-label"><b>วันสิ้นสุดการรับประกัน</b></label>
                                            <input type="text" class="required form-control" id="txtexpdate" name="txtexpdate" required>
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-xxl-2 col-md-6">
                                        <div>
                                            <label for="txtyearatc" class="form-label"><b>ปีงบประมาณ</b></label>
                                            <select class="required form-select" id="txtyearatc" name="txtyearatc" style="width: 100%; height:36px;" required>
                                                <option value="">เลือกปีงบประมาณ</option>
                                                <?php foreach ($YearbudgetAll as $key_bgyear => $value_bdyear) { ?>
                                                    <option value="<?php echo $value_bdyear["BGYEAR"]; ?>"><?php echo $value_bdyear["BGYEAR"] + 543; ?></option>
                                                <?php } ?>
                                            </select>

                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-xxl-6 col-md-6">
                                        <div>
                                            <label for="txtsourceatc" class="form-label"><b>ที่มางบประมาณ</b></label>
                                            <select class="required form-select" id="txtsourceatc" name="txtsourceatc" style="width: 100%; height:36px;" required>
                                                <option value="">กรุณาเลือกปีงบประมาณก่อน</option>
                                            </select>

                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-xxl-4 col-md-6">
                                        <div>
                                            <label for="txtlctatc" class="form-label"><b>หน่วยงานรับผิดชอบ</b></label>
                                            <select class="required js-example-basic-single form-select" id="txtlctatc" name="txtlctatc" style="width: 100%; height:36px;" required>
                                                <option name="txtlctatc" value="">เลือกหน่วยงานรับผิดชอบ</option>
                                                <?php foreach ($lctList as $key_lct => $value_lct) { ?>
                                                    <option value="<?php echo $value_lct["AMS_LCT_ID"]; ?>"><?php echo $value_lct["AMS_LCT_NM"]; ?></option>
                                                <?php } ?>
                                            </select>

                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-xxl-4 col-md-6">
                                        <div>
                                            <label for="txtbalance" class="form-label"><b>จำนวนคงเหลือ</b></label>
                                            <input type="number" class="form-control" name="txtbalance" placeholder="ถ้ามี">
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-xxl-4 col-md-6">
                                        <div>
                                            <label for="txtbalancedate" class="form-label"><b>วันที่ตรวจสอบยอด</b></label>
                                            <input type="text" class="form-control" id="txtbalancedate" name="txtbalancedate" placeholder="ถ้ามี">
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-xxl-4 col-md-6">
                                        <div>
                                            <label for="txtatcst" class="form-label"><b>สถานะข้อมูล</b></label>
                                            <select class="required form-select" id="txtatcst" name="txtatcst" style="width: 100%; height:36px;" required>
                                                <option name="txtatcst" value="10">ใช้งาน</option>
                                                <option name="txtatcst" value="20">แบบร่าง</option>
                                            </select>
                                            <input type="hidden" class="form-control" id="fdate" name="fdate" value="<?= date('Y-m-d H:i:s'); ?>">
                                            <input type="hidden" class="form-control" id="fstf" name="fstf" value="<?php echo $_SESSION['id']; ?>">
                                            <input type="hidden" class="form-control" id="Actionarticle" name="Actionarticle" value="Add">
                                        </div>
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->
                                <br>
                                <div class="border-top">
                                    <div class="card-body text-right">
                                        <button type="button" class="btn btn-danger2" onclick="window.location.href='?Page=atc-manage';"><i class="mdi mdi-arrow-left-circle"></i> กลับ</button>
                                        <button type="submit" class="btn btn-info2"><i class="mdi mdi-content-save"></i> บันทึกข้อมูล</button>
                                    </div>
                                </div>
                            </form>

                        <?php } else {
                        ?>
                            <form class="form-horizontal" id="f_articleed" name="f_articleed" action="?Page=atc-result" method="post" autocomplete="off">
                                <div class="row gy-4">
                                    <div class="col-xxl-6 col-md-6">
                                        <div>
                                            <label for="txtnameatc" class="form-label"><b>ชื่อวัสดุ</b></label>
                                            <input type="text" class="required form-control" id="txtnameatc" name="txtnameatc" value="<?php echo $EditResultact['0']['AMS_ARTICLE_NM']; ?>" required>
                                            <input type="hidden" class="required form-control" id="txtnameatcchk" name="txtnameatcchk" value="<?php echo $EditResultact['0']['AMS_ARTICLE_NM']; ?>" >
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-xxl-6 col-md-6">
                                        <div>
                                            <label for="txttypeatc" class="form-label"><b>ประเภทของวัสดุ</b></label>
                                            <select class="required form-select" id="txttypeatc" name="txttypeatc" style="width: 100%; height:36px;" required>
                                                <option value="10" <?php if($EditResultact['0']['AMS_ARTICLE_TYPE'] == '10'){ echo 'selected'; } ?> >วัสดุสิ้นเปลือง</option>
                                                <option value="20" <?php if($EditResultact['0']['AMS_ARTICLE_TYPE'] == '20'){ echo 'selected'; } ?> >วัสดุคงทน</option>
                                            </select>

                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-xxl-3 col-md-6">
                                        <div>
                                            <label for="txtcnt" class="form-label"><b>จำนวน</b></label>
                                            <input type="number" class="required form-control" id="txtcnt" name="txtcnt" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==6) return false;" value="<?php echo $EditResultact['0']['AMS_ARTICLE_QTY']; ?>" required />
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-xxl-3 col-md-6">
                                        <div>
                                            <label for="txtunit" class="form-label"><b>หน่วยนับ</b></label>
                                            <input type="text" class="required form-control" name="txtunit" value="<?php echo $EditResultact['0']['AMS_ARTICLE_UNIT']; ?>" required>
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-xxl-3 col-md-6">
                                        <div>
                                            <label for="txtprice" class="form-label"><b>ราคาต่อหน่วย</b></label>
                                            <!-- <input type="number" class="form-control" name="txtrate" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==8) return false;" required /> -->
                                            <input type="text" class="required form-control"  name="txtprice" id="txtprice" data-type="currency" value="<?php echo $EditResultact['0']['AMS_ARTICLE_PRICE']; ?>">
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-xxl-3 col-md-6">
                                        <div>
                                            <label for="txtexpdate" class="form-label"><b>วันสิ้นสุดการรับประกัน</b></label>
                                            <input type="text" class="required form-control" id="txtexpdate" name="txtexpdate"  value="<?php echo $ArticleEdit->dateToThai($EditResultact['0']['AMS_ARTICLE_EXPDATE']); ?>" required>
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-xxl-2 col-md-6">
                                        <div>
                                            <label for="txtyearatc" class="form-label"><b>ปีงบประมาณ</b></label>
                                            <select class="required form-select" id="txtyearatc" name="txtyearatc" style="width: 100%; height:36px;" required>
                                                <option value="<?php echo $EditResultact['0']['AMS_BUDGET_YEAR']; ?>"><?php echo $EditResultact['0']['AMS_BUDGET_YEAR']+543; ?></option>
                                                <?php foreach ($YearbudgetAll as $key_bgyear => $value_bdyear) { ?>
                                                    <option value="<?php echo $value_bdyear["BGYEAR"]; ?>" ><?php echo $value_bdyear["BGYEAR"] + 543; ?></option>
                                                <?php } ?>
                                            </select>

                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-xxl-6 col-md-6">
                                        <div>
                                            <label for="txtsourceatc" class="form-label"><b>ที่มางบประมาณ</b></label>
                                            <select class="required form-select" id="txtsourceatc" name="txtsourceatc" style="width: 100%; height:36px;" required>
                                                <option value="<?php echo $EditResultact['0']['AMS_ARTICLE_SOURCE']; ?>"> <?php echo $EditResultact['0']['AMS_BUDGET_SOURCENM'].' '.$EditResultact['0']['AMS_BUDGET_CLASSNM'].' '.$EditResultact['0']['AMS_BUDGET_TYPENM'].'['.number_format($EditResultact['0']['AMS_BUDGET_AMOUNT'],2).']'; ?> </option>
                                            </select>

                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-xxl-4 col-md-6">
                                        <div>
                                            <label for="txtlctatc" class="form-label"><b>หน่วยงานรับผิดชอบ</b></label>
                                            <select class="required form-select js-example-basic-single" id="txtlctatc" name="txtlctatc" style="width: 100%; height:36px;" required>
                                                <?php foreach ($lctList as $key_lct => $value_lct) { ?>
                                                    <option value="<?php echo $value_lct["AMS_LCT_ID"]; ?>" <?php if($EditResultact['0']['AMS_ARTICLE_LCT'] == $value_lct["AMS_LCT_ID"]){ echo 'selected'; } ?> ><?php echo $value_lct["AMS_LCT_NM"]; ?></option>
                                                <?php } ?>
                                            </select>

                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-xxl-4 col-md-6">
                                        <div>
                                            <label for="txtbalance" class="form-label"><b>จำนวนคงเหลือ</b></label>
                                            <input type="number" class="form-control" name="txtbalance" placeholder="ถ้ามี" value="<?php echo $EditResultact['0']['AMS_ARTICLE_BALANCE']; ?>">
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-xxl-4 col-md-6">
                                        <div>
                                            <label for="txtbalancedate" class="form-label"><b>วันที่ตรวจสอบยอด</b></label>
                                            <input type="text" class="form-control" id="txtbalancedate" name="txtbalancedate" placeholder="ถ้ามี" value="<?php echo $ArticleEdit->dateToThai($EditResultact['0']['AMS_ARTICLE_DBL']); ?>">
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-xxl-4 col-md-6">
                                        <div>
                                            <label for="txtatcst" class="form-label"><b>สถานะข้อมูล</b></label>
                                            <select class="required form-select" id="txtatcst" name="txtatcst" style="width: 100%; height:36px;" required>
                                                <option name="txtatcst" value="10" <?php if($EditResultact['0']['AMS_ARTICLE_ST'] == '10'){ echo 'selected'; } ?>>ใช้งาน</option>
                                                <option name="txtatcst" value="20" <?php if($EditResultact['0']['AMS_ARTICLE_ST'] == '20'){ echo 'selected'; } ?>>แบบร่าง</option>
                                            </select>
                                            <input type="hidden" class="form-control" id="fdate" name="fdate" value="<?= date('Y-m-d H:i:s'); ?>">
                                            <input type="hidden" class="form-control" id="fstf" name="fstf" value="<?php echo $_SESSION['id']; ?>">
                                            <input type="hidden" class="form-control" id="Actionarticle" name="Actionarticle" value="Edit">
                                            <input type="hidden" class="form-control" id="articleID" name="articleID" value="<?php echo $EditResultact['0']['AMS_ARTICLE_ID']; ?>">
                                        </div>
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->
                                <br>
                                <div class="border-top">
                                    <div class="card-body text-right">
                                        <button type="button" class="btn btn-danger2" onclick="window.location.href='?Page=atc-manage';"><i class="mdi mdi-arrow-left-circle"></i> กลับ</button>
                                        <button type="submit" class="btn btn-info2"><i class="mdi mdi-content-save"></i> บันทึกข้อมูล</button>
                                    </div>
                                </div>
                            </form>

                        <?php
                        } ?>


                    </div>
                </div>

            </div>
        </div>

    </div>
</div>