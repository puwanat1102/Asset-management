<?php
class UserResult
{

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

    function PosAMS($db)
    {
        $sql = "SELECT AMS_POS_ID,AMS_POS_NM FROM AMS_POS WHERE AMS_POS_ST = '10'";
        $query = $this->ConMySql()->query($sql);

        if (!$query) {
            printf("Error: %s\n", $this->ConMySql()->error);
            exit();
        }

        $resultArray = array();
        while ($result = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
            array_push($resultArray, $result);
        }
        mysqli_close($this->ConMySql());
        // echo $sql;
        return $resultArray;
    }

    function show_maxidNew($year, $db)
    {

        $sql = "SELECT max(AMS_USER_ID) as MAX_ID FROM AMS_USER  where AMS_USER_ID like '$year%' ";
        $query = $this->ConMySql()->query($sql);

        if (!$query) {
            printf("Error: %s\n", $this->ConMySql()->error);
            exit();
        }
        $resultArray = array();
        while ($result = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
            array_push($resultArray, $result);
        }
        mysqli_close($this->ConMySql());
        // echo $sql;
        return $resultArray;
    }

    function InsertUser($id, $user_fname, $user_lname, $user_pname, $user_type, $user_pos, $user_sid, $user_username, $user_password, $user_st, $user_stf, $user_fdate, $db)
    {


        $sql = "INSERT INTO AMS_USER 
        (
            AMS_USER_ID,
            AMS_USER_FNAME,
            AMS_USER_LNAME,
            AMS_USER_PNAME,
            AMS_USER_TYPE,
            AMS_USER_POS,
            AMS_USER_GRP,
            AMS_USER_USN,
            AMS_USER_PW,
            AMS_USER_ST,
            AMS_USER_FSTF,
            AMS_USER_FDATE
        )
        VALUES
        (
            '$id',
            '$user_fname',
            '$user_lname',
            '$user_pname',
            '$user_type',
            '$user_pos',
            '$user_sid',
            '$user_username',
            '$user_password',
            '$user_st',
            '$user_stf',
            '$user_fdate'
        )";

        
        $query = $this->ConMySql()->query($sql);

        if ($query) {

            $mes =  '1';
            $this->ConMySql()->commit();
        } else {

            $mes =  '0';
            $this->ConMySql()->rollback();
        }
        // echo $sql;
        mysqli_close($this->ConMySql());
        return $mes;
    }

    function ListUserAMS($db)
    {
        $sql = "SELECT AMS_USER_ID,AMS_USER_FNAME,AMS_USER_LNAME,AMS_USER_PNAME,AMS_USER_POS,AMS_USER_GRP,AMS_USER_ST,AMS_POS.AMS_POS_NM,AMS_USER_TYPE,AMS_USER_USN,AMS_USER_FDATE,
        CASE 
        WHEN AMS_USER_GRP = '201' THEN 'ผู้ใช้ทั่วไป'
        WHEN AMS_USER_GRP = '202' THEN 'เจ้าหน้าที่พัสดุ'
        WHEN AMS_USER_GRP = '203' THEN 'ผู้ดูแลครุภัณฑ์'
        WHEN AMS_USER_GRP = '204' THEN 'Admin'
        WHEN AMS_USER_GRP = '205' THEN 'ผู้บริหาร'
        ELSE '' END AS AMS_USER_GRPNM
        FROM AMS_USER 
        LEFT JOIN AMS_POS
        ON AMS_USER.AMS_USER_POS = AMS_POS.AMS_POS_ID
        WHERE AMS_USER_ST != '99'
        AND AMS_POS.AMS_POS_ST = '10'";
        $query = $this->ConMySql()->query($sql);

        if (!$query) {
            printf("Error: %s\n", $this->ConMySql()->error);
            exit();
        }
        $resultArray = array();
        while ($result = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
            array_push($resultArray, $result);
        }
        mysqli_close($this->ConMySql());
        // echo $sql;
        return $resultArray;
    }

    public function ListUserAMSAPI($token)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://14641787-34-20220704184800.webstarterz.com/or_mntservice/index.php?url=user/userlist',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $token
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return json_decode($response);
    }

    function ListUserAMSEdit($db, $id)
    {
        $sql = "SELECT AMS_USER_ID,AMS_USER_FNAME,AMS_USER_LNAME,AMS_USER_PNAME,AMS_USER_POS,AMS_USER_GRP,AMS_USER_ST,AMS_POS.AMS_POS_NM,AMS_USER_TYPE,AMS_USER_USN,AMS_USER_FDATE,AMS_USER_PW,
        CASE 
        WHEN AMS_USER_GRP = '201' THEN 'ผู้ใช้ทั่วไป'
        WHEN AMS_USER_GRP = '202' THEN 'เจ้าหน้าที่พัสดุ'
        WHEN AMS_USER_GRP = '203' THEN 'ผู้ดูแลครุภัณฑ์'
        WHEN AMS_USER_GRP = '204' THEN 'Admin'
        WHEN AMS_USER_GRP = '205' THEN 'ผู้บริหาร'
        ELSE '' END AS AMS_USER_GRPNM
        FROM AMS_USER 
        LEFT JOIN AMS_POS
        ON AMS_USER.AMS_USER_POS = AMS_POS.AMS_POS_ID
        WHERE AMS_USER_ST != '99'
        AND AMS_POS.AMS_POS_ST = '10'
        AND AMS_USER_ID = '$id'";
        $query = $this->ConMySql()->query($sql);

        if (!$query) {
            printf("Error: %s\n", $this->ConMySql()->error);
            exit();
        }
        $resultArray = array();
        while ($result = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
            array_push($resultArray, $result);
        }
        mysqli_close($this->ConMySql());
        // echo $sql;
        return $resultArray;
    }


    function UpdateUserAMS($id, $user_fname, $user_lname, $user_pname, $user_type, $user_pos, $user_sid, $user_username, $txtpassworded, $user_st, $user_stf, $user_fdate, $db)
    {


        $sql = "UPDATE AMS_USER SET
        AMS_USER_FNAME = '$user_fname',
        AMS_USER_LNAME = '$user_lname',
        AMS_USER_PNAME = '$user_pname',
        AMS_USER_TYPE = '$user_type',
        AMS_USER_POS = '$user_pos',
        AMS_USER_GRP = '$user_sid',
        AMS_USER_USN = '$user_username',
        AMS_USER_PW = '$txtpassworded',
        AMS_USER_ST = '$user_st',
        AMS_USER_ESTF = '$user_stf',
        AMS_USER_EDATE = '$user_fdate'
        WHERE AMS_USER_ID = '$id'";

        
        $query = $this->ConMySql()->query($sql);

        if ($query) {

            $mes =  '1';
            $this->ConMySql()->commit();
        } else {

            $mes =  '0';
            $this->ConMySql()->rollback();
        }
        // echo $sql;
        mysqli_close($this->ConMySql());
        return $mes;
    }

    function UpdateUserInfoAMS($id, $user_pname, $user_pos, $user_stf, $user_fdate, $db)
    {


        $sql = "UPDATE AMS_USER SET
        AMS_USER_PNAME = '$user_pname',
        AMS_USER_POS = '$user_pos',
        AMS_USER_ESTF = '$user_stf',
        AMS_USER_EDATE = '$user_fdate'
        WHERE AMS_USER_ID = '$id'";

        
        $query = $this->ConMySql()->query($sql);

        if ($query) {

            $mes =  '1';
            $this->ConMySql()->commit();
        } else {

            $mes =  '0';
            $this->ConMySql()->rollback();
        }
        // echo $sql;
        mysqli_close($this->ConMySql());
        return $mes;
    }

    function UpdatePassWord($id, $user_password, $user_stf, $user_fdate, $db)
    {


        $sql = "UPDATE AMS_USER SET
        AMS_USER_PW = '$user_password',
        AMS_USER_ESTF = '$user_stf',
        AMS_USER_EDATE = '$user_fdate'
        WHERE AMS_USER_ID = '$id'";

        
        $query = $this->ConMySql()->query($sql);

        if ($query) {

            $mes =  '1';
            $this->ConMySql()->commit();
        } else {

            $mes =  '0';
            $this->ConMySql()->rollback();
        }
        // echo $sql;
        mysqli_close($this->ConMySql());
        return $mes;
    }

    function UpdateDelstatus($id, $user_st, $user_stf, $user_fdate, $db)
    {


        $sql = "UPDATE AMS_USER SET 
        AMS_USER_ST = '$user_st',
        AMS_USER_ESTF = '$user_stf',
        AMS_USER_EDATE = '$user_fdate'
         WHERE AMS_USER_ID ='$id'";

        
        $query = $this->ConMySql()->query($sql);

        if ($query) {

            $mes =  '1';
            $this->ConMySql()->commit();
        } else {

            $mes =  '0';
            $this->ConMySql()->rollback();
        }
        // echo $sql;
        mysqli_close($this->ConMySql());
        return $mes;
    }

    function UpdateDelstatusLct($id, $user_st, $user_stf, $user_fdate)
    {


        $sql = "UPDATE AMS_LCT SET 
        AMS_LCT_ST = '$user_st',
        AMS_LCT_ESTF = '$user_stf',
        AMS_LCT_EDATE = '$user_fdate'
         WHERE AMS_LCT_ID ='$id'";

        
        $query = $this->ConMySql()->query($sql);

        if ($query) {

            $mes =  '1';
            $this->ConMySql()->commit();
        } else {

            $mes =  '0';
            $this->ConMySql()->rollback();
        }
        // echo $sql;
        mysqli_close($this->ConMySql());
        return $mes;
    }

    function ListUserAMSDel($db)
    {
        $sql = "SELECT AMS_USER_ID,AMS_USER_FNAME,AMS_USER_LNAME,AMS_USER_PNAME,AMS_USER_GRP,AMS_USER_ST,
         CASE 
        WHEN AMS_USER_GRP = '201' THEN 'ผู้ใช้ทั่วไป'
        WHEN AMS_USER_GRP = '202' THEN 'เจ้าหน้าที่พัสดุ'
        WHEN AMS_USER_GRP = '203' THEN 'ผู้ดูแลครุภัณฑ์'
        WHEN AMS_USER_GRP = '204' THEN 'Admin'
        WHEN AMS_USER_GRP = '205' THEN 'ผู้บริหาร'
        ELSE '' END AS AMS_USER_GRPNM
        FROM AMS_USER 
        WHERE AMS_USER_ST = '99'";
        $query = $this->ConMySql()->query($sql);

        if (!$query) {
            printf("Error: %s\n", $this->ConMySql()->error);
            exit();
        }
        $resultArray = array();
        while ($result = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
            array_push($resultArray, $result);
        }
        mysqli_close($this->ConMySql());
        // echo $sql;
        return $resultArray;
    }


    function InsertLct($resultLct, $statuslct, $fdate, $fstf, $db)
    {


        $sql = "INSERT INTO AMS_LCT 
        (
            AMS_LCT_NM,
            AMS_LCT_ST,
            AMS_LCT_FSTF,
            AMS_LCT_FDATE
        ) 
        VALUES 
        (
            '$resultLct',
            '$statuslct',
            '$fstf',
            '$fdate'
        )";

        
        $query = $this->ConMySql()->query($sql);

        if ($query) {

            $mes =  '1';
            $this->ConMySql()->commit();
        } else {

            $mes =  '0';
            $this->ConMySql()->rollback();
        }
        // echo $sql;
        mysqli_close($this->ConMySql());
        return $mes;
    }


    function UpdateLct($id, $resultLct, $statuslct, $fdate, $fstf, $db)
    {


        $sql = "UPDATE AMS_LCT
        SET
        AMS_LCT_NM = '$resultLct',
        AMS_LCT_ST = '$statuslct',
        AMS_LCT_ESTF = '$fstf',
        AMS_LCT_EDATE = '$fdate'
        WHERE AMS_LCT_ID ='$id'";

        
        $query = $this->ConMySql()->query($sql);

        if ($query) {

            $mes =  '1';
            $this->ConMySql()->commit();
        } else {

            $mes =  '0';
            $this->ConMySql()->rollback();
        }
        // echo $sql;
        mysqli_close($this->ConMySql());
        return $mes;
    }



    function ListLct($db)
    {

        $sql = "SELECT AMS_LCT_ID,AMS_LCT_NM,AMS_LCT_ST FROM AMS_LCT WHERE AMS_LCT_ST != '99'";
        $query = $this->ConMySql()->query($sql);

        if (!$query) {
            printf("Error: %s\n", $this->ConMySql()->error);
            exit();
        }
        $resultArray = array();
        while ($result = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
            array_push($resultArray, $result);
        }

        // echo $sql;
        mysqli_close($this->ConMySql());
        return $resultArray;
    }

    function ListLctEdit($id, $db)
    {
        $sql = "SELECT AMS_LCT_ID,AMS_LCT_NM,AMS_LCT_ST FROM AMS_LCT WHERE AMS_LCT_ST != '99' AND AMS_LCT_ID ='$id'";
        $query = $this->ConMySql()->query($sql);

        if (!$query) {
            printf("Error: %s\n", $this->ConMySql()->error);
            exit();
        }
        $resultArray = array();
        while ($result = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
            array_push($resultArray, $result);
        }
        mysqli_close($this->ConMySql());
        return $resultArray;
    }
}
// $db->close();