<?php
// Initialize the session
session_start();
//Check if the user is already logged in, if yes then redirect him to index page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: https://mct-system.com");
    exit;
}
// Include config file
require_once "layouts/config.php";
require_once "login_function.php";
$chklogin = new LoginAMS();

// RecapchaV3
if (isset($_POST['g-recaptcha-response'])) {
    $captcha = $_POST['g-recaptcha-response'];
} else {
    $captcha = false;
}

if (!$captcha) {
} else {

    $rescall = $chklogin->Captcha_cal($captcha);
}

// RecapchaV3


// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if username is empty
    if (empty(trim($_POST["username"]))) {
        $username_err = "กรุณาใส่ username";
    } else {
        $username = trim($_POST["username"]);
    }

    // Check if password is empty
    if (empty(trim($_POST["password"]))) {
        $password_err = "กรุณาใส่ password";
    } else {
        $password = trim(md5($_POST["password"]));
    }

    // Validate credentials
    if (empty($username_err) && empty($password_err)) {

        //recapcha chk
        if ($rescall->success == true && $rescall->score >= 0.5) {

            $WebserviceLogin = $chklogin->LoginAMSWebservice($username, $password);
            // $loginTrue =  $chklogin->chklogintAMS($username, $password, $db);
            if ($WebserviceLogin->json_result == true) {

                if ($WebserviceLogin->access_token != "") {

                    $id = $chklogin->StaffAms($WebserviceLogin->access_token, 'user_stf');
                    $dspname = $chklogin->StaffAms($WebserviceLogin->access_token, 'staff_name');
                    $position = $chklogin->StaffAms($WebserviceLogin->access_token, 'postition');
                    $grp = $chklogin->StaffAms($WebserviceLogin->access_token, 'grp');
                    $grpnm = $chklogin->StaffAms($WebserviceLogin->access_token, 'grpnm');
                    $type = $chklogin->StaffAms($WebserviceLogin->access_token, 'type');

                    // $id = $loginTrue['0']['AMS_USER_ID'];
                    // $dspname = $loginTrue['0']['AMS_USER_PNAME'] . $loginTrue['0']['AMS_USER_FNAME'] . ' ' . $loginTrue['0']['AMS_USER_LNAME'];
                    // $position = $loginTrue['0']['AMS_POS_NM'];
                    // $grp = $loginTrue['0']['AMS_USER_GRP'];
                    // $grpnm = $loginTrue['0']['AMS_USER_GRPNM'];
                    // $type = $loginTrue['0']['AMS_USER_TYPE'] == '101' ? 'สายสนับสนุน' : 'สายวิชาการ';

                    $_SESSION["loggedin"] = true;
                    $_SESSION["id"] = $id;
                    $_SESSION["fullname"] = $dspname;
                    $_SESSION["postition"] = $position;
                    $_SESSION["grp"] = $grp;
                    $_SESSION["grpnm"] = $grpnm;
                    $_SESSION["type"] = $type;
                    $_SESSION["token_ams"] = $WebserviceLogin->access_token;
                   

                    // header("location: https://mct-system.com");
?>
                    <script langquage='javascript'>
                        window.location = "https://mct-system.com";
                        //window.location = "?p=login";
                    </script>
<?php
                } else {

                    $username_err = 'ข้อมูล username หรือ password ไม่ถูกต้อง';
                }
            } else {

                $username_err = 'ข้อมูล username หรือ password ไม่ถูกต้อง';
            }
        } else {
            //recapcha fail
        }
    }
}

?>
<?php include 'layouts/head-main.php'; ?>

<head>

    <title>Log In | MCT-AMS System</title>
    <?php include 'layouts/title-meta.php'; ?>

    <?php include 'layouts/head-css.php'; ?>

</head>

<?php include 'layouts/body.php'; ?>

<div class="auth-page-wrapper pt-5">
    <!-- auth page bg -->
    <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
        <div class="bg-overlay"></div>

        <div class="shape">
            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1440 120">
                <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
            </svg>
        </div>
    </div>

    <!-- auth page content -->
    <div class="auth-page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center mt-sm-5 mb-4 text-white-50">
                        <div>
                            <a href="#" class="d-inline-block auth-logo">
                               
                            </a>
                        </div>
                        
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card mt-4">

                        <div class="card-body p-4">
                            <div class="text-center mt-2">
                                <img src="assets/images/logo-MCT-FINAL-ok-02.png" alt="" height="100">
                                <h5 class="mt-2"><b>MCT-AMS System</b></h5>
                                <b class="mt-2">ระบบบริหารจัดการข้อมูลวัสดุและครุภัณฑ์</b>
                            </div>
                            <div class="p-2 mt-4">
                                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?login=login" method="post" id="tokenVali">

                                    <div class="mb-3 <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                                        <label for="username" class="form-label"><i class="mdi mdi-account"></i> Username</label>
                                        <input type="text" class="form-control" value="" name="username" id="username" placeholder="กรุณากรอก username">

                                        <span class="text-danger"><?php echo $username_err; ?></span>
                                    </div>

                                    <div class="mb-3 <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                                        <div class="float-end">
                                            
                                        </div>
                                        <label class="form-label" for="password-input"><i class="mdi mdi-lock"></i> Password</label>
                                        <div class="position-relative auth-pass-inputgroup mb-3">
                                            <input type="password" class="form-control pe-5" value="" name="password" placeholder="กรุณากรอก password" id="password-input">
                                            <span class="text-danger"><?php echo $password_err; ?></span>
                                            <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                        </div>
                                    </div>

                                    <div class="form-check">
                                        
                                    </div>

                                    <div class="mt-4">
                                        <button class="btn btn-info2 w-100" type="button" id="btnSubmit"><i class="mdi mdi-import"></i> เข้าสู่ระบบ</button>
                                    </div>

                                    <div class="mt-4 text-center">

                                    </div>
                                    <!-- ReCaptcha -->
                                    <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">
                                    <input type="hidden" name="action" value="validate_captcha">
                                    <!-- ReCaptcha -->
                                </form>
                            </div>
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->

                    <div class="mt-4 text-center">
                        <b class="mb-0"> กรณีไม่มี Username หรือ ลืมรหัสผ่าน ติดต่อได้ที่ ฝ่ายเทคโนโลยีสารสนเทศ </b>
                    </div>

                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end auth page content -->

    <!-- footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <p class="mb-0 text-muted">designed and developed by Mr. Puwanat Pattanapipat &copy; <script>
                                document.write(new Date().getFullYear())
                            </script>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- end Footer -->
</div>
<!-- end auth-page-wrapper -->

<?php include 'layouts/vendor-scripts.php'; ?>

<!-- particles js -->
<script src="assets/libs/particles.js/particles.js"></script>
<!-- particles app js -->
<script src="assets/js/pages/particles.app.js"></script>
<!-- password-addon init -->
<script src="assets/js/pages/password-addon.init.js"></script>
</body>

</html>