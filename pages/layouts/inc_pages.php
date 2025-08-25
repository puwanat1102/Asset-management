<?php

if($p=="product-manage"){ 
    include 'pages/products/product_manage.php';
    
}elseif($p=="pdc-add"){
    include 'pages/products/product_add.php';
    
}elseif($p=="pdc-addset"){
    include 'pages/products/product_addset.php';
    
}elseif($p=="pdc-result"){
    include 'pages/products/product_result.php';
    
}elseif($p=="pdc-bin"){
    include 'pages/products/product_bins.php';
    
}elseif($p=="pdc-paped"){
    include 'pages/depreciation/deprec_manage.php';
    
}elseif($p=="pdc-war"){
    include 'pages/products/product_warranty.php';
    
}elseif($p=="user-manage"){
    include 'pages/user/user_manage.php';
    
}elseif($p=="user-add"){
    include 'pages/user/user_add.php';
    
}elseif($p=="user-edit"){
    include 'pages/user/user_add.php';
    
}elseif($p=="user-result"){
    include 'pages/user/user_result.php';
    
}elseif($p=="user-info"){
    include 'pages/user/user_chginfo.php';
    
}elseif($p=="user-pass"){
    include 'pages/user/user_chgpassword.php';
    
}elseif($p=="user-bins"){
    include 'pages/user/user_listbins.php';
    
}elseif($p=="budget-manage"){
    include 'pages/budget/budget_manage.php';
    
}elseif($p=="budget-add"){
    include 'pages/budget/budget_add.php';
    
}elseif($p=="budget-result"){
    include 'pages/budget/budget_result.php';
    
}elseif($p=="budget-bins"){
    include 'pages/budget/budget_bins.php';
    
}elseif($p=="deprec-setting"){
    include 'pages/depreciation/deprec_manage.php';
    
}elseif($p=="deprec-add"){
    include 'pages/depreciation/deprec_add.php';
    
}elseif($p=="deprec-result"){
    include 'pages/depreciation/deprec_result.php';
    
}elseif($p=="deprec-bins"){
    include 'pages/depreciation/deprec_bins.php';
    
}elseif($p=="user-lcts"){
    include 'pages/user/user_lct.php';
    
}elseif($p=="atc-manage"){
    include 'pages/article/article_manage.php';
    
}elseif($p=="atc-add"){
    include 'pages/article/article_add.php';
    
}elseif($p=="atc-result"){
    include 'pages/article/article_result.php';
    
}elseif($p=="atc-bin"){
    include 'pages/article/article_bins.php';
    
}elseif($p=="atc-war"){
    include 'pages/article/article_warranty.php';
    
}elseif($p=="atc-addkrp"){
    include 'pages/article/article_addkarupan.php';
    
}elseif($p=="atc-resultkrp"){
    include 'pages/article/article_resultkarupan.php';
    
}elseif($p=="rp-manage"){
    include 'pages/repair/repair_manage.php';
    
}elseif($p=="rp-his"){
    include 'pages/repair/repair_history.php';
    
}elseif($p=="rp-bins"){
    include 'pages/repair/repair_bins.php';
    
}elseif($p=="rp-add"){
    include 'pages/repair/repair_add.php';
    
}elseif($p=="rp-result"){
    include 'pages/repair/repair_result.php';
    
}elseif($p=="rp-edit"){
    include 'pages/repair/repair_edit.php';
    
}elseif($p=="rp-hisall"){
    include 'pages/repair/repair_historyall.php';

}elseif($p=="pdc-resultset"){
    include 'pages/products/product_resultset.php';

}elseif($p=="bd_statusall"){
    include 'pages/budget/budget_statusalldetail.php';

}elseif($p=="pdc-addseted"){
    include 'pages/products/product_addsetedit.php';

}elseif($p=="pdc-addsetpre"){
    include 'pages/products/product_addpreset.php';

}elseif($p=="pdc-dup"){
    include 'pages/products/product_coppyset.php';
    
}elseif($p=="report-rp"){
    include 'pages/reports/report_repair.php';
    
}elseif($p=="report-bd"){
    include 'pages/reports/report_budget.php';
    
}elseif($p=="report-pdc"){
    include 'pages/reports/report_product.php';
    
}elseif($p=="report-atc"){
    include 'pages/reports/report_article.php';
    
}elseif($p=="pdc-addkrp"){
    include 'pages/products/product_addkarupan.php';
    
}elseif($p=="pdc-resultkrp"){
    include 'pages/products/product_resultkarupan.php';
    
}elseif($p=="das-inf"){
    include 'pages/dashboards/dashboard_info.php';
    
}elseif($p=="report-ex-rp"){
    include 'pages/reports/excel/Ex_repair.php';
    
}elseif($p=="report-pdf-rp"){
    include 'pages/reports/pdf/Pdf_repair.php';
    
}else{
    include 'pages/dashboards/dashboard_info.php';
}

