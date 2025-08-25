<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index.php" class="logo logo-dark">
            <span class="logo-sm">
                <img src="assets/images/logo-MCT-FINAL-ok-02.png" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="assets/images/logo-dark.png" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="index.php" class="logo logo-light">
            <span class="logo-sm">
                <img src="assets/images/logo-MCT-FINAL-ok-02.png" alt="" height="50">
            </span>
            <span class="logo-lg">
                <img src="assets/images/logo-MCT-FINAL-ok-02.png" alt="" height="100">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid" style="font-size:20px;">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span><?=$lang['t-menu']?></span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link  <?php if ($p == "das-inf" || $p =="") {echo 'active';} else {}?>" href="?Page=das-inf" >
                        <i class="mdi mdi-speedometer"></i> <span><?=$lang['t-dashboards']?></span>
                    </a>
                    <!-- <div class="collapse menu-dropdown" id="sidebarDashboards">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="" class="nav-link"><?=$lang['d-repair']?></a>
                            </li>
                            <li class="nav-item">
                                <a href="" class="nav-link"><?=$lang['d-budget']?></a>
                            </li>
                            <li class="nav-item">
                                <a href="" class="nav-link"><?=$lang['d-article']?></a>
                            </li>
                            <li class="nav-item">
                                <a href="" class="nav-link"><?=$lang['d-dateprod']?></a>
                            </li>
                            <li class="nav-item">
                                <a href="" class="nav-link"><?=$lang['d-dateatc']?></a>
                            </li>
                            <li class="nav-item">
                                <a href="" class="nav-link" data-key="t-nft"> <?=$lang['d-datacollection']?> <span class="badge badge-pill bg-danger" data-key="t-new">New</span></a>
                            </li>
                        </ul>
                    </div> -->
                </li> <!-- end Dashboard Menu -->

                <?php if ($_SESSION["grp"] == '204' || $_SESSION["grp"] == '202' || $_SESSION["grp"] == '205' || $_SESSION["grp"] == '203' || $_SESSION["grp"] == '201') {?>
                <li class="nav-item">
                    <a class="nav-link menu-link <?php if ($p == "product-manage" || $p == "pdc-add" || $p == "pdc-addset" || $p == "pdc-result" || $p == "pdc-bin" || $p == "pdc-war" || $p == "pdc-resultset" || $p == "pdc-addseted" || $p == "pdc-addsetpre" || $p=="pdc-addkrp" || $p=="pdc-resultkrp") {echo 'active';} else {}?>" href="#sidebarProducts" data-bs-toggle="collapse" role="button" aria-expanded="true" aria-controls="sidebarProducts">
                        <i class="mdi mdi-desktop-classic"></i> <span><?=$lang['product-menu']?></span>
                    </a>
                    <div class="collapse menu-dropdown <?php if ($p == "product-manage" || $p == "pdc-add" || $p == "pdc-addset" || $p == "pdc-result" || $p == "pdc-bin" || $p == "pdc-war" || $p == "pdc-resultset" || $p == "pdc-addseted" || $p == "pdc-addsetpre" || $p == "deprec-add" || $p == "deprec-bins" || $p == "deprec-result" || $p=="pdc-addkrp" || $p=="pdc-resultkrp") {echo 'show';} else {}?>" id="sidebarProducts">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="?Page=product-manage" class="nav-link <?php if ($p == "product-manage") {echo 'active';} else {}?>" ><?=$lang['product-manage']?></a>
                            </li>
                            <li class="nav-item">
                                <a href="?Page=pdc-war" class="nav-link <?php if ($p == "pdc-war") {echo 'active';} else {}?>" ><?=$lang['product-date']?></a>
                            </li>
                            <?php if ($_SESSION["grp"] == '204' || $_SESSION["grp"] == '202') {?>
                            <li class="nav-item">
                                <a href="?Page=pdc-bin" class="nav-link <?php if ($p == "pdc-bin") {echo 'active';} else {}?>" ><?=$lang['product-bins']?></a>
                            </li>
                            <?php } else {}?>

                        </ul>
                    </div>
                </li> <!-- end ครุภัณฑ์ Menu -->
                <?php } else {}?>

                <?php if ($_SESSION["grp"] == '204' || $_SESSION["grp"] == '202' || $_SESSION["grp"] == '205' || $_SESSION["grp"] == '201' || $_SESSION["grp"] == '203') {?>
                <li class="nav-item">
                    <a class="nav-link menu-link  <?php if ($p == "atc-manage" || $p == "atc-bins" || $p == "atc-add" || $p == "atc-result" || $p == "atc-bin" || $p == "atc-war" || $p=="atc-addkrp" || $p=="atc-resultkrp") {echo 'active';} else {}?>" href="#sidebarArticles" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarArticles">
                        <i class="mdi mdi-view-carousel-outline"></i> <span><?=$lang['article-menu']?></span>
                    </a>
                    <div class="collapse menu-dropdown <?php if ($p == "atc-manage" || $p == "atc-bins" || $p == "atc-add" || $p == "atc-result" || $p == "atc-bin" || $p == "atc-war" || $p=="atc-addkrp" || $p=="atc-resultkrp") {echo 'show';} else {}?>" id="sidebarArticles">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="?Page=atc-manage" class="nav-link <?php if ($p == "atc-manage") {echo 'active';} else {}?>" ><?=$lang['article-manage']?></a>
                            </li>
                            <li class="nav-item">
                                <a href="?Page=atc-war" class="nav-link <?php if ($p == "atc-war") {echo 'active';} else {}?>" ><?=$lang['article-date']?></a>
                            </li>
                            <?php if ($_SESSION["grp"] == '204' || $_SESSION["grp"] == '202') {?>
                            <li class="nav-item">
                                <a href="?Page=atc-bin" class="nav-link <?php if ($p == "atc-bin") {echo 'active';} else {}?>" ><?=$lang['article-bins']?></a>
                            </li>
                            <?php }?>
                        </ul>
                    </div>
                </li> <!-- end วัสดุ Menu -->
                <?php } else {}?>
                <?php if ($_SESSION["grp"] == '204' || $_SESSION["grp"] == '202' || $_SESSION["grp"] == '203' || $_SESSION["grp"] == '201' || $_SESSION["grp"] == '205') {?>
                <li class="nav-item">
                    <a class="nav-link menu-link <?php if ($p == "rp-manage" || $p == "rp-bins" || $p == "rp-add" || $p == "rp-result" || $p == "rp-his" || $p == "rp-edit" || $p == "rp-hisall") {echo 'active';} else {}?>" href="#sidebarRepair" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarRepair">
                        <i class="mdi mdi-cog-pause"></i> <span><?=$lang['repair-menu']?></span>
                    </a>
                    <div class="collapse menu-dropdown <?php if ($p == "rp-manage" || $p == "rp-bins" || $p == "rp-add" || $p == "rp-result" || $p == "rp-his" || $p == "rp-edit" || $p == "rp-hisall") {echo 'show';} else {}?>" id="sidebarRepair">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="?Page=rp-manage" class="nav-link <?php if ($p == "rp-manage") {echo 'active';} else {}?>" ><?=$lang['repair-list']?></a>
                            </li>
                            <li class="nav-item">
                                <a href="?Page=rp-his" class="nav-link <?php if ($p == "rp-his") {echo 'active';} else {}?>" ><?=$lang['repair-history']?></a>
                            </li>
                            <?php if ($_SESSION["grp"] == '204' || $_SESSION["grp"] == '202') {?>
                            <li class="nav-item">
                                <a href="?Page=rp-bins" class="nav-link <?php if ($p == "rp-bins") {echo 'active';} else {}?>" ><?=$lang['repair-bins']?></a>
                            </li>
                            <?php }?>
                        </ul>
                    </div>
                </li> <!-- end การซ่อมบำรุง Menu -->
                <?php } else {}?>

                <?php if ($_SESSION["grp"] == '204' || $_SESSION["grp"] == '202' || $_SESSION["grp"] == '205') {?>
                <li class="nav-item">
                    <a class="nav-link menu-link <?php if ($p == "budget-manage" || $p == "budget-bins" || $p == "budget-add" || $p == "budget-result" || $p == "bd_statusall") {echo 'active';} else {}?>" href="#sidebarBudget" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarBudget">
                        <i class="mdi mdi-cash-multiple"></i> <span><?=$lang['budget-menu']?></span>
                    </a>
                    <div class="collapse menu-dropdown <?php if ($p == "budget-manage" || $p == "budget-bins" || $p == "budget-add" || $p == "budget-result" || $p == "bd_statusall") {echo 'show';} else {}?>" id="sidebarBudget">
                        <ul class="nav nav-sm flex-column">
                            <!-- <li class="nav-item">
                                <a href="" class="nav-link" ><?=$lang['budget-status']?></a>
                            </li> -->
                            <li class="nav-item">
                                <a href="?Page=budget-manage" class="nav-link <?php if ($p == "budget-manage") {echo 'active';} else {}?>" ><?=$lang['budget-manage']?></a>
                            </li>
                            <?php if ($_SESSION["grp"] == '204' || $_SESSION["grp"] == '202') {?>
                            <li class="nav-item">
                                <a href="?Page=budget-bins" class="nav-link <?php if ($p == "budget-bins") {echo 'active';} else {}?>" ><?=$lang['budget-bins']?></a>
                            </li>
                            <?php }?>
                        </ul>
                    </div>
                </li> <!-- end งบประมาณ Menu -->
                <?php } else {}?>
                <?php if ($_SESSION["grp"] == '204') {?>
                <!-- <li class="nav-item">
                    <a class="nav-link menu-link <?php if ($p == "deprec-setting" || $p == "deprec-add" || $p == "deprec-bins" || $p == "deprec-result") {echo 'active';} else {}?>" href="#sidebarDeprec" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarDeprec">
                        <i class="mdi mdi-calculator-variant-outline"></i> <span><?=$lang['deprec-menu']?></span>
                    </a>
                    <div class="collapse menu-dropdown <?php if ($p == "deprec-setting" || $p == "deprec-add" || $p == "deprec-bins" || $p == "deprec-result") {echo 'show';} else {}?>" id="sidebarDeprec">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="" class="nav-link" ><?=$lang['deprec-status']?></a>
                            </li>
                            <li class="nav-item">
                                <a href="?Page=deprec-setting" class="nav-link <?php if ($p == "deprec-setting") {echo 'active';} else {}?>" ><?=$lang['deprec-setting']?></a>
                            </li>
                            <?php if ($_SESSION["grp"] == '204') {?>
                            <li class="nav-item">
                                <a href="?Page=deprec-bins" class="nav-link <?php if ($p == "deprec-bins") {echo 'active';} else {}?>" ><?=$lang['deprec-bins']?></a>
                            </li>
                            <?php }?>

                        </ul>
                    </div>
                </li> -->
                 <!-- end ค่าเสื่อมราคา Menu -->
                <?php } else {}?>

                <?php if ($_SESSION["grp"] == '204') {?>
                <li class="nav-item">
                    <a class="nav-link menu-link <?php if ($p == "user-manage" || $p == "user-add" || $p == "user-bins" || $p == "user-lcts" || $p == "user-result" || $p == "deprec-setting" || $p == "deprec-add" || $p == "deprec-bins" || $p == "deprec-result") {echo 'active';} else {}?>" href="#sidebarUser" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarUser">
                        <i class="mdi mdi-account-details-outline"></i> <span><?=$lang['user-menu']?></span>
                    </a>
                    <div class="collapse menu-dropdown <?php if ($p == "user-manage" || $p == "user-add" || $p == "user-bins" || $p == "user-lcts" || $p == "user-result" || $p == "deprec-setting" || $p == "deprec-add" || $p == "deprec-bins" || $p == "deprec-result" ) {echo 'show';} else {}?>" id="sidebarUser">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="?Page=user-manage" class="nav-link <?php if ($p == "user-manage" || $p == "user-add") {echo 'active';} else {}?>" ><?=$lang['user-manage']?></a>
                            </li>
                            <!-- <li class="nav-item">
                                <a href="" class="nav-link" ><?=$lang['user-pttype']?></a>
                            </li> -->
                            <li class="nav-item">
                                <a href="?Page=user-bins" class="nav-link <?php if ($p == "user-bins") {echo 'active';} else {}?>" ><?=$lang['user-bins']?></a>
                            </li>
                            <li class="nav-item">
                                <a href="?Page=deprec-setting" class="nav-link <?php if ($p == "deprec-setting") {echo 'active';} else {}?>" ><?=$lang['product-paped']?></a>
                            </li>
                            <li class="nav-item">
                                <a href="?Page=user-lcts" class="nav-link <?php if ($p == "user-lcts") {echo 'active';} else {}?>" ><?=$lang['user-lcts']?></a>
                            </li>

                        </ul>
                    </div>
                </li> <!-- end ผู้ใช้งาน Menu -->

               <?php } else {}?>

                <li class="nav-item">
                    <a class="nav-link menu-link <?php if ($p == "report-rp" || $p == "report-bd" || $p == "report-pdc" || $p == "report-atc"){ echo 'active'; }else{} ?> " href="#sidebarReports" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarReports">
                        <i class="mdi mdi-file-chart-outline"></i> <span><?=$lang['report-menu']?></span>
                    </a>
                    <div class="collapse menu-dropdown <?php if ($p == "report-rp" || $p == "report-bd" || $p == "report-pdc" || $p == "report-atc"){ echo 'show'; }else{} ?>" id="sidebarReports">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="?Page=report-rp" class="nav-link <?php if ($p == "report-rp"){ echo 'active'; }else{} ?>" ><?=$lang['report-repair']?></a>
                            </li>
                            <li class="nav-item">
                                <a href="?Page=report-bd" class="nav-link  <?php if ($p == "report-bd"){ echo 'active'; }else{} ?>" ><?=$lang['report-budget']?></a>
                            </li>
                            <li class="nav-item">
                                <a href="?Page=report-pdc" class="nav-link <?php if ($p == "report-pdc"){ echo 'active'; }else{} ?>" ><?=$lang['report-product']?></a>
                            </li>
                            <li class="nav-item">
                                <a href="?Page=report-atc" class="nav-link <?php if ($p == "report-atc"){ echo 'active'; }else{} ?>" ><?=$lang['report-article']?></a>
                            </li>
                            <!-- <li class="nav-item">
                                <a href="" class="nav-link" ><?=$lang['report-productdischart']?></a>
                            </li> -->

                        </ul>
                    </div>
                </li> <!-- end รายงาน Menu -->

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>