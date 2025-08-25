<?php
// Initialize the session
session_start();
date_default_timezone_set('Asia/Bangkok');
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    // header("location: ?Page");
?>

    <script type="text/javascript">
    document.location.href = 'idx_chk.php?login=login';
    </script>
    
<?php
    exit;
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$p = isset($_GET['Page']) ? $_GET['Page'] : '';
$plogin = isset($_GET['login']) ? $_GET['login'] : '';
// echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>';
?>
