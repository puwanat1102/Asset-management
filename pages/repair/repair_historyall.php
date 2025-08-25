<?php
include 'repair_function.php';
$RepairResult = new RepairResult();
$Idpd = isset($_GET['p']) ? base64_decode($_GET['p']) : '';
$rpfdate = isset($_POST['txtfdate']) ? $RepairResult->dateTosave($_POST['txtfdate']) : '';
$rpldate = isset($_POST['txtldate']) ? $RepairResult->dateTosave($_POST['txtldate']) : '';
$rpsdate = isset($_POST['txtsucessdate']) ? $RepairResult->dateTosave($_POST['txtsucessdate']) : '';
$rpcpn = isset($_POST['txtrpcpn']) ? $_POST['txtrpcpn'] : '';
$rpfsave = isset($_POST['txtfsave']) ? $_POST['txtfsave'] : '';
$rpst = isset($_POST['textstrp']) ? $_POST['textstrp'] : '';
$UsersaveRepair = $RepairResult->ListRepairForUser($db);
$AllHostory = $RepairResult->RepairHistoryAll($Idpd,$rpfdate,$rpldate,$rpsdate,$rpcpn,$rpfsave,$rpst, $db);
?>


<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0"><i class="mdi mdi-cog-pause"></i> จัดการข้อมูลการซ่อม </h4>

                    <div class="page-title-right">

                    </div>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1"><i class="mdi mdi-database-search"></i> ค้นหาประวัติการซ่อมทั้งหมด <?php echo $Idpd; ?></h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <form class="form-horizontal" id="f_rphisall" name="f_rphisall" action="" method="post" autocomplete="off">
                            <div class="row gy-4">
                                <div class="col-xxl-2 col-md-6">
                                    <div>
                                        <label for="txtfdate" class="form-label text-dark"><b>วันที่ส่งซ่อม</b></label>
                                        <input type="text" class="form-control" name="txtfdate" id="txtfdate">
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-2 col-md-6">
                                    <div>
                                        <label for="txtldate" class="form-label text-dark"><b>ถึงวันที่</b></label>
                                        <input type="text" class="form-control" name="txtldate" id="txtldate">
                                    </div>
                                </div>
                                <!--end col-->
                                <!--end col-->
                                <div class="col-xxl-2 col-md-6">
                                    <div>
                                        <label for="txtsucessdate" class="form-label text-dark"><b>วันที่กำหนดแล้วเสร็จ</b></label>
                                        <input type="text" class="form-control" name="txtsucessdate" id="txtsucessdate">
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="txtrpcpn" class="form-label text-dark"><b>บริษัทที่ส่งซ่อม</b></label>
                                        <input type="text" class="form-control" name="txtrpcpn">
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-4 col-md-6">
                                    <div>
                                        <label for="txtfsave" class="form-label text-dark"><b>ผู้บันทึกข้อมูลการซ่อม</b></label>
                                        <select class="form-select js-example-basic-single" id="txtfsave" name="txtfsave">
                                            <option value="">ทั้งหมด</option>
                                            <?php foreach ($UsersaveRepair as $key_us => $value_us) { ?>
                                                <option value="<?php echo $value_us['AMS_USER_ID']; ?>"><?php echo $value_us['AMS_USER_FNAME'] . ' ' . $value_us['AMS_USER_LNAME']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <!--end col-->

                                <div class="col-xxl-4 col-md-6">
                                    <div>
                                        <label for="textstrp" class="form-label text-dark"><b>สถานะการส่งซ่อม</b></label>
                                        <select class="form-select" id="textstrp" name="textstrp">
                                            <option value="">ทั้งหมด</option>
                                            <option value="0">อยู่ระหว่างการซ่อม</option>
                                            <option value="1">ซ่อมแล้ว</option>
                                        </select>
                                    </div>
                                </div>
                                <!--end col-->

                                <div class="col-xxl-2 col-md-6">
                                    <div>
                                        <br>
                                        <button type="submit" class="btn btn-info2 text-dark"><i class="mdi mdi-database-search"></i> ค้นหา</button>
                                        <button type="button" class="btn btn-warning2 text-dark" onClick="window.location.href = '?Page=rp-hisall&p=<?php echo $_GET['p']; ?>'"><i class="mdi mdi-backup-restore"></i> Reset</button>
                                    </div>
                                </div>
                                <!--end col-->
                            </div>
                        </form>

                    </div>
                </div>
            </div>

            <div class="col-12">

                <div class="card">
                    <div class="card-body">
                        <table id="repairhisall" class="table table-bordered dt-responsive  table-striped align-middle text-wrap table-hover" style="width:100%">
                            <thead>
                                <tr class="text-center">
                                    <th hidden></th>
                                    <th>วันที่ซ่อม</th>
                                    <th>อาการ</th>
                                    <th>สถานะ</th>
                                    <th>วันที่กำหนดแล้วเสร็จ</th>
                                    <th>ราคาซ่อม</th>
                                    <th>บริษัท</th>
                                    <th>ผู้บันทึกข้อมูลการซ่อม</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($AllHostory as $key_all => $value_all) { ?>
                                    <tr class="text-center" >
                                        <td hidden><?php echo $value_all['AMS_REPAIR_DATE']; ?></td>
                                        <td><?php echo $RepairResult->dateToThai($value_all['AMS_REPAIR_DATE']); ?></td>
                                        <td><?php echo $value_all['AMS_REPAIR_CAUSE']; ?></td>
                                        <td><?php echo $value_all['AMS_REPAIR_RSTNM']; ?></td>
                                        <td><?php echo $RepairResult->dateToThai($value_all['AMS_REPAIR_SDATE']); ?></td>
                                        <td><?php echo number_format($value_all['AMS_REPAIR_EXPEN'], 2); ?></td>
                                        <td><?php echo $value_all['AMS_REPAIR_CPN']; ?></td>
                                        <td><?php echo $value_all['AMS_USER_FNAME'] . ' ' . $value_all['AMS_USER_LNAME']; ?></td>
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