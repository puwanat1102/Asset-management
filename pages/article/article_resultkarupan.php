<?php
include 'article_function.php';
$ArticleAction = new ArticleResult();
$action = isset($_POST['Actionarticle']) ? $_POST['Actionarticle'] : '';
$chkDup = isset($_SESSION['chkDup']) ? $_SESSION['chkDup'] : '0';


if (isset($p)) {

    if ($chkDup == '0') {
        switch ($action) {
            case 'Edit':
                $idatc = isset($_POST['articleID']) ? $_POST['articleID'] : "";

                if ($idatc != "") {

                    $Atcfdate = $_POST['fdate'];
                    $Atcfstf = $_POST['fstf'];
                    $Atcbalancedate = $_POST['txtbalancedate'];
                    $Atcbalancedate == "" ? $Tosavebalance = 'null' : $Tosavebalance = "'" . $ArticleAction->dateTosave($Atcbalancedate) . "'";
                    $_POST['txtbalance'] == "" ?  $Atcbalance = 'null' : $Atcbalance = "'" . $_POST['txtbalance'] . "'";

                    $updatekrp =  $ArticleAction->UpdateKRP($idatc, $Atcbalance, $Tosavebalance, $Atcfstf, $Atcfdate);

                    if ($updatekrp == '1') {
?>
                        <div class="col-xl-4 col-md-12" style="display: none;">
                            <button type="button" class="btn btn-primary btn-sm" id="sa-successatc">confrim</button>
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="col-xl-4 col-md-12" style="display: none;">
                            <button type="button" class="btn btn-primary btn-sm" id="sa-erroratc">confrim</button>
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
    } else {
        ?>

        <div class="col-xl-4 col-md-12" style="display: none;">
            <button type="button" class="btn btn-primary btn-sm" id="sa-erroratc">confrim</button>
        </div>
<?php
    }
} else {
}
