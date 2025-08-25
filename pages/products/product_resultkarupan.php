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
                                    case 'Edit':

                                        $productLct = $_POST['txtlctpdc'];
                                        $productLocation = $_POST['txtlocation'];
                                        $productFdate = $_POST['fdate'];
                                        $productFstf = $_POST['fstf'];
                                        $IdProduct = isset($_POST['PdcIdEdit']) ? $_POST['PdcIdEdit'] : '';

                                        if ($IdProduct != "") {

                                            $updatekpn = $ProductAction->UpdateKRP($IdProduct, $productLct, $productLocation, $productFstf, $productFdate);
                                            $_SESSION['chkDup'] = '1';

                                            if ($updatekpn == '1') { ?>
                                                <div class="col-xl-4 col-md-12" style="display: none;">
                                                    <button type="button" class="btn btn-primary btn-sm" id="sa-successpdc">confrim</button>
                                                </div>
                                            <?php
                                            } else {
                                            ?>
                                                <div class="col-xl-4 col-md-12" style="display: none;">
                                                    <button type="button" class="btn btn-primary btn-sm" id="sa-errorpdc">confrim</button>
                                                </div>
                                            <?php
                                            }
                                        } else {
                                        }

                                        break;

                                    case 'EditListSet':
                                        $IdsetProduct = isset($_POST['IdsetProduct']) ? $_POST['IdsetProduct'] : '';
                                        $cntSet = isset($_POST['idpdcchk']) ? count($_POST['idpdcchk']) : '';
                                        $productLct = $_POST['txtlctpdcset'];
                                        $productFdate = $_POST['fdate'];
                                        $productFstf = $_POST['fstf'];

                                        if ($IdsetProduct != "") {

                                            $updatesetkpn = $ProductAction->UpdateSetKRP($IdsetProduct, $productLct, $productFstf, $productFdate);
                                            $_SESSION['chkDup'] = '1';
                                            if ($updatesetkpn == "1") {

                                                if ($cntSet > 0) {

                                                    for ($i = 0; $i < $cntSet; $i++) {

                                                        $productLocation = $_POST['txtlocation'][$i];
                                                        $IdProduct = $_POST['idpdcchk'][$i];
                                                        $updatekpn = $ProductAction->UpdateKRP($IdProduct, $productLct, $productLocation, $productFstf, $productFdate);
                                                        if ($updatekpn == '1') {
                                                            echo $IdProduct . 'update<br>';
                                                        } else {
                                                            echo $IdProduct . 'error<br>';
                                                        }
                                                    }
                                                } else {
                                                }
                                            ?>
                                                <div class="col-xl-4 col-md-12" style="display: none;">
                                                    <button type="button" class="btn btn-primary btn-sm" id="sa-successpdc">confrim</button>
                                                </div>
                                            <?php
                                            } else {
                                            ?>

                                                <div class="col-xl-4 col-md-12" style="display: none;">
                                                    <button type="button" class="btn btn-primary btn-sm" id="sa-errorpdc">confrim</button>
                                                </div>
                                <?php
                                            }
                                        } else {
                                        }

                                        break;

                                    default:
                                        # code...
                                        break;
                                }
                            } else { ?>
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