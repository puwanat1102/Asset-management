<?php
require_once('../../layouts/config.php');
$action='';
if($_GET['action']=='')
    $action=$_POST['action'];
else
    $action=$_GET['action'];

if($action=='checkusername'){
    $error='';
    $txtusernm=$_GET['txtusernm'];
    $txtusernmchk =$_GET['txtusernmchk'];

    if($txtusernm == $txtusernmchk){
        $error = 'true';
        echo $error;
    }else{
    // exclude denied account
    $sql = "SELECT count(AMS_USER_ID) as cntcbid
    FROM AMS_USER
    WHERE AMS_USER_USN = '$txtusernm' AND AMS_USER_ST != '99'";
    $query = $db->query($sql);
    // $checkuserresult 
    while($row = $query->fetch_assoc()) {
        $checkuserresult = $row["cntcbid"];
        
        if($checkuserresult > 0) {
            $error = 'false';
        } else {
            $error = 'true';
        }
        echo $error;
    }
}
}
$db->close();
