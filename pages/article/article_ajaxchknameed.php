<?php
require_once('../../layouts/config.php');
$action='';
if($_GET['action']==''){
    $action=$_POST['action'];
}else{
    $action=$_GET['action'];
}
if($action=='checkatcno'){
    $error='';
    $txtnameatc=$_GET['txtnameatc'];
    $txtnameatcchk =$_GET['txtnameatcchk'];

    if($txtnameatc == $txtnameatcchk){
        $error = 'true';
        echo $error;
    }else{

    $sql = "SELECT count(AMS_ARTICLE_ID) as cntatcid
    FROM  AMS_ARTICLE
    WHERE AMS_ARTICLE_NM = '$txtnameatc' AND AMS_ARTICLE_ST != '99'";
    $query = $db->query($sql);
   
    while($row = $query->fetch_assoc()) {
        $checkatcresult = $row["cntatcid"];
        
        if($checkatcresult > 0) {
            $error = 'false';
        } else {
            $error = 'true';
        }
        echo $error;
    }
}
}
$db->close();