<?php
class RepairResult
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

    public function ListRepairForUser($db)
    {
        $sql = "SELECT DISTINCT(AMS_REPAIR_STF),
        AMS_USER_PNAME,AMS_USER_LNAME,
        AMS_USER_FNAME,AMS_USER_ID
        FROM AMS_REPAIR 
        LEFT JOIN AMS_USER
         ON AMS_REPAIR_STF = AMS_USER_ID
        WHERE AMS_REPAIR_ST != '99' 
        ORDER BY AMS_USER_PNAME ASC";
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

    public function ProductListAll($pdcno, $pdcnm, $ac, $stf, $db)
    {

        if ($pdcno != "") {
            $sqlpdcno = "AND AMS_PRODUCT_NO LIKE '%$pdcno%'";
        } else {
            $sqlpdcno = "";
        }

        if ($pdcnm != "") {
            $sqlpdcnm = "AND AMS_PRODUCT_NM LIKE '%$pdcnm%'";
        } else {
            $sqlpdcnm = "";
        }

        if ($pdcno == "" && $pdcnm == "") {
            $acsql = "AMS_PRODUCT_DELST = '1000' ";
        } else {

            if ($ac == "success") {
                $acsql = "AMS_PRODUCT_DELST = '10' ";
            } else {

                $acsql = "AMS_PRODUCT_DELST = '1000' ";
            }
        }



        $sql = "SELECT AMS_PRODUCT_ID,AMS_PRODUCT_NO,AMS_PRODUCT_NM,AMS_REPAIR_ID,AMS_REPAIR_STF,AMS_REPAIR_RST
        FROM AMS_PRODUCT 
        LEFT JOIN AMS_REPAIR
        ON AMS_PRODUCT_ID = AMS_REPAIR_PID
        AND AMS_REPAIR_ST != '99'
        AND AMS_REPAIR_RST = '0'
        WHERE $acsql
        $sqlpdcno
        $sqlpdcnm
        AND AMS_PRODUCT_ST IN ('10','20')
        ORDER BY AMS_PRODUCT_ID ASC";
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

    public function ProductListID($pdcid, $db)
    {

        $sql = "SELECT AMS_PRODUCT_ID,AMS_PRODUCT_NO,AMS_PRODUCT_NM 
        FROM AMS_PRODUCT 
        WHERE AMS_PRODUCT_DELST != '99'
        AND AMS_PRODUCT_ID = '$pdcid'
        ORDER BY AMS_PRODUCT_ID ASC";
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

    function show_maxidNew($year, $db)
    {

        $sql = "SELECT max(AMS_REPAIR_ID) as MAX_ID FROM AMS_REPAIR  where 	AMS_REPAIR_ID like '$year%' ";
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

    public function RepairHistoryAll($id,$fdate,$ldate,$rpsdate,$rpcpn,$rpfsave,$rpst, $db)
    {
        if ($fdate != "" && $ldate != "") {
            $sqlrpdate = "AND  (AMS_REPAIR_DATE BETWEEN '$fdate' AND '$ldate')";
        } else {
            if ($fdate != "") {
                $sqlrpdate = "AND  (AMS_REPAIR_DATE BETWEEN '$fdate' AND '$fdate')";
            } else {
                $sqlrpdate = "";
            }
        }

        if($rpsdate != ""){
            $sqlsdate = "AND AMS_REPAIR_SDATE = '$rpsdate'";
        }else{
            $sqlsdate = "";
        }

        if($rpcpn != ""){
            $sqlcpn = "AND AMS_REPAIR_CPN LIKE '%$rpcpn%'";
        }else{
            $sqlcpn = "";
        }

        if($rpfsave != ""){
            $sqlfsv= "AND AMS_REPAIR_STF = '$rpfsave'";
        }else{
            $sqlfsv = "";
        }

        if($rpst != ""){
            $sqlst = "AND AMS_REPAIR_RST = '$rpst'";
        }else{
            $sqlst = "";
        }

       
        $sql = "SELECT AMS_REPAIR_ID,
        AMS_REPAIR_CAUSE,
           AMS_REPAIR_DATE,
           AMS_REPAIR_SDATE,
           AMS_REPAIR_EXPEN,
           AMS_REPAIR_CPN,
           AMS_REPAIR_RST,CASE 
           WHEN AMS_REPAIR_RST = '0' THEN 'อยู่ระหว่างการซ่อม'
           WHEN AMS_REPAIR_RST = '1' THEN 'ซ่อมแล้ว'
           ELSE '' END AS AMS_REPAIR_RSTNM,
           AMS_REPAIR_ST,
           AMS_REPAIR_STF, AMS_USER_PNAME,
           AMS_USER_FNAME,
           AMS_USER_LNAME
       FROM AMS_REPAIR
       LEFT JOIN AMS_USER
            ON AMS_REPAIR_STF = AMS_USER_ID
       WHERE AMS_REPAIR_ST != '99' 
       AND AMS_REPAIR_PID = '$id'
       $sqlrpdate
       $sqlsdate
       $sqlcpn
       $sqlfsv
       $sqlst
       ORDER BY AMS_REPAIR_DATE ASC";
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

    public function RepairAllTabResult($fdate, $ldate, $rppcdno, $rppcdnm, $rpsdate, $rpcpn, $rpfsave, $rpst, $rpdst, $db)
    {

        if ($fdate != "" && $ldate != "") {
            $sqlrpdate = "AND  (AMS_REPAIR_DATE BETWEEN '$fdate' AND '$ldate')";
        } else {
            if ($fdate != "") {
                $sqlrpdate = "AND  (AMS_REPAIR_DATE BETWEEN '$fdate' AND '$fdate')";
            } else {
                $sqlrpdate = "";
            }
        }

        if ($rppcdno != "") {
            $sqlpno = "AND AMS_PRODUCT_NO LIKE '%$rppcdno%'";
        } else {
            $sqlpno = "";
        }

        if ($rppcdnm != "") {
            $sqlpnm = "AND AMS_PRODUCT_NM LIKE '%$rppcdnm%'";
        } else {
            $sqlpnm = "";
        }

        if ($rpsdate != "") {
            $sqlsdate = "AND AMS_REPAIR_SDATE = '$rpsdate'";
        } else {
            $sqlsdate = "";
        }

        if ($rpcpn != "") {
            $sqlcpn = "AND AMS_REPAIR_CPN LIKE '%$rpcpn%'";
        } else {
            $sqlcpn = "";
        }

        if ($rpfsave != "") {
            $sqlfsv = "AND AMS_REPAIR_STF = '$rpfsave'";
        } else {
            $sqlfsv = "";
        }

        if ($rpst != "") {
            $sqlst = "AND AMS_REPAIR_RST = '$rpst'";
        } else {
            $sqlst = "";
        }

        if ($rpdst != "") {
            $sqldst = "AND AMS_REPAIR_ST = '$rpdst'";
        } else {
            $sqldst = "";
        }

        $sql = "SELECT 	AMS_REPAIR_ID,
        AMS_REPAIR_PNO,
        AMS_REPAIR_PNM,
        AMS_PRODUCT_NO,
        AMS_PRODUCT_NM,
        AMS_REPAIR_PID,
        AMS_REPAIR_CAUSE,
        AMS_REPAIR_DATE,
        AMS_REPAIR_SDATE,
        AMS_REPAIR_EXPEN,
        AMS_REPAIR_CPN,
        AMS_REPAIR_RST,
        CASE 
        WHEN AMS_REPAIR_RST = '0' THEN 'อยู่ระหว่างการซ่อม'
        WHEN AMS_REPAIR_RST = '1' THEN 'ซ่อมแล้ว'
        ELSE '' END AS AMS_REPAIR_RSTNM,
        AMS_REPAIR_ST,
        AMS_REPAIR_STF,
        AMS_REPAIR_FDATE,
        AMS_USER_PNAME,
        AMS_USER_FNAME,
        AMS_USER_LNAME
         FROM AMS_REPAIR 
         LEFT JOIN AMS_PRODUCT
         ON AMS_REPAIR_PID = AMS_PRODUCT_ID
         LEFT JOIN AMS_USER
         ON AMS_REPAIR_STF = AMS_USER_ID
         WHERE AMS_REPAIR_ST != '99' 
         $sqlrpdate
         $sqlpno
         $sqlpnm
         $sqlsdate
         $sqlcpn
         $sqlfsv
         $sqlst
         $sqldst
         ORDER BY AMS_REPAIR_DATE ASC";
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

    public function ListRepairDel($db)
    {

        $sql = "SELECT 	AMS_REPAIR_ID,
        AMS_REPAIR_PNO,
        AMS_REPAIR_PNM,
        AMS_PRODUCT_NO,
        AMS_PRODUCT_NM,
        AMS_REPAIR_PID,
        AMS_REPAIR_CAUSE,
        AMS_REPAIR_DATE,
        AMS_REPAIR_SDATE,
        AMS_REPAIR_EXPEN,
        AMS_REPAIR_CPN,
        AMS_REPAIR_RST,
        CASE 
        WHEN AMS_REPAIR_RST = '0' THEN 'อยู่ระหว่างการซ่อม'
        WHEN AMS_REPAIR_RST = '1' THEN 'ซ่อมแล้ว'
        ELSE '' END AS AMS_REPAIR_RSTNM,
        AMS_REPAIR_ST,
        AMS_REPAIR_STF,
        AMS_REPAIR_FDATE,
        AMS_USER_PNAME,
        AMS_USER_FNAME,
        AMS_USER_LNAME
         FROM AMS_REPAIR 
         LEFT JOIN AMS_PRODUCT
         ON AMS_REPAIR_PID = AMS_PRODUCT_ID
         LEFT JOIN AMS_USER
         ON AMS_REPAIR_STF = AMS_USER_ID
         WHERE AMS_REPAIR_ST = '99' 
         ORDER BY AMS_REPAIR_DATE ASC";
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

    public function RepairPessonTabResult($stf, $fdate, $ldate, $rppcdno, $rppcdnm, $rpsdate, $rpcpn, $rpst, $rpdst, $db)
    {

        if ($fdate != "" && $ldate != "") {
            $sqlrpdate = "AND  (AMS_REPAIR_DATE BETWEEN '$fdate' AND '$ldate')";
        } else {
            if ($fdate != "") {
                $sqlrpdate = "AND  (AMS_REPAIR_DATE BETWEEN '$fdate' AND '$fdate')";
            } else {
                $sqlrpdate = "";
            }
        }

        if ($rppcdno != "") {
            $sqlpno = "AND AMS_PRODUCT_NO LIKE '%$rppcdno%'";
        } else {
            $sqlpno = "";
        }

        if ($rppcdnm != "") {
            $sqlpnm = "AND AMS_PRODUCT_NM LIKE '%$rppcdnm%'";
        } else {
            $sqlpnm = "";
        }

        if ($rpsdate != "") {
            $sqlsdate = "AND AMS_REPAIR_SDATE = '$rpsdate'";
        } else {
            $sqlsdate = "";
        }

        if ($rpcpn != "") {
            $sqlcpn = "AND AMS_REPAIR_CPN LIKE '%$rpcpn%'";
        } else {
            $sqlcpn = "";
        }

        if ($rpst != "") {
            $sqlst = "AND AMS_REPAIR_RST = '$rpst'";
        } else {
            $sqlst = "";
        }

        if ($rpdst != "") {
            $sqldst = "AND AMS_REPAIR_ST = '$rpdst'";
        } else {
            $sqldst = "";
        }

        $sql = "SELECT 	AMS_REPAIR_ID,
        AMS_REPAIR_PNO,
        AMS_REPAIR_PNM,
        AMS_PRODUCT_NO,
        AMS_PRODUCT_NM,
        AMS_REPAIR_PID,
        AMS_REPAIR_CAUSE,
        AMS_REPAIR_DATE,
        AMS_REPAIR_SDATE,
        AMS_REPAIR_EXPEN,
        AMS_REPAIR_CPN,
        AMS_REPAIR_RST,
        CASE 
        WHEN AMS_REPAIR_RST = '0' THEN 'อยู่ระหว่างการซ่อม'
        WHEN AMS_REPAIR_RST = '1' THEN 'ซ่อมแล้ว'
        ELSE '' END AS AMS_REPAIR_RSTNM,
        AMS_REPAIR_ST,
        AMS_REPAIR_STF,
        AMS_REPAIR_FDATE,
        AMS_USER_PNAME,
        AMS_USER_FNAME,
        AMS_USER_LNAME
         FROM AMS_REPAIR 
         LEFT JOIN AMS_PRODUCT
         ON AMS_REPAIR_PID = AMS_PRODUCT_ID
         LEFT JOIN AMS_USER
         ON AMS_REPAIR_STF = AMS_USER_ID
         WHERE AMS_REPAIR_ST != '99' 
         AND AMS_REPAIR_STF = '$stf'
         $sqlrpdate
         $sqlpno
         $sqlpnm
         $sqlsdate
         $sqlcpn
         $sqlst
         $sqldst
         ORDER BY AMS_REPAIR_DATE ASC";
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

    public function RepairEditTabResult($id, $db)
    {

        $sql = "SELECT 	AMS_REPAIR_ID,
        AMS_REPAIR_PNO,
        AMS_REPAIR_PNM,
        AMS_PRODUCT_NO,
        AMS_PRODUCT_NM,
        AMS_REPAIR_PID,
        AMS_REPAIR_CAUSE,
        AMS_REPAIR_DATE,
        AMS_REPAIR_SDATE,
        AMS_REPAIR_EXPEN,
        AMS_REPAIR_CPN,
        AMS_REPAIR_RST,
        CASE 
        WHEN AMS_REPAIR_RST = '0' THEN 'อยู่ระหว่างการซ่อม'
        WHEN AMS_REPAIR_RST = '1' THEN 'ซ่อมแล้ว'
        ELSE '' END AS AMS_REPAIR_RSTNM,
        AMS_REPAIR_ST,
        AMS_REPAIR_STF,
        AMS_REPAIR_FDATE,
        AMS_USER_PNAME,
        AMS_USER_FNAME,
        AMS_USER_LNAME
         FROM AMS_REPAIR 
         LEFT JOIN AMS_PRODUCT
         ON AMS_REPAIR_PID = AMS_PRODUCT_ID
         LEFT JOIN AMS_USER
         ON AMS_REPAIR_STF = AMS_USER_ID
         WHERE AMS_REPAIR_ST != '99' 
         AND AMS_REPAIR_ID = '$id'
         ORDER BY AMS_REPAIR_DATE ASC";
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

    public function InsertRepair($id, $RepairPNO, $RepairPNM, $IdProductToSave, $RepairCase, $TosaveRepairDate, $TosaveRepairDateSuccess, $toSaveRepairPrice, $RepairVender, $RepairStatus, $RepairDataST, $fstf, $fdate, $db)
    {
        $sql = "INSERT INTO AMS_REPAIR 
        (
            AMS_REPAIR_ID,
            AMS_REPAIR_PNO,
            AMS_REPAIR_PNM,
            AMS_REPAIR_PID,
            AMS_REPAIR_CAUSE,
            AMS_REPAIR_DATE,
            AMS_REPAIR_SDATE,
            AMS_REPAIR_EXPEN,
            AMS_REPAIR_CPN,
            AMS_REPAIR_RST,
            AMS_REPAIR_ST,
            AMS_REPAIR_STF,
            AMS_REPAIR_FDATE
        )
        VALUES
        (
            '$id',
            '$RepairPNO',
            '$RepairPNM',
            '$IdProductToSave',
            '$RepairCase',
            $TosaveRepairDate,
            $TosaveRepairDateSuccess,
            '$toSaveRepairPrice',
            '$RepairVender',
            '$RepairStatus',
            '$RepairDataST',
            '$fstf',
            '$fdate'
        )
        ";

        $query = $this->ConMySql()->query($sql);

        if ($query) {

            $mes =  '1';
            $this->ConMySql()->commit();
        } else {

            $mes =  '0';
            $this->ConMySql()->rollback();
        }
        mysqli_close($this->ConMySql());
        return $mes;
        
    }

    public function UpdateRepair($id, $RepairCase, $TosaveRepairDate, $TosaveRepairDateSuccess, $toSaveRepairPrice, $RepairVender, $RepairStatus, $RepairDataST, $fstf, $fdate, $db)
    {
        $sql = "UPDATE AMS_REPAIR SET
        AMS_REPAIR_CAUSE = '$RepairCase',
        AMS_REPAIR_DATE = $TosaveRepairDate,
        AMS_REPAIR_SDATE = $TosaveRepairDateSuccess,
        AMS_REPAIR_EXPEN = '$toSaveRepairPrice',
        AMS_REPAIR_CPN = '$RepairVender',
        AMS_REPAIR_RST = '$RepairStatus',
        AMS_REPAIR_ST = '$RepairDataST',
        AMS_REPAIR_ESTF = '$fstf',
        AMS_REPAIR_EDATE = '$fdate'
        WHERE AMS_REPAIR_ID = '$id'
        ";

        $query = $this->ConMySql()->query($sql);

        if ($query) {

            $mes =  '1';
            $this->ConMySql()->commit();
        } else {

            $mes =  '0';
            $this->ConMySql()->rollback();
        }
        mysqli_close($this->ConMySql());
        return $mes;
        
    }

    public function DelRepair($id, $statusDel, $edate, $estf, $db)
    {
        $sql = "UPDATE AMS_REPAIR SET
        AMS_REPAIR_ST = '$statusDel',
        AMS_REPAIR_ESTF = '$estf',
        AMS_REPAIR_EDATE = '$edate'
        WHERE AMS_REPAIR_ID = '$id'
        ";

        $query = $this->ConMySql()->query($sql);

        if ($query) {

            $mes =  '1';
            $this->ConMySql()->commit();
        } else {

            $mes =  '0';
            $this->ConMySql()->rollback();
        }
        mysqli_close($this->ConMySql());
        return $mes;
        
    }

    function strspace($data, $type)
    {

        if (isset($data)) {
            if ($type == 1) {
                $savedate = str_replace(' ', '', "$data");
            } else {
                $savedate = str_replace(',', '', $data);
            }
        } else {
            $savedate = "";
        }
        return $savedate;
    }

    function dateTosave($date)
    {

        if ($date == "") {
            $Tosave = $date;
        } else {
            $explodedate = explode('/', $date);
            $yearCr = $explodedate['2'] - 543;
            $Tosave = $yearCr . '-' . $explodedate['1'] . '-' . $explodedate['0'];
        }

        if (isset($Tosave)) {

            return $Tosave;
        } else {
            return false;
        }
    }

    function dateToThai($date)
    {
        if ($date == "") {
            $ToThai = $date;
        } else {
            $epdate = explode('-', $date);
            $yearThai = $epdate['0'] + 543;
            $ToThai = $epdate['2'] . '/' . $epdate['1'] . '/' . $yearThai;
        }
        if (isset($ToThai)) {
            return $ToThai;
        } else {
            return false;
        }
    }
}

// $db->close();
