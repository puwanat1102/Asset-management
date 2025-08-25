<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <?php
                        include 'product_function.php';
                        $ProductAction = new ProductResult();
                        $action = isset($_POST['ActionProduct']) ? $_POST['ActionProduct'] : '';
                        $chkDup = isset($_SESSION['chkDup']) ? $_SESSION['chkDup'] : '0';

                        if (isset($p)) {

                            if ($chkDup == '0') {

                                switch ($action) {
                                    case 'Add':

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
                                        $productNo = $ProductAction->strspace($_POST['txtproductno'], 1);
                                        // $productNoTosave = str_replace(' ', '', "$productNo");
                                        $productName = $ProductAction->strspace($_POST['txtproductname'], 1);
                                        $productName2 = $_POST['txtproductname'];
                                        $productUnit = $ProductAction->strspace($_POST['txtunit'], 1);
                                        $productPrice = $_POST['txtprice'];
                                        $toSaveproductPrice = $ProductAction->strspace($productPrice, 2);
                                        $productSdate = $_POST['txtsdate'];
                                        $productSdate == "" ? $TosaveProductSdate = 'null' : $TosaveProductSdate = "'" . $ProductAction->dateTosave($productSdate) . "'";
                                        $productExpdate = $_POST['txtexpdate'];
                                        $productExpdate == "" ? $TosaveproductExpdate = 'null' : $TosaveproductExpdate = "'" . $ProductAction->dateTosave($productExpdate) . "'";
                                        $productType = $_POST['txtproductype'];
                                        $productLct = $_POST['txtlctpdc'];
                                        $productLocation = $_POST['txtlocation'];
                                        $productStatus = $_POST['txtstatusproduct'];
                                        $productYear = $_POST['txtyearatc'];
                                        $productSource = $_POST['txtsourceatc'];
                                        $productDatastatus = $_POST['txtpdcst'];
                                        $productFdate = $_POST['fdate'];
                                        $productFstf = $_POST['fstf'];

                                        $iNsertProductList = $ProductAction->InsertProduct($idadgen_5, $productNo, $productName2, $productUnit, $toSaveproductPrice, $TosaveProductSdate, $TosaveproductExpdate, $productType, $productLct, $productLocation, $productStatus, $productYear, $productSource, $productDatastatus, $productFstf, $productFdate, $db);
                                        if ($iNsertProductList == '1') {

                                            $_SESSION['chkDup'] = '1';
                                            $chkpdcsubsetno = isset($_POST['txtproductsubno']) ? $_POST['txtproductsubno'] : '';

                                            if ($chkpdcsubsetno != "") {
                                                $countsubpdc = count($chkpdcsubsetno);
                                                if ($countsubpdc > 0) {

                                                    for ($i = 0; $i < $countsubpdc; $i++) {

                                                        //GenIdProductsubSet
                                                        $yearMonth2 = substr(date("Y") + 543, -2);
                                                        $Month2 = substr(date("m"), -2);
                                                        $year_MaxId2 = $yearMonth2 . $Month2 . '8';
                                                        $data_ad2 = $ProductAction->show_maxidNewSubSet($year_MaxId2, $db);
                                                        $maxId2 = substr($data_ad2['0']['MAX_ID'], -4);

                                                        $maxId2 = ($maxId2 + 1);
                                                        $maxId2 = substr("0000" . $maxId2, -4);
                                                        $maxId2 = $Month2 . "8" . substr("0000" . $maxId2, -4);
                                                        $idadgen_8 = $yearMonth2 . $maxId2;
                                                        //echo $idadgen_8;
                                                        //GenIdProductsubSet

                                                        $productSubNo = $ProductAction->strspace($_POST['txtproductsubno'][$i], 1);
                                                        $productSubName = $ProductAction->strspace($_POST['txtproductsubname'][$i], 1);

                                                        $insertSubset = $ProductAction->InsertProductSubSet($idadgen_8, $idadgen_5, $productSubNo, $productSubName, $productDatastatus, $productFstf, $productFdate, $db);
                                                        if ($insertSubset) {
                                                            echo $productSubNo . 'success<br>';
                                                        } else {
                                                            echo $productSubNo . 'error<br>';
                                                        }
                                                    }
                                                }
                                            } else {
                                            }

                        ?>
                                            <div class="row">
                                                <div class="col-xl-4 col-md-12"></div>
                                                <div class="col-xl-4 col-md-12">
                                                    <!-- card -->
                                                    <!-- <div class="card card-animate">
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
                                                                        <b>บันทึกข้อมูลเรียบร้อย</b>
                                                                    </h4>
                                                                </div>
                                                                <div class="avatar-sm flex-shrink-0">
                                                                    <button class="btn btn-success" onClick="location.href='?Page=product-manage'">
                                                                        ตกลง
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> -->
                                                    <!-- end card -->
                                                </div><!-- end col -->
                                                <div class="col-xl-4 col-md-12" style="display: none;">
                                                    <button type="button" class="btn btn-primary btn-sm" id="sa-successpdc">confrim</button>
                                                </div>
                                            </div>


                                        <?php

                                        } else {

                                            $_SESSION['chkDup'] = '1';
                                        ?>
                                            <div class="row">
                                                <div class="col-xl-4 col-md-12"></div>
                                                <div class="col-xl-4 col-md-12">
                                                    <!-- card -->
                                                    <!-- <div class="card card-animate">
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
                                                                        <b>ไม่สามารถบันทึกข้อมูลได้</b>
                                                                    </h4>
                                                                </div>
                                                                <div class="avatar-sm flex-shrink-0">
                                                                    <button class="btn btn-danger2" onClick="location.href='?Page=pdc-add'">
                                                                        ตกลง
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> -->
                                                    <!-- end card -->
                                                </div><!-- end col -->
                                                <div class="col-xl-4 col-md-12" style="display: none;">
                                                    <button type="button" class="btn btn-primary btn-sm" id="sa-errorpdc">confrim</button>
                                                </div>
                                            </div>
                                            <?php
                                        }

                                        break;

                                    case 'Edit':

                                        $IdProduct = isset($_POST['PdcIdEdit']) ? $_POST['PdcIdEdit'] : '';
                                        if ($IdProduct != "") {

                                            $productNo = $ProductAction->strspace($_POST['txtproductno'], 1);
                                            $productName = $ProductAction->strspace($_POST['txtproductname'], 1);
                                            $productName2 = $_POST['txtproductname'];
                                            $productUnit = $ProductAction->strspace($_POST['txtunit'], 1);
                                            $productPrice = $_POST['txtprice'];
                                            $toSaveproductPrice = $ProductAction->strspace($productPrice, 2);
                                            $productSdate = $_POST['txtsdate'];
                                            $productSdate == "" ? $TosaveProductSdate = 'null' : $TosaveProductSdate = "'" . $ProductAction->dateTosave($productSdate) . "'";
                                            $productExpdate = $_POST['txtexpdate'];
                                            $productExpdate == "" ? $TosaveproductExpdate = 'null' : $TosaveproductExpdate = "'" . $ProductAction->dateTosave($productExpdate) . "'";
                                            $productType = $_POST['txtproductype'];
                                            $productLct = $_POST['txtlctpdc'];
                                            $productLocation = $_POST['txtlocation'];
                                            $productStatus = $_POST['txtstatusproduct'];
                                            $productYear = $_POST['txtyearatc'];
                                            $productSource = $_POST['txtsourceatc'];
                                            $productDatastatus = $_POST['txtpdcst'];
                                            $productFdate = $_POST['fdate'];
                                            $productFstf = $_POST['fstf'];

                                            $UpdateProduct = $ProductAction->UpdateProduct($IdProduct, $productNo, $productName2, $productUnit, $toSaveproductPrice, $TosaveProductSdate, $TosaveproductExpdate, $productType, $productLct, $productLocation, $productStatus, $productYear, $productSource, $productDatastatus, $productFstf, $productFdate, $db);

                                            if ($UpdateProduct == '1') {

                                                $_SESSION['chkDup'] = '1';
                                                // UpdateSubset
                                                $pdctsubIdno = isset($_POST['txtproductsubno']) ? $_POST['txtproductsubno'] : '';
                                                if ($pdctsubIdno != "") {
                                                    $countQTY = count($_POST['txtproductsubno']);
                                                    for ($o = 0; $o < $countQTY; $o++) {
                                                        $chkDelo = isset($_POST['chkDel2'][$o]) ? $_POST['chkDel2'][$o] : '0';

                                                        if ($chkDelo == '1') {

                                                            $arrayDel[] = $chkDelo;
                                                        } else {
                                                        }
                                                    }

                                                    $chkplus = isset($arrayDel) ? array_sum($arrayDel) : 0;
                                                    if ($countQTY > 0) {
                                                        for ($x = 0; $x < $countQTY; $x++) {
                                                            $chkDel = isset($_POST['chkDel2'][$x]) ? $_POST['chkDel2'][$x] : '0';
                                                            $IdProductSubset = $_POST['idpdcchk2'][$x];
                                                            $SubsetNo = $ProductAction->strspace($_POST['txtproductsubno'][$x], 1);
                                                            $SubsetName = $ProductAction->strspace($_POST['txtproductsubname'][$x], 1);
                                                            if ($chkDel == '1') {
                                                                $productDatastatus = '99';
                                                            } else {
                                                                $productDatastatus = '10';
                                                            }

                                                            if ($_POST['idpdcchk2'][$x] != 'null') {
                                                                $updateSubset = $ProductAction->UpdateSubSetPdc($SubsetNo, $SubsetName, $productFstf, $productFdate, $productDatastatus, $IdProductSubset, $db);
                                                                if ($updateSubset == '1') {
                                                                    echo $SubsetNo . 'success<br>';
                                                                } else {
                                                                    echo $SubsetNo . 'error<br>';
                                                                }
                                                            } else {

                                                                //GenIdProductsubSet
                                                                $yearMonth2 = substr(date("Y") + 543, -2);
                                                                $Month2 = substr(date("m"), -2);
                                                                $year_MaxId2 = $yearMonth2 . $Month2 . '8';
                                                                $data_ad2 = $ProductAction->show_maxidNewSubSet($year_MaxId2, $db);
                                                                $maxId2 = substr($data_ad2['0']['MAX_ID'], -4);

                                                                $maxId2 = ($maxId2 + 1);
                                                                $maxId2 = substr("0000" . $maxId2, -4);
                                                                $maxId2 = $Month2 . "8" . substr("0000" . $maxId2, -4);
                                                                $idadgen_8 = $yearMonth2 . $maxId2;
                                                                //echo $idadgen_8;
                                                                //GenIdProductsubSet

                                                                $insertSubset = $ProductAction->InsertProductSubSet($idadgen_8, $IdProduct, $SubsetNo, $SubsetName, $productDatastatus, $productFstf, $productFdate, $db);
                                                                if ($insertSubset) {
                                                                    echo $SubsetNo . 'successNew<br>';
                                                                } else {
                                                                    echo $SubsetNo . 'errorNew<br>';
                                                                }
                                                            }
                                                        }
                                                    }
                                                } else {
                                                }
                                                // UpdateSubset
                                            ?>
                                                <div class="row">
                                                    <div class="col-xl-4 col-md-12"></div>
                                                    <div class="col-xl-4 col-md-12">

                                                    </div><!-- end col -->
                                                    <div class="col-xl-4 col-md-12" style="display: none;">
                                                        <button type="button" class="btn btn-primary btn-sm" id="sa-successpdc">confrim</button>
                                                    </div>
                                                </div>
                                            <?php

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

                                        break;

                                    case 'Del':

                                        $IdProductDel = isset($_POST['txtiddel']) ? $_POST['txtiddel'] : '';
                                        if ($IdProductDel != "") {

                                            $DelStatus = '99';
                                            $Edate = date('Y-m-d H:i:s');
                                            $Estf = $_SESSION['id'];
                                            $UpdateDelProduct = $ProductAction->UpdateStatusProduct($IdProductDel, $DelStatus, $Estf, $Edate, $db);

                                            if ($UpdateDelProduct == '1') {

                                                $_SESSION['chkDup'] = '1';
                                            ?>
                                                <div class="row">
                                                    <div class="col-xl-4 col-md-12"></div>
                                                    <div class="col-xl-4 col-md-12">

                                                    </div><!-- end col -->
                                                    <div class="col-xl-4 col-md-12" style="display: none;">
                                                        <button type="button" class="btn btn-primary btn-sm" id="sa-successpdc">confrim</button>
                                                    </div>
                                                </div>
                                            <?php

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

                                        break;

                                    case 'DelSet':

                                        $IdProductDel = isset($_POST['txtiddel']) ? $_POST['txtiddel'] : '';
                                        $Setid = isset($_POST['txtsetid']) ? $_POST['txtsetid'] : '';
                                        if ($IdProductDel != "") {

                                            $DelStatus = '99';
                                            $Edate = date('Y-m-d H:i:s');
                                            $Estf = $_SESSION['id'];
                                            $UpdateDelProductSetMain = $ProductAction->UpdateStatusDelsetMain($DelStatus, $Estf, $Edate, $Setid, $db);

                                            if ($UpdateDelProductSetMain == '1') {
                                                $UpdateDelProductSetAll = $ProductAction->UpdateStatusProductDelset($DelStatus, $Estf, $Edate, $Setid, $db);

                                                $_SESSION['chkDup'] = '1';
                                            ?>
                                                <div class="row">
                                                    <div class="col-xl-4 col-md-12"></div>
                                                    <div class="col-xl-4 col-md-12">

                                                    </div><!-- end col -->
                                                    <div class="col-xl-4 col-md-12" style="display: none;">
                                                        <button type="button" class="btn btn-primary btn-sm" id="sa-successpdc">confrim</button>
                                                    </div>
                                                </div>
                                            <?php

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

                                        break;

                                    case 'RestoreSetAll':

                                        $Setid = isset($_POST['txtidrestore']) ? $_POST['txtidrestore'] : '';
                                        if ($Setid != "") {

                                            $DelStatus = '10';
                                            $Edate = date('Y-m-d H:i:s');
                                            $Estf = $_SESSION['id'];
                                            $UpdateDelProductSetMain = $ProductAction->UpdateStatusDelsetMain($DelStatus, $Estf, $Edate, $Setid, $db);

                                            if ($UpdateDelProductSetMain == '1') {
                                                $UpdateDelProductSetAll = $ProductAction->UpdateStatusProductDelset($DelStatus, $Estf, $Edate, $Setid, $db);

                                                $_SESSION['chkDup'] = '1';
                                            ?>
                                                <div class="row">
                                                    <div class="col-xl-4 col-md-12"></div>
                                                    <div class="col-xl-4 col-md-12">

                                                    </div><!-- end col -->
                                                    <div class="col-xl-4 col-md-12" style="display: none;">
                                                        <button type="button" class="btn btn-primary btn-sm" id="sa-successpdc">confrim</button>
                                                    </div>
                                                </div>
                                            <?php

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

                                        break;

                                    case 'Restore':

                                        $IdProductRe = isset($_POST['txtidrestore']) ? $_POST['txtidrestore'] : '';
                                        if ($IdProductRe != "") {

                                            $ReStatus = '10';
                                            $Edate = date('Y-m-d H:i:s');
                                            $Estf = $_SESSION['id'];
                                            $UpdateReProduct = $ProductAction->UpdateStatusProduct($IdProductRe, $ReStatus, $Estf, $Edate, $db);

                                            if ($UpdateReProduct == '1') {

                                                $_SESSION['chkDup'] = '1';
                                            ?>
                                                <div class="row">
                                                    <div class="col-xl-4 col-md-12"></div>
                                                    <div class="col-xl-4 col-md-12">

                                                    </div><!-- end col -->
                                                    <div class="col-xl-4 col-md-12" style="display: none;">
                                                        <button type="button" class="btn btn-primary btn-sm" id="sa-successpdc">confrim</button>
                                                    </div>
                                                </div>
                                            <?php

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

                                            $_SESSION['chkDup'] = '1';
                                            ?>
                                            <div class="row">
                                                <div class="col-xl-4 col-md-12"></div>
                                                <div class="col-xl-4 col-md-12">

                                                    <div class="col-xl-4 col-md-12" style="display: none;">
                                                        <button type="button" class="btn btn-primary btn-sm" id="sa-errorpdc">confrim</button>
                                                    </div>
                                                </div>
                                                <?php

                                            }

                                            break;

                                        case 'RestoreSet':

                                            $IdProductRe = isset($_POST['txtidrestore']) ? $_POST['txtidrestore'] : '';
                                            $IdProductset = isset($_POST['txtidrestoreset']) ? $_POST['txtidrestoreset'] : '';
                                            if ($IdProductRe != "") {

                                                $ReStatus = '10';
                                                $Edate = date('Y-m-d H:i:s');
                                                $Estf = $_SESSION['id'];
                                                $UpdateReProduct = $ProductAction->UpdateStatusProduct($IdProductRe, $ReStatus, $Estf, $Edate, $db);
                                                $AllqtySet = $ProductAction->ProductSetEditAll($IdProductset, $db);
                                                $cntplusQTY = $AllqtySet['0']['AMS_PRODUCTSET_QTY'] + 1;
                                                $priceall = $AllqtySet['0']['AMS_PRODUCTSET_PRICE'] * $cntplusQTY;

                                                if ($UpdateReProduct == '1') {

                                                    $updateSetQTY = $ProductAction->UpdateStatusProductSet($IdProductset, $cntplusQTY, $priceall, $db);

                                                    $_SESSION['chkDup'] = '1';
                                                ?>
                                                    <div class="row">
                                                        <div class="col-xl-4 col-md-12"></div>
                                                        <div class="col-xl-4 col-md-12">

                                                        </div><!-- end col -->
                                                        <div class="col-xl-4 col-md-12" style="display: none;">
                                                            <button type="button" class="btn btn-primary btn-sm" id="sa-successpdc">confrim</button>
                                                        </div>
                                                    </div>
                                                <?php

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

                                                $_SESSION['chkDup'] = '1';
                                                ?>
                                                <div class="row">
                                                    <div class="col-xl-4 col-md-12"></div>
                                                    <div class="col-xl-4 col-md-12">

                                                        <div class="col-xl-4 col-md-12" style="display: none;">
                                                            <button type="button" class="btn btn-primary btn-sm" id="sa-errorpdc">confrim</button>
                                                        </div>
                                                    </div>
                                                <?php

                                            }

                                            break;

                                        case 'AddListSet':

                                            //GenIdProductSet
                                            $yearMonth2 = substr(date("Y") + 543, -2);
                                            $Month2 = substr(date("m"), -2);
                                            $year_MaxId2 = $yearMonth2 . $Month2 . '3';
                                            $data_ad2 = $ProductAction->show_maxidNewSet($year_MaxId2, $db);
                                            $maxId2 = substr($data_ad2['0']['MAX_ID'], -4);

                                            $maxId2 = ($maxId2 + 1);
                                            $maxId2 = substr("0000" . $maxId2, -4);
                                            $maxId2 = $Month2 . "3" . substr("0000" . $maxId2, -4);
                                            $idadgen_6 = $yearMonth2 . $maxId2;
                                            //echo $idadgen_6;
                                            //GenIdProductSet

                                            //set
                                            $pdcsetno = $ProductAction->strspace($_POST['txtproductsetno'], 1);
                                            $pdcsetname = $_POST['txtproductsetname'];
                                            $pdcsetunit = $_POST['txtsetunit'];
                                            $pdcsetprice = $_POST['txtsetprice'];
                                            $toSaveproductPriceSet = $ProductAction->strspace($pdcsetprice, 2);
                                            $pdcsetpriceall = $_POST['txtsetpriceall'];
                                            // $toSaveproductPriceSetall = $toSaveproductPriceSet * $pdcsetunit;
                                            $toSaveproductPriceSetall = $toSaveproductPriceSet;
                                            // $toSaveproductPriceSetall = $ProductAction->strspace($pdcsetpriceall, 2);
                                            $pdcsetsdate = $_POST['txtsdate'];
                                            $pdcsetsdate == "" ? $TosaveProductSdateset = 'null' : $TosaveProductSdateset = "'" . $ProductAction->dateTosave($pdcsetsdate) . "'";
                                            $pdcsetexpdate = $_POST['txtexpdate'];
                                            $pdcsetexpdate == "" ? $TosaveproductExpdateset = 'null' : $TosaveproductExpdateset = "'" . $ProductAction->dateTosave($pdcsetexpdate) . "'";
                                            $pdclctset = $_POST['txtlctpdcset'];
                                            $pdcsetstatus = $_POST['txtstatusproductset'];
                                            $pdcsetyear = $_POST['txtyearatc'];
                                            $pdcsetsorce = $_POST['txtsourceatc'];
                                            $pdcsetdatast = $_POST['txtpdcsetst'];
                                            //set
                                            $productFdate = $_POST['fdate'];
                                            $productFstf = $_POST['fstf'];
                                            $productrubpid = $_POST['txtrubpid'];
                                            $productrubpid == "" ? $rubpid = 'null' : $rubpid = "'" . $productrubpid . "'";

                                            $InsertSet = $ProductAction->InsertProductSet($idadgen_6, $pdcsetname, $pdcsetno, $pdcsetunit, $toSaveproductPriceSet, $toSaveproductPriceSetall, $pdcsetyear, $pdcsetsorce, $pdclctset, $pdcsetdatast, $productFstf, $productFdate, $rubpid, $db);
                                            if ($InsertSet) {

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
                                                                                <b>บันทึกข้อมูลชุดครุภัณฑ์เรียบร้อย</b>
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

                                                        $chkpdcno = isset($_POST['txtproductno']) ? $_POST['txtproductno'] : '';
                                                        if ($chkpdcno != "") {

                                                            $countpcdno = count($chkpdcno);
                                                            if ($countpcdno > 0) {

                                                                for ($i = 0; $i < $countpcdno; $i++) {

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

                                                                    // รายการ
                                                                    $productNo = $ProductAction->strspace($_POST['txtproductno'][$i], 1);
                                                                    $productName = $ProductAction->strspace($_POST['txtproductname'][$i], 1);
                                                                    $productName2 = $_POST['txtproductname'][$i];
                                                                    $productUnit = $ProductAction->strspace($_POST['txtunit'][$i], 1);
                                                                    $productPrice = $_POST['txtprice'][$i];
                                                                    $toSaveproductPrice = $ProductAction->strspace($productPrice, 2);
                                                                    $productType = $_POST['txtproductype'][$i];
                                                                    $productLocation = $_POST['txtlocation'][$i];

                                                                    // รายการ
                                                                    $iNsertProductList = $ProductAction->InsertProductAddSet(
                                                                        $idadgen_5,
                                                                        $productNo,
                                                                        $productName2,
                                                                        $productUnit,
                                                                        $toSaveproductPrice,
                                                                        $TosaveProductSdateset,
                                                                        $TosaveproductExpdateset,
                                                                        $productType,
                                                                        $pdclctset,
                                                                        $productLocation,
                                                                        $pdcsetstatus,
                                                                        $pdcsetyear,
                                                                        $pdcsetsorce,
                                                                        $pdcsetdatast,
                                                                        $productFstf,
                                                                        $productFdate,
                                                                        $idadgen_6,
                                                                        $db
                                                                    );

                                                                    if ($iNsertProductList == '1') {
                                                        ?>
                                                                        <div class="col-xl-3 col-md-12">
                                                                            <div class="card text-center">
                                                                                <br>
                                                                                <h6 class="  ff-secondary mb-4">
                                                                                    <b><i class="mdi mdi-content-save-check"></i> <?php echo $productNo; ?> สำเร็จ</b>
                                                                                </h6>
                                                                            </div>
                                                                        </div>
                                                                        <?php

                                                                        // AddSubset
                                                                        

                                                                            
                                                                                $chkpdcsubsetno = isset($_POST['txtproductsubno']) ? $_POST['txtproductsubno'] : '';
                                                                                if ($chkpdcsubsetno != "") {
                                                                                    $countsubpdc = count($chkpdcsubsetno);
                                                                                    if ($countsubpdc > 0) {
                                                                                        for ($ii = 0; $ii < $countsubpdc; $ii++) {
                                                                                                $chkToproduct = isset($_POST['txtchksubandpdc'][$ii]) ? $_POST['txtchksubandpdc'][$ii]-1 : '';
                                                                                                if ($chkToproduct == $i) {
                                                                                                //GenIdProductsubSet
                                                                                                $yearMonth2 = substr(date("Y") + 543, -2);
                                                                                                $Month2 = substr(date("m"), -2);
                                                                                                $year_MaxId2 = $yearMonth2 . $Month2 . '8';
                                                                                                $data_ad2 = $ProductAction->show_maxidNewSubSet($year_MaxId2, $db);
                                                                                                $maxId2 = substr($data_ad2['0']['MAX_ID'], -4);

                                                                                                $maxId2 = ($maxId2 + 1);
                                                                                                $maxId2 = substr("0000" . $maxId2, -4);
                                                                                                $maxId2 = $Month2 . "8" . substr("0000" . $maxId2, -4);
                                                                                                $idadgen_8 = $yearMonth2 . $maxId2;
                                                                                                //echo $idadgen_8;
                                                                                                //GenIdProductsubSet

                                                                                                $productSubNo = $ProductAction->strspace($_POST['txtproductsubno'][$ii], 1);
                                                                                                $productSubName = $ProductAction->strspace($_POST['txtproductsubname'][$ii], 1);

                                                                                                $insertSubset = $ProductAction->InsertProductSubSet($idadgen_8, $idadgen_5, $productSubNo, $productSubName, $pdcsetdatast, $productFstf, $productFdate, $db);
                                                                                                if ($insertSubset) {
                                                                                                    echo $productSubNo . 'success<br>';
                                                                                                } else {
                                                                                                    echo $productSubNo . 'error<br>';
                                                                                                }
                                                                                            }
                                                                                        }
                                                                                    }
                                                                                } else {
                                                                                }
                                                                            


                                                                        // AddSubset

                                                                    } else {

                                                                        ?>
                                                                        <div class="col-xl-3 col-md-12">
                                                                            <div class="card text-center">
                                                                                <br>
                                                                                <h6 class="  ff-secondary mb-4">
                                                                                    <b><i class="mdi mdi-content-save-alert"></i> <?php echo $productNo; ?> ไม่สำเร็จ</b>
                                                                                </h6>
                                                                            </div>
                                                                        </div>
                                                                <?php

                                                                    }
                                                                }
                                                                ?>
                                                    </div>
                                            <?php
                                                            } else {
                                                            }
                                                        } else {
                                                        }
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
                                                                        <b>ไม่สามารถบันทึกข้อมูลได้</b>
                                                                    </h4>
                                                                </div>
                                                                <div class="avatar-sm flex-shrink-0">
                                                                    <button class="btn btn-danger2" onClick="location.href='?Page=pdc-addset'">
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
                                                </div>
                                            </div>
                    </div>
                </div>
            </div>
        </div>