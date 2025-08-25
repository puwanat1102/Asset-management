<?php
require_once('../../layouts/config.php');
require_once('../products/product_function.php');
$ProductAction = new ProductResult();

$action = '';
if ($_GET['action'] == '') {
    $action = $_POST['action'];
} else {
    $action = $_GET['action'];
}
if ($action == 'productsubset') {
    $idbd = isset($_POST['id']) ? $_POST['id'] : '';

    if ($idbd != "") {
        $subsetlist = $ProductAction->productSubsetList($idbd, $db);
?>
        <div class="card">
            <div class="card-header"><b>รายการครุภัณฑ์ย่อย</b></div>
            <div class="card-body">
                <table class="table table-striped">
                    <tr class="text-center">
                        <th>เลขทะเบียน</th>
                        <th>ชื่อ</th>
                    </tr>
                    <?php foreach ($subsetlist as $key => $value) { ?>
                        <tr class="text-center">
                            <td> <span class="badge rounded-pill bg-light">
                                    <h6><?php echo $value['AMS_PRODUCTSUBSET_NO']; ?></h6>
                                </span></td>
                            <td> <span class="badge rounded-pill bg-light">
                                    <h6><?php echo $value['AMS_PRODUCTSUBSET_NM']; ?></h6>
                                </span></td>
                        </tr>
                    <?php  } ?>
                </table>
            </div>
        </div>
<?php
    } else {
    }
}

?>