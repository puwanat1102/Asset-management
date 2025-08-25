<?php
require_once('../../layouts/config.php');
$action='';
if($_GET['action']==''){
    $action=$_POST['action'];
}else{
    $action=$_GET['action'];
}

if($action=='checkdeptype'){
    $error='';
    $txtprotype=$_GET['txtprotype'];
    
    $sql = "SELECT count(AMS_DEPRECIATION_ID) as cntdepid
    FROM  AMS_DEPRECIATION
    WHERE AMS_DEPRECIATION_TYPE = '$txtprotype' AND AMS_DEPRECIATION_ST != '99'";
    $query = $db->query($sql);
    
    while($row = $query->fetch_assoc()) {
        $checkdepresult = $row["cntdepid"];
        
        if($checkdepresult > 0) {
            $error = 'false';
        } else {
            $error = 'true';
        }
        echo $error;
    }
} 

$db->close();
?>