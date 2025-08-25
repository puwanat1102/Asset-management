<?php
include 'product_function.php';
$ProductAction = new ProductResult();
$action = isset($_POST['ActionProduct']) ? $_POST['ActionProduct'] : '';
$chkDup = isset($_SESSION['chkDup']) ? $_SESSION['chkDup'] : '0';

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
        <!-- 11 -->
        <?php

        if (isset($p)) {

            if ($chkDup == '0') {

                switch ($action) {
                    case 'EditListSet':
                        // set
                        $countQTY = count($_POST['txtproductno']);

                        for ($o = 0; $o < $countQTY; $o++) {
                            $chkDelo = isset($_POST['chkDel'][$o]) ? $_POST['chkDel'][$o] : '0';
                       
                           if($chkDelo == '1'){

                             $arrayDel[] = $chkDelo;

                           }else{
                              
                           }
                           
                       }

                       $chkplus= isset($arrayDel) ? array_sum($arrayDel) : 0;
        
                        $idsetpdc = $_POST['IdsetProduct'];
                        $setnm = $_POST['txtproductsetname'];
                        $setno =  $ProductAction->strspace($_POST['txtproductsetno'], 1);
                        $setqty = $countQTY - $chkplus;
                        $setprice = $_POST['txtsetprice'];
                        $toSaveproductPriceSet = $ProductAction->strspace($setprice, 2);
                        $setTotal = $toSaveproductPriceSet * $setqty;
                        $setyear = $_POST['txtyearatc2'];
                        $setsource = $_POST['txtsourceatc2'];
                        $setlct = $_POST['txtlctpdcset'];
                        $setdatast = $_POST['txtpdcsetst'];
                        $setfdate = $_POST['fdate'];
                        $setfstf = $_POST['fstf'];
                        $productrubpid = $_POST['txtrubpid'];
                        $productrubpid == "" ? $rubpid = 'null' : $rubpid = "'" . $productrubpid . "'";

                        $UpdateSets = $ProductAction->UpdateProductSet($idsetpdc, $setnm, $setno, $setqty, $toSaveproductPriceSet, $setTotal, $setyear, $setsource, $setlct, $setdatast, $setfstf, $setfdate,$rubpid, $db);
                        if ($UpdateSets == '1') {
                            $_SESSION['chkDup'] = '1';
                            //SetSucess
        ?>
                            <div class="row">
                                <div class="col-xl-4 col-md-12"></div>
                                <div class="col-xl-4 col-md-12">
                                    <!-- card -->
                                    <div class="card card-animate">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">สถานะการบันทึก</p>
                                                </div>
                                                <div class="flex-shrink-0">
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-end justify-content-between mt-4">
                                                <div>
                                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                                        <b>แก้ไขข้อมูลชุดครุภัณฑ์เรียบร้อย</b>
                                                    </h4>
                                                </div>
                                                <div class="avatar-sm flex-shrink-0">
                                                    <button class="btn btn-success" onClick="location.href='?Page=product-manage'">
                                                        ตกลง
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end card -->
                                </div><!-- end col -->
                                <div class="col-xl-4 col-md-12" style="display: none;">

                                </div>
                            </div>
                            <div class="row">
                                <?php

                                //SetSucess

                                // product
                                $pdcsetsdate = $_POST['txtsdate2'];
                                $pdcsetsdate == "" ? $TosaveProductSdate = 'null' : $TosaveProductSdate = "'" . $ProductAction->dateTosave($pdcsetsdate) . "'";
                                $pdcsetexpdate = $_POST['txtexpdate2'];
                                $pdcsetexpdate == "" ? $TosaveproductExpdate = 'null' : $TosaveproductExpdate = "'" . $ProductAction->dateTosave($pdcsetexpdate) . "'";

                                //  echo $countQTY;

                                if ($countQTY > 0) {

                                    for ($x = 0; $x < $countQTY; $x++) {

                                        $IdProduct = $_POST['idpdcchk'][$x];
                                        $productNo = $_POST['txtproductno'][$x];
                                        $productName2 = $_POST['txtproductname'][$x];
                                        $productUnit = $_POST['txtunit'][$x];
                                        $pdcsetprice = $_POST['txtprice'][$x];
                                        $toSaveproductPrice = $ProductAction->strspace($pdcsetprice, 2);
                                        $productType = $_POST['txtproductype'][$x];
                                        $productLocation = $_POST['txtlocation'][$x];
                                        $productStatus = $_POST['txtstatusproductset'][$x];
                                        $chkDel = isset($_POST['chkDel'][$x]) ? $_POST['chkDel'][$x] : '0';
                                        // echo $chkDel . '<br>';
                                        if ($setdatast == '20') {
                                            $productDatastatus = '20';
                                        } else {
                                            if ($chkDel == '1') {
                                                $productDatastatus = '99';
                                            } else {
                                                $productDatastatus = $_POST['txtpdcsetstlist'][$x];
                                            }
                                        }

                                        if ($_POST['idpdcchk'][$x] != 'null') {


                                            $updateProductTosets =  $ProductAction->UpdateProductToSets($idsetpdc, $IdProduct, $productNo, $productName2, $productUnit, $toSaveproductPrice, $TosaveProductSdate, $TosaveproductExpdate, $productType, $setlct, $productLocation, $productStatus, $setyear, $setsource, $productDatastatus, $setfstf, $setfdate, $db);
                                            if ($updateProductTosets == '1') {
                                ?>
                                                <div class="col-xl-3 col-md-12">
                                                    <div class="card text-center">
                                                        <br>
                                                        <h6 class="  ff-secondary mb-4">
                                                            <b><i class="mdi mdi-content-save-check"></i>แก้ไข<?php echo $productNo; ?> สำเร็จ</b>
                                                        </h6>
                                                    </div>
                                                </div>
                                            <?php
                                            } else {
                                            ?>
                                                <div class="col-xl-3 col-md-12">
                                                    <div class="card text-center">
                                                        <br>
                                                        <h6 class="  ff-secondary mb-4">
                                                            <b><i class="mdi mdi-content-save-alert"></i>แก้ไข <?php echo $productNo; ?> ไม่สำเร็จ</b>
                                                        </h6>
                                                    </div>
                                                </div>
                                            <?php

                                            }
                                        } else {

                                            //GenIdProduct
                                            $yearMonth = substr(date("Y") + 543, -2);
                                            $Month = substr(date("m"), -2);
                                            $year_MaxId = $yearMonth . $Month . '2';
                                            $data_ad = $ProductAction->show_maxidNew($year_MaxId, $db);
                                            $maxId = substr($data_ad['0']['MAX_ID'], -4);

                                            $maxId = ($maxId + 1);
                                            $maxId = substr("0000" . $maxId, -4);
                                            $maxId = $Month . "2" . substr("0000" . $maxId, -4);
                                            $idadgen_5 = $yearMonth . $maxId;
                                            //echo $idadgen_5;
                                            //GenIdProduct
                                            $iNsertProductList = $ProductAction->InsertProductAddSet(
                                                $idadgen_5,
                                                $productNo,
                                                $productName2,
                                                $productUnit,
                                                $toSaveproductPrice,
                                                $TosaveProductSdate,
                                                $TosaveproductExpdate,
                                                $productType,
                                                $setlct,
                                                $productLocation,
                                                $productStatus,
                                                $setyear,
                                                $setsource,
                                                $productDatastatus,
                                                $setfstf,
                                                $setfdate,
                                                $idsetpdc,
                                                $db
                                            );

                                            if ($iNsertProductList == '1') {
                                            ?>
                                                <div class="col-xl-3 col-md-12">
                                                    <div class="card text-center">
                                                        <br>
                                                        <h6 class="  ff-secondary mb-4">
                                                            <b><i class="mdi mdi-content-save-check"></i>เพิ่ม<?php echo $productNo; ?> สำเร็จ</b>
                                                        </h6>
                                                    </div>
                                                </div>
                                            <?php
                                            } else {
                                            ?>
                                                <div class="col-xl-3 col-md-12">
                                                    <div class="card text-center">
                                                    <br>
                                                        <h6 class="  ff-secondary mb-4">
                                                            <b><i class="mdi mdi-content-save-alert"></i>เพิ่ม <?php echo $productNo; ?> ไม่สำเร็จ</b>
                                                        </h6>
                                                    </div>
                                                </div>
                                <?php
                                            }
                                        }
                                    }
                                } else {
                                }

                                ?>

                            </div>
                        <?php


                            // product

                        } else {
                            $_SESSION['chkDup'] = '1';
                           
                        ?>
                            <div class="row">
                                <div class="col-xl-4 col-md-12"></div>
                                <div class="col-xl-4 col-md-12">
                                    <!-- card -->
                                    <div class="card card-animate">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">สถานะการบันทึก</p>
                                                </div>
                                                <div class="flex-shrink-0">
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-end justify-content-between mt-4">
                                                <div>
                                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                                        <b>แก้ไขข้อมูลชุดครุภัณฑ์ไม่สำเร็จ</b>
                                                    </h4>
                                                </div>
                                                <div class="avatar-sm flex-shrink-0">
                                                    <button class="btn btn-success" onClick="location.href='?Page=product-manage'">
                                                        ตกลง
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end card -->
                                </div><!-- end col -->
                                <div class="col-xl-4 col-md-12" style="display: none;">

                                </div>
                            </div>
                <?php

                        }



                        // set



                        break;

                    default:
                        # code...
                        break;
                }
            } else {
                $_SESSION['chkDup'] = '1';
                ?>
                <div class="row">
                    <div class="col-xl-4 col-md-12"></div>
                    <div class="col-xl-4 col-md-12">

                    </div><!-- end col -->
                    <div class="col-xl-4 col-md-12" style="display: none;">
                        <button type="button" class="btn btn-primary btn-sm" id="sa-errorpdc">confrim</button>
                    </div>
                </div>
        <?php

            }
        } else {
        }
        ?>

        <!-- 11 -->


    </div>
</div>