<!--datatable css-->
  <link rel="stylesheet" href="../../assets/css/datatables/dataTables.bootstrap5.min.css" />
  <!--datatable responsive css-->
  <link rel="stylesheet" href="../../assets/css/datatables/responsive.bootstrap.min.css" />
  <link rel="stylesheet" href="../../assets/css/datatables/buttons.dataTables.min.css">
<!--datatable js-->

<script src="../../assets/js/main/jquery-3.6.0.min.js"></script>
<script src="../../assets/js/datatables/jquery.dataTables.min.js"></script>
<script src="../../assets/js/datatables/dataTables.bootstrap5.min.js"></script>
<script src="../../assets/js/datatables/dataTables.responsive.min.js"></script>
<script src="../../assets/js/datatables/dataTables.buttons.min.js"></script>
<script src="../../assets/js/datatables/buttons.print.min.js"></script>
<script src="../../assets/js/datatables/buttons.html5.min.js"></script>
<script src="../../assets/js/datatables/jszip.min.js"></script>
<script>
$(document).ready(function () {
    $('#repairmanagehis').DataTable();
});
</script>


<?php
require_once('../../layouts/config.php');
function dateToThai($date)
{
    if ($date == "") {
        $ToThai = $date;
    } else {
        $epdate = explode('-', $date);
        $yearThai = $epdate['0'] + 543;
        $ToThai = $epdate['2'] . '/' . $epdate['1'] . '/' . $yearThai;
    }
    if (isset($ToThai)) {
        return $ToThai;
    } else {
        return false;
    }
}

$action = '';
if ($_GET['action'] == '') {
    $action = $_POST['action'];
} else {
    $action = $_GET['action'];
}
if ($action == 'hisrepair') {

    $idpro = isset($_POST['id']) ? $_POST['id'] : '';

    $sql = "SELECT AMS_REPAIR_ID,
     AMS_REPAIR_CAUSE,
        AMS_REPAIR_DATE,
        AMS_REPAIR_SDATE,
        AMS_REPAIR_EXPEN,
        AMS_REPAIR_CPN,
        AMS_REPAIR_RST,CASE 
        WHEN AMS_REPAIR_RST = '0' THEN 'อยู่ระหว่างการซ่อม'
        WHEN AMS_REPAIR_RST = '1' THEN 'ซ่อมแล้ว'
        ELSE '' END AS AMS_REPAIR_RSTNM,
        AMS_REPAIR_ST,
        AMS_REPAIR_STF, AMS_USER_PNAME,
        AMS_USER_FNAME,
        AMS_USER_LNAME
    FROM AMS_REPAIR
    LEFT JOIN AMS_USER
         ON AMS_REPAIR_STF = AMS_USER_ID
    WHERE AMS_REPAIR_ST != '99' 
    AND AMS_REPAIR_PID = '$idpro'
    
    ORDER BY AMS_REPAIR_DATE ASC";

    $query = $db->query($sql);

    // AND AMS_REPAIR_DATE BETWEEN curdate() - INTERVAL 3 MONTH AND curdate()
?>

<div class="text-center">
    <form method="post" action="?Page=rp-hisall&p=<?php echo base64_encode($idpro); ?>" target="_blank">
        <button type="submit" class="btn btn-sm btn-warning text-dark"> ประวัติทั้งหมด</button>
    </form>
</div>
    <table id="repairmanagehis" class="table table-bordered dt-responsive  table-striped align-middle text-wrap table-hover" style="width:100%">
        <thead>
            <tr class="text-center">
                <th>วันที่ซ่อม</th>
                <th>อาการ</th>
                <th>สถานะ</th>
                <th>วันที่กำหนดแล้วเสร็จ</th>
                <th>ราคาซ่อม</th>
                <th>บริษัท</th>
                <th>คนบันทึก</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $query->fetch_assoc()) { ?>
                <tr class="text-center">
                    <td><?php echo dateToThai($row['AMS_REPAIR_DATE']); ?></td>
                    <td><?php echo $row['AMS_REPAIR_CAUSE']; ?></td>
                    <td><?php echo $row['AMS_REPAIR_RSTNM']; ?></td>
                    <td><?php echo dateToThai($row['AMS_REPAIR_SDATE']); ?></td>
                    <td><?php echo number_format($row['AMS_REPAIR_EXPEN'], 2); ?></td>
                    <td><?php echo $row['AMS_REPAIR_CPN']; ?></td>
                    <td><?php echo $row['AMS_USER_FNAME'] . ' ' . $row['AMS_USER_LNAME']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
<?php
}
$db->close();

?>
  