<?php 
if($p=="user-manage" || $p=="user-add" || $p=="user-edit" || $p=="user-result" || $p=="user-info" || $p=="user-pass" || $p=="user-bins" || $p=="user-lcts"){ 
    
    echo '<script src="assets/js/UserApp.js"></script>';
    
}elseif($p=="budget-manage" || $p=="budget-add" || $p=="budget-result" || $p=="budget-bins" || $p=="bd_statusall"){

    echo '<script src="assets/js/BudgetApp.js"></script>';
   
    
}elseif($p=="deprec-add" || $p=="deprec-result" || $p=="deprec-bins" || $p=="deprec-setting" || $p=="pdc-paped"){
  
    echo '<script src="assets/js/DerpApp.js"></script>';
    
}elseif($p=="atc-manage" || $p=="atc-add" || $p=="atc-bin" || $p=="atc-result" || $p=="atc-war" || $p=="atc-addkrp" || $p=="atc-resultkrp"){

    echo '<script src="assets/js/AtcApp.js"></script>';
    if($p=="atc-war"){
    include 'pages/article/article_dateexp.php';
    }else{

    }

}elseif($p=="product-manage" || $p=="pdc-add" || $p=="pdc-addset" || $p=="pdc-result" || $p =="pdc-bin" || $p =="pdc-war" || $p=="pdc-resultset" || $p=="pdc-addseted" || $p=="pdc-addsetpre" || $p=="pdc-dup" || $p=="pdc-paped" || $p=="pdc-addkrp" || $p=="pdc-resultkrp"){

    echo '<script src="assets/js/PdcApp.js"></script>';
    if($p=="pdc-war"){
        include 'pages/article/article_dateexp.php';
        }elseif($p=="pdc-addset" || $p=="pdc-add"){
            include 'pages/products/product_multisetadd.php';
        }elseif($p=="pdc-addseted"){
            include 'pages/products/product_multisetaddedit.php';
        }else{
    
        }

}elseif($p =="rp-manage" || $p =="rp-bins" || $p =="rp-add" || $p =="rp-result" || $p =="rp-his" || $p =="rp-edit" || $p =="rp-hisall"){
  
    echo '<script src="assets/js/RepairApp.js"></script>';
    
}elseif($p =="report-rp" || $p == "report-bd" || $p=="report-pdc" || $p == "report-atc"){
    echo '<script src="assets/js/ReportApp.js"></script>';
}elseif($p =="das-inf" || $p=""){
    echo '<script src="assets/js/DasApp.js"></script>';
    include 'pages/dashboards/dashbord_data.php';
}else{
    echo '<script src="assets/js/DasApp.js"></script>';
    include 'pages/dashboards/dashbord_data.php';
}

?>