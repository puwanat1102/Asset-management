<?php

Class LoginAMS {

    private function conDB()
    {

        $db2 = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        mysqli_query($db2, "SET CHARACTER SET UTF8");
        $db2->set_charset("utf8");
        if ($db2->connect_errno) {
            return "Failed to connect to MySQL: " . $db2->connect_error;
            exit();
        } else {
            return $db2;
        }
    }

    public function ConMySql()
    {
        return $this->conDB();
    }


    function chklogintAMS($user,$pass,$db){

        $sql = "SELECT AMS_USER_ID,AMS_USER_FNAME,AMS_USER_LNAME,AMS_USER_PNAME,AMS_USER_POS,AMS_USER_GRP,AMS_USER_ST,AMS_POS.AMS_POS_NM,AMS_USER_USN,AMS_USER_PW,AMS_USER_TYPE,
        CASE 
        WHEN AMS_USER_GRP = '201' THEN 'ผู้ใช้ทั่วไป'
        WHEN AMS_USER_GRP = '202' THEN 'พัสดุ'
        WHEN AMS_USER_GRP = '203' THEN 'ผู้ดูแลครุภัณฑ์'
        WHEN AMS_USER_GRP = '204' THEN 'Admin'
        ELSE '' END AS AMS_USER_GRPNM
        FROM AMS_USER 
        LEFT JOIN AMS_POS
        ON AMS_USER.AMS_USER_POS = AMS_POS.AMS_POS_ID
        WHERE AMS_USER_ST = '10'
        AND AMS_POS.AMS_POS_ST = '10'
        AND AMS_USER_USN = '$user'
        AND AMS_USER_PW = '$pass'";

        $query = $this->ConMySql()->query($sql);
    
        if (!$query) {
            printf("Error: %s\n", $this->ConMySql()->error);
            exit();
        }
        $resultArray = array();
        while($result = mysqli_fetch_array($query,MYSQLI_ASSOC))
        {
            array_push($resultArray,$result);
        }
        mysqli_close($this->ConMySql());
        // echo $sql;
        return $resultArray;

    }

    public function Captcha_cal($captcha)
    {

        $secret   = '6LfDA_UgAAAAABoPK98kuFmJ7_oLSCoDUwC7X92P';
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://www.google.com/recaptcha/api/siteverify',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('secret' => $secret, 'response' => $captcha, 'remoteip' => $_SERVER['REMOTE_ADDR']),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return json_decode($response);
    }

    public function LoginAMSWebservice($user,$pass){

            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://14641787-34-20220704184800.webstarterz.com/or_mntservice/index.php?url=token/get_access_token',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{
                "user":"'.$user.'",
                "pwd" : "'.$pass.'"
            }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            return json_decode($response);
    }

    public function StaffAms($staff, $name)
    {

        $StaffENT = explode('.', $staff);
        $Result_Staff = base64_decode($StaffENT['1']);
        $json_Staff = json_decode($Result_Staff);
        return $json_Staff->$name;
    }

}
// $db->close();
?>