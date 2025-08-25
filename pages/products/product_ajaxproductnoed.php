<?php
require_once('../../layouts/config.php');
$action='';
if($_GET['action']=='')
    $action=$_POST['action'];
else
    $action=$_GET['action'];

if($action=='checkpdcno'){
    $error='';
    $txtproductno=$_GET['txtproductno'];
    $txtproductnochk =$_GET['txtproductnochk'];

    if($txtproductno == $txtproductnochk){
        $error = 'true';
        echo $error;
    }else{
    // exclude denied account
    $sql = "SELECT count(AMS_PRODUCT_ID) as cntproid
    FROM AMS_PRODUCT
    WHERE AMS_PRODUCT_NO = '$txtproductno' AND AMS_PRODUCT_DELST != '99'";
    $query = $db->query($sql);
    // $checkuserresult 
    while($row = $query->fetch_assoc()) {
        $checkproductresult = $row["cntproid"];
        
        if($checkproductresult > 0) {
            $error = 'false';
        } else {
            $error = 'true';
        }
        echo $error;
    }
}
}elseif($action=='checkpdcsetnoed'){
    $error='';
    $txtproductsetno=$_GET['txtproductsetno'];
    $txtproductsetnochk =$_GET['txtproductsetnochk'];

    if($txtproductsetno == $txtproductsetnochk){
        $error = 'true';
        echo $error;
    }else{
    // exclude denied account
    $sql = "SELECT count(AMS_PRODUCTSET_ID) as cntproid
    FROM AMS_PRODUCTSET
    WHERE AMS_PRODUCTSET_NO = '$txtproductsetno' AND AMS_PRODUCTSET_ST != '99'";
    $query = $db->query($sql);
    // $checkuserresult 
    while($row = $query->fetch_assoc()) {
        $checkproductresult = $row["cntproid"];
        
        if($checkproductresult > 0) {
            $error = 'false';
        } else {
            $error = 'true';
        }
        echo $error;
    }
}
}
$db->close();