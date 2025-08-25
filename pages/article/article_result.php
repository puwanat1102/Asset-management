<!-- <div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body"> -->
<?php
include 'article_function.php';
$ArticleAction = new ArticleResult();
$action = isset($_POST['Actionarticle']) ? $_POST['Actionarticle'] : '';
$chkDup = isset($_SESSION['chkDup']) ? $_SESSION['chkDup'] : '0';


if (isset($p)) {

    if ($chkDup == '0') {

        switch ($action) {
            case 'Add':
                //GenIdAriticle
                $yearMonth = substr(date("Y") + 543, -2);
                $Month = substr(date("m"), -2);
                $year_MaxId = $yearMonth . $Month . '5';
                $data_ad = $ArticleAction->show_maxidNew($year_MaxId, $db);
                $maxId = substr($data_ad['0']['MAX_ID'], -4);

                $maxId = ($maxId + 1);
                $maxId = substr("0000" . $maxId, -4);
                $maxId = $Month . "5" . substr("0000" . $maxId, -4);
                $idadgen_4 = $yearMonth . $maxId;
                // echo $idadgen_4;
                //GenIdAriticle
                $Atcname = $_POST['txtnameatc'];
                $Atcnamesave = str_replace(' ', '', "$Atcname");
                $Atctype = $_POST['txttypeatc'];
                $Atccnt = $_POST['txtcnt'];
                $Atcunit = $_POST['txtunit'];
                $Atcprice = $_POST['txtprice'];
                $toSaveAtcprice = str_replace(',', '', $Atcprice, $var);
                $Atcexpdate = $_POST['txtexpdate'];
                $Atcyear = $_POST['txtyearatc'];
                $Atcsource = $_POST['txtsourceatc'];
                $Atclct = $_POST['txtlctatc'];
                $_POST['txtbalance'] == "" ?  $Atcbalance = 'null' : $Atcbalance = "'" . $_POST['txtbalance'] . "'";
                $Atcbalancedate = $_POST['txtbalancedate'];
                $Atcstatus = $_POST['txtatcst'];
                $Atcfdate = $_POST['fdate'];
                $Atcfstf = $_POST['fstf'];
                $Atcexpdate == "" ? $Tosaveexpdate = "" : $Tosaveexpdate = $ArticleAction->dateTosave($Atcexpdate);
                $Atcbalancedate == "" ? $Tosavebalance = 'null' : $Tosavebalance = "'" . $ArticleAction->dateTosave($Atcbalancedate) . "'";
                $AtcpriceAll = number_format($toSaveAtcprice * $Atccnt, 2);
                $TosavepriceAll = str_replace(',', '', $AtcpriceAll, $var);


                $InsertATC = $ArticleAction->InsertArticle($idadgen_4, $Atcnamesave, $Atctype, $Atccnt, $Atcunit, $toSaveAtcprice, $Tosaveexpdate, $Atcyear, $Atcsource, $Atclct, $Atcbalance, $Tosavebalance, $Atcstatus, $Atcfdate, $Atcfstf, $TosavepriceAll, $db);



                if ($InsertATC == '1') {

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
                                                                        <b>บันทึกข้อมูลเรียบร้อย</b>
                                                                    </h4>
                                                                </div>
                                                                <div class="avatar-sm flex-shrink-0">
                                                                    <button class="btn btn-success" onClick="location.href='?Page=atc-manage'">
                                                                        ตกลง
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> -->
                            <!-- end card -->
                        </div><!-- end col -->
                        <div class="col-xl-4 col-md-12" style="display: none;">
                            <button type="button" class="btn btn-primary btn-sm" id="sa-successatc">confrim</button>
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
                                                                    <button class="btn btn-danger" onClick="location.href='?Page=atc-add'">
                                                                        ตกลง
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> -->
                            <!-- end card -->
                        </div><!-- end col -->
                        <div class="col-xl-4 col-md-12" style="display: none;">
                            <button type="button" class="btn btn-primary btn-sm" id="sa-erroratc">confrim</button>
                        </div>
                    </div>
                    <?php
                }
                break;

            case 'Edit':
                if ($_POST['articleID'] != "") {

                    $idatc = $_POST['articleID'];
                    $Atcname = $_POST['txtnameatc'];
                    $Atcnamesave = str_replace(' ', '', "$Atcname");
                    $Atctype = $_POST['txttypeatc'];
                    $Atccnt = $_POST['txtcnt'];
                    $Atcunit = $_POST['txtunit'];
                    $Atcprice = $_POST['txtprice'];
                    $toSaveAtcprice = str_replace(',', '', $Atcprice, $var);
                    $Atcexpdate = $_POST['txtexpdate'];
                    $Atcyear = $_POST['txtyearatc'];
                    $Atcsource = $_POST['txtsourceatc'];
                    $Atclct = $_POST['txtlctatc'];
                    $_POST['txtbalance'] == "" ?  $Atcbalance = 'null' : $Atcbalance = "'" . $_POST['txtbalance'] . "'";
                    $Atcbalancedate = $_POST['txtbalancedate'];
                    $Atcstatus = $_POST['txtatcst'];
                    $Atcfdate = $_POST['fdate'];
                    $Atcfstf = $_POST['fstf'];
                    $Atcexpdate == "" ? $Tosaveexpdate = "" : $Tosaveexpdate = $ArticleAction->dateTosave($Atcexpdate);
                    $Atcbalancedate == "" ? $Tosavebalance = 'null' : $Tosavebalance = "'" . $ArticleAction->dateTosave($Atcbalancedate) . "'";
                    $AtcpriceAll = number_format($toSaveAtcprice * $Atccnt, 2);
                    $TosavepriceAll = str_replace(',', '', $AtcpriceAll, $var);

                    $UpdateAtc =  $ArticleAction->UpdateArticle($idatc, $Atcnamesave, $Atctype, $Atccnt, $Atcunit, $toSaveAtcprice, $Tosaveexpdate, $Atcyear, $Atcsource, $Atclct, $Atcbalance, $Tosavebalance, $Atcstatus, $Atcfdate, $Atcfstf, $TosavepriceAll, $db);
                    if ($UpdateAtc == '1') {

                        $_SESSION['chkDup'] = '1';
                    ?>
                        <div class="row">
                            <div class="col-xl-4 col-md-12"></div>
                            <div class="col-xl-4 col-md-12">

                            </div><!-- end col -->
                            <div class="col-xl-4 col-md-12" style="display: none;">
                                <button type="button" class="btn btn-primary btn-sm" id="sa-successatc">confrim</button>
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
                                <button type="button" class="btn btn-primary btn-sm" id="sa-erroratc">confrim</button>
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
                            <button type="button" class="btn btn-primary btn-sm" id="sa-erroratc">confrim</button>
                        </div>
                    </div>
                    <?php

                }

                break;

            case 'Del':

                if ($_POST['txtiddel'] != "") {

                    $iddel = $_POST['txtiddel'];
                    $statusdel = '99';
                    $delstf = $_SESSION['id'];
                    $deldate = date('Y-m-d H:i:s');

                    $delAtc = $ArticleAction->DelArticle($iddel, $statusdel, $deldate, $delstf, $db);

                    if ($delAtc == '1') {

                        $_SESSION['chkDup'] = '1';
                    ?>
                        <div class="row">
                            <div class="col-xl-4 col-md-12"></div>
                            <div class="col-xl-4 col-md-12">

                            </div><!-- end col -->
                            <div class="col-xl-4 col-md-12" style="display: none;">
                                <button type="button" class="btn btn-primary btn-sm" id="sa-successatc">confrim</button>
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
                                <button type="button" class="btn btn-primary btn-sm" id="sa-erroratc">confrim</button>
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
                            <button type="button" class="btn btn-primary btn-sm" id="sa-erroratc">confrim</button>
                        </div>
                    </div>
                    <?php


                }
                break;

            case 'Restore':

                if ($_POST['txtidrestore'] != "") {

                    $idre = $_POST['txtidrestore'];
                    $statusdel = '10';
                    $delstf = $_SESSION['id'];
                    $deldate = date('Y-m-d H:i:s');

                    $ReAtc = $ArticleAction->DelArticle($idre, $statusdel, $deldate, $delstf, $db);

                    if ($ReAtc == '1') {

                        $_SESSION['chkDup'] = '1';
                    ?>
                        <div class="row">
                            <div class="col-xl-4 col-md-12"></div>
                            <div class="col-xl-4 col-md-12">

                            </div><!-- end col -->
                            <div class="col-xl-4 col-md-12" style="display: none;">
                                <button type="button" class="btn btn-primary btn-sm" id="sa-successatc">confrim</button>
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
                                <button type="button" class="btn btn-primary btn-sm" id="sa-erroratc">confrim</button>
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
                            <button type="button" class="btn btn-primary btn-sm" id="sa-erroratc">confrim</button>
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
                <div class="col-xl-4 col-md-12" style="display: none;">
                    <button type="button" class="btn btn-primary btn-sm" id="sa-erroratc">confrim</button>
                </div>
            </div><!-- end col -->
            <div class="col-xl-4 col-md-12" style="display: none;">
                <button type="button" class="btn btn-primary btn-sm" id="sa-erroratc">confrim</button>
            </div>
        </div>
<?php

    }
}

?>
<!-- </div>
                </div>
            </div>
        </div>
    </div>
</div> -->