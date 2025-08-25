<?php
$_SESSION['chkDup'] = '0';
include 'product_function.php';
$ProductList = new ProductResult();

$SetAll = $ProductList->ProductSetAllList($db);
?>

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0"><i class="mdi mdi-laptop"></i> จัดการครุภัณฑ์ </h4>

                    <div class="page-title-right">

                    </div>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1"><i class="mdi mdi-database-search"></i> ค้นหาข้อมูลชุดเพื่อ Copy</h4>
                        <div class="text-right">
                                <button type="button" class="btn btn-danger2" onclick="window.location.href='?Page=product-manage';"><i class="mdi mdi-arrow-left-circle"></i> กลับ</button>
                            </div>
                    </div><!-- end card header -->
                    <div class="card-body">

                        <form class="form-horizontal" id="f_productsr" name="f_productsr" action="?Page=pdc-dup" method="post" autocomplete="off">
                            <div class="row gy-4">

                                <div class="col-xxl-4 col-md-6">
                                    <div>
                                        <label for="txtproductset" class="form-label"><b>ชุดครุภัณฑ์</b></label>
                                        <select class="form-select js-example-basic-single" id="txtproductset" name="txtproductset" required>
                                            <option value="">กรุณาเลือกชุดครุภัณฑ์</option>
                                            <?php foreach ($SetAll as $key_set => $value_set) { ?>
                                                <option value="<?php echo $value_set['AMS_PRODUCTSET_ID']; ?>"><?php echo  $value_set['AMS_PRODUCTSET_NO'] . ' | ' . $value_set['AMS_PRODUCTSET_NM']; ?></option>
                                            <?php  } ?>
                                        </select>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-2 col-md-6 text-left">
                                    <br>
                                    <button type="submit" class="btn btn-info2 text-light"><i class="mdi mdi-content-copy"></i> เลือกชุด</button>
                                    <!-- <button type="button" class="btn btn-warning2 text-light" onClick="window.location.href = '?Page=product-addsetpre'"><i class="mdi mdi-backup-restore"></i> Reset</button> -->
                                </div>
                                <div class="col-xxl-2 col-md-6 text-center">
                                    <br>
                                    <button type="button" class="btn btn-warning2 text-light" onClick="window.location.href = '?Page=pdc-addset'"><i class="mdi mdi-folder-star-multiple"></i> เพิ่มชุดครุภัณฑ์ใหม่</button>
                                </div>
                            </div>
                            <!--end row-->

                        </form>



                    </div>
                </div>

            </div>
        </div>

    </div>
</div>