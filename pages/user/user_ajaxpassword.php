<?php
require_once('../../layouts/config.php');
$action='';
if($_GET['action']=='')
    $action=$_POST['action'];
else
    $action=$_GET['action'];

if($action=='checkpassword'){
    $error='';
    $txtpasswordold= md5($_GET['txtpasswordold']);
    $userid = $_GET['userid'];
    // exclude denied account
    $sql = "SELECT AMS_USER_ID,	AMS_USER_USN,AMS_USER_PW
    FROM AMS_USER
    WHERE AMS_USER_ID = '$userid' ";
    $query = $db->query($sql);
    // $checkpassresult 
    while($row = $query->fetch_assoc()) {
        $checkpassresult = $row["AMS_USER_PW"];
        
        if($checkpassresult != $txtpasswordold) {
            $error = 'false';
        } else {
            $error = 'true';
        }
        echo $error;
    }
} 
$db->close();


?>