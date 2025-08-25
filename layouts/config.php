<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
// define('DB_SERVER', 'ftp.14641787-34-20220704184800.webstarterz.com');
// define('DB_USERNAME', 'cp227694_cp22769');
// define('DB_PASSWORD', 'golf@1102');
// define('DB_NAME', 'cp227694_AMS_SYSTEM');

// /* Attempt to connect to MySQL database */
// $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// // Check connection
// if($link === false){
//     die("ERROR: Could not connect. " . mysqli_connect_error());
// }

// $gmailid = ''; // YOUR gmail email
// $gmailpassword = ''; // YOUR gmail password
// $gmailusername = ''; // YOUR gmail User name

$db_server = "ftp.14641787-34-20220704184800.webstarterz.com"; // hostname 
$db_user = "cp227694"; // username
$db_pass = "golf@1102"; // password
$db_src = "cp227694_AMS_SYSTEM"; // ชื่อฐานข้อมูล

$db = new mysqli($db_server , $db_user , $db_pass, $db_src);
mysqli_query($db,"SET CHARACTER SET UTF8");
$db -> set_charset("utf8");
if( $db->connect_errno ){
	  echo "Failed to connect to MySQL: " . $db->connect_error;
}else{
     // echo "Success";
}
// $db = null;

define('DB_SERVER', 'ftp.14641787-34-20220704184800.webstarterz.com');
define('DB_USERNAME', 'cp227694');
define('DB_PASSWORD', 'golf@1102');
define('DB_NAME', 'cp227694_AMS_SYSTEM');




?>