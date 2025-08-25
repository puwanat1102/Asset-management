<?php
class DashboradResult
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

    public function ReportRepairProcessing($db)
    {

        $sql = "SELECT 	AMS_REPAIR_ID,
        AMS_REPAIR_PNO,
        AMS_REPAIR_PNM,
        AMS_PRODUCT_NO,
        AMS_PRODUCT_NM,
        AMS_PRODUCTSET_NO,
        AMS_PRODUCTSET_NM,
        AMS_PRODUCTSET_QTY,
        AMS_PRODUCTSET_PRICE,
        AMS_PRODUCT_QTY,
        AMS_PRODUCT_PRICE,
        AMS_PRODUCT_SDATE,
        AMS_PRODUCT_EXPDATE,
        AMS_DEPRECIATION_TYPE,
        AMS_LCT_NM,
        AMS_PRODUCT_LOC,
        AMS_PRODUCT_YEAR,
        CASE
            WHEN AMS_BUDGET_SOURCE = '101' THEN 'งบรายได้'
            WHEN AMS_BUDGET_SOURCE = '102' THEN 'งบรายจ่าย'
            WHEN AMS_BUDGET_SOURCE = '103' THEN 'งบอื่นๆ'
        ELSE '' END AS AMS_BUDGET_SOURCENM,
        CASE
            WHEN AMS_BUDGET_CLASS = '201' THEN 'ปริญญาตรี'
            WHEN AMS_BUDGET_CLASS = '202' THEN 'ปริญญาโท'
            WHEN AMS_BUDGET_CLASS = '203' THEN 'ปริญญาเอก'
        ELSE '' END AS AMS_BUDGET_CLASSNM,
        CASE
            WHEN AMS_BUDGET_TYPE = '301' THEN 'ภาคปกติ'
            WHEN AMS_BUDGET_TYPE = '302' THEN 'ภาคพิเศษ'
        ELSE '' END AS AMS_BUDGET_TYPENM,
        CASE
            WHEN AMS_PRODUCT_ST = '10' THEN 'ปกติ'
            WHEN AMS_PRODUCT_ST = '20' THEN 'เสีย'
            WHEN AMS_PRODUCT_ST = '30' THEN 'รอแทงจำหน่าย'
            WHEN AMS_PRODUCT_ST = '40' THEN 'แทงจำหน่าย/ตัดออกจากบัญชี'
        ELSE '' END AS AMS_PRODUCT_STNM,
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
         LEFT JOIN AMS_LCT
        ON AMS_PRODUCT_LCT = AMS_LCT_ID
        AND AMS_LCT_ST = '10'
        LEFT JOIN AMS_BUDGET
        ON AMS_PRODUCT_SOURCE = AMS_BUDGET_ID
        AND AMS_BUDGET_ST = '10'
        LEFT JOIN AMS_DEPRECIATION
        ON AMS_PRODUCT_TYPE = AMS_DEPRECIATION_ID
        AND AMS_DEPRECIATION_ST = '10'
        LEFT JOIN AMS_PRODUCTSET
        ON AMS_PRODUCT_SET = AMS_PRODUCTSET_ID
         LEFT JOIN AMS_USER
         ON AMS_REPAIR_STF = AMS_USER_ID
         WHERE AMS_REPAIR_ST != '99' 
         AND AMS_REPAIR_RST = '0'
         ORDER BY AMS_REPAIR_SDATE ASC";
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

    public function Amountbudget($id, $db)
    {

        $sql = "SELECT AMS_BUDGET_ID,
        AMS_BUDGET_YEAR,
        CASE
            WHEN AMS_BUDGET_SOURCE = '101' THEN 'งบรายได้'
            WHEN AMS_BUDGET_SOURCE = '102' THEN 'งบรายจ่าย'
            WHEN AMS_BUDGET_SOURCE = '103' THEN 'งบอื่นๆ'
        ELSE '' END AS AMS_BUDGET_SOURCENM,
        CASE 
            WHEN AMS_BUDGET_CLASS = '201' THEN 'ปริญญาตรี'
            WHEN AMS_BUDGET_CLASS = '202' THEN 'ปริญญาโท'
            WHEN AMS_BUDGET_CLASS = '203' THEN 'ปริญญาเอก'
        ELSE '' END AS AMS_BUDGET_CLASSNM,
        CASE
            WHEN AMS_BUDGET_TYPE = '301' THEN 'ภาคปกติ'
            WHEN AMS_BUDGET_TYPE = '302' THEN 'ภาคพิเศษ'
        ELSE '' END AS AMS_BUDGET_TYPENM,
        AMS_BUDGET_AMOUNT 
        FROM AMS_BUDGET 
        WHERE AMS_BUDGET_ID = '$id'
        AND AMS_BUDGET_ST != '99'";
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

    public function SumpriceToBudget($id, $tyep, $db)
    {

        if ($tyep == '1') {

            $sql = "SELECT SUM(AMS_PRODUCT_PRICE) AS SUMPRICEPDC 
            FROM AMS_PRODUCT 
            WHERE AMS_PRODUCT_SOURCE = '$id' 
            AND AMS_PRODUCT_DELST != '99'";
        } elseif ($tyep == '2') {

            $sql = "SELECT SUM(AMS_ARTICLE_PRICEALL) AS SUMPRICEATC
            FROM AMS_ARTICLE 
            WHERE AMS_ARTICLE_SOURCE = '$id' 
            AND AMS_ARTICLE_ST != '99'";
        }

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

    public function CountPDCToDisplay($status)
    {

        if ($status == '100') {
            $sql = "SELECT count(AMS_PRODUCT_ID) AS CNTPDC
            FROM AMS_PRODUCT 
            WHERE AMS_PRODUCT_DELST != '99'";
        } else {
            $sql = "SELECT count(AMS_PRODUCT_ID) AS CNTPDC
            FROM AMS_PRODUCT 
            WHERE AMS_PRODUCT_ST = '$status' 
            AND AMS_PRODUCT_DELST != '99'";
        }

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

    public function Top10RepairDashboard()
    {
            $sql = "SELECT AMS_PRODUCT_NM,AMS_PRODUCT_ID,count(AMS_REPAIR_ID) AS CNTTOP10 
            FROM AMS_REPAIR
            LEFT JOIN AMS_PRODUCT
            ON AMS_REPAIR_PID = AMS_PRODUCT_ID
            WHERE AMS_REPAIR_ST != '99'
            GROUP BY AMS_REPAIR_PID 
            ORDER BY count(AMS_REPAIR_ID) DESC
            LIMIT 10";
        
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

    public function CountATCToDisplay($status)
    {

        if ($status == '100') {
            $sql = "SELECT count(AMS_ARTICLE_ID) AS CNTATC
            FROM AMS_ARTICLE 
            WHERE AMS_ARTICLE_ST != '99'";
        } else {
            $sql = "SELECT count(AMS_ARTICLE_ID) AS CNTATC
            FROM AMS_ARTICLE 
            WHERE AMS_ARTICLE_TYPE = '$status' 
            AND AMS_ARTICLE_ST != '99'";
        }

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

    public function RepairAllTabResult($fdate, $ldate, $rppcdno, $rppcdnm, $rpsdate, $rpcpn, $rpfsave, $rpst, $rpdst,$rpaped,$rpedcob, $db)
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

        if ($rpaped != "") {
            $sqlrpaped = "AND 	AMS_PRODUCT_TYPE = '$rpaped'";
        } else {
            $sqlrpaped = "";
        }

        if ($rpedcob != "") {
            $sqlrpedcob = "AND 	AMS_PRODUCT_LCT = '$rpedcob'";
        } else {
            $sqlrpedcob = "";
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
        AMS_PRODUCTSET_NO,
        AMS_PRODUCTSET_NM,
        AMS_PRODUCTSET_QTY,
        AMS_PRODUCTSET_PRICE,
        AMS_PRODUCT_QTY,
        AMS_PRODUCT_PRICE,
        AMS_PRODUCT_SDATE,
        AMS_PRODUCT_EXPDATE,
        AMS_DEPRECIATION_TYPE,
        AMS_LCT_NM,
        AMS_PRODUCT_LOC,
        AMS_PRODUCT_YEAR,
        CASE
            WHEN AMS_BUDGET_SOURCE = '101' THEN 'งบรายได้'
            WHEN AMS_BUDGET_SOURCE = '102' THEN 'งบรายจ่าย'
            WHEN AMS_BUDGET_SOURCE = '103' THEN 'งบอื่นๆ'
        ELSE '' END AS AMS_BUDGET_SOURCENM,
        CASE
            WHEN AMS_BUDGET_CLASS = '201' THEN 'ปริญญาตรี'
            WHEN AMS_BUDGET_CLASS = '202' THEN 'ปริญญาโท'
            WHEN AMS_BUDGET_CLASS = '203' THEN 'ปริญญาเอก'
        ELSE '' END AS AMS_BUDGET_CLASSNM,
        CASE
            WHEN AMS_BUDGET_TYPE = '301' THEN 'ภาคปกติ'
            WHEN AMS_BUDGET_TYPE = '302' THEN 'ภาคพิเศษ'
        ELSE '' END AS AMS_BUDGET_TYPENM,
        CASE
            WHEN AMS_PRODUCT_ST = '10' THEN 'ปกติ'
            WHEN AMS_PRODUCT_ST = '20' THEN 'เสีย'
            WHEN AMS_PRODUCT_ST = '30' THEN 'รอแทงจำหน่าย'
            WHEN AMS_PRODUCT_ST = '40' THEN 'แทงจำหน่าย/ตัดออกจากบัญชี'
        ELSE '' END AS AMS_PRODUCT_STNM,
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
         LEFT JOIN AMS_LCT
        ON AMS_PRODUCT_LCT = AMS_LCT_ID
        AND AMS_LCT_ST = '10'
        LEFT JOIN AMS_BUDGET
        ON AMS_PRODUCT_SOURCE = AMS_BUDGET_ID
        AND AMS_BUDGET_ST = '10'
        LEFT JOIN AMS_DEPRECIATION
        ON AMS_PRODUCT_TYPE = AMS_DEPRECIATION_ID
        AND AMS_DEPRECIATION_ST = '10'
        LEFT JOIN AMS_PRODUCTSET
        ON AMS_PRODUCT_SET = AMS_PRODUCTSET_ID
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
         $sqlrpaped
         $sqlrpedcob
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

    public function YearBudgets()
    {
        $sql = "SELECT DISTINCT(AMS_BUDGET_YEAR) AS BGYEAR FROM AMS_BUDGET WHERE AMS_BUDGET_ST = '10' ORDER BY AMS_BUDGET_YEAR ASC";
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

    function EditResultBudget($year)
    {

        $sql = "SELECT AMS_BUDGET_ID,AMS_BUDGET_YEAR,AMS_BUDGET_SOURCE,AMS_BUDGET_CLASS,AMS_BUDGET_TYPE,AMS_BUDGET_AMOUNT,AMS_BUDGET_ETC,AMS_BUDGET_STF,AMS_BUDGET_ST,
         CASE
            WHEN AMS_BUDGET_SOURCE = '101' THEN 'งบรายได้'
            WHEN AMS_BUDGET_SOURCE = '102' THEN 'งบรายจ่าย'
            WHEN AMS_BUDGET_SOURCE = '103' THEN 'งบอื่นๆ'
        ELSE '' END AS AMS_BUDGET_SOURCENM,
        CASE 
            WHEN AMS_BUDGET_CLASS = '201' THEN 'ปริญญาตรี'
            WHEN AMS_BUDGET_CLASS = '202' THEN 'ปริญญาโท'
            WHEN AMS_BUDGET_CLASS = '203' THEN 'ปริญญาเอก'
        ELSE '' END AS AMS_BUDGET_CLASSNM,
        CASE
            WHEN AMS_BUDGET_TYPE = '301' THEN 'ภาคปกติ'
            WHEN AMS_BUDGET_TYPE = '302' THEN 'ภาคพิเศษ'
        ELSE '' END AS AMS_BUDGET_TYPENM
        FROM AMS_BUDGET
        WHERE AMS_BUDGET_YEAR = '$year'
        ORDER BY AMS_BUDGET_SOURCE ASC";
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


    
    public function Top10ProductOld()
    {
        $sql = "SELECT AMS_PRODUCT_ID,
        AMS_PRODUCT_NO,
        AMS_PRODUCT_NM,
        AMS_PRODUCT_QTY,
        AMS_PRODUCT_PRICE,
        AMS_PRODUCT_SDATE,
        AMS_PRODUCT_EXPDATE,
        AMS_PRODUCT_TYPE,
        AMS_DEPRECIATION_TYPE,
        AMS_PRODUCT_LCT,
        AMS_LCT_NM,
        AMS_PRODUCT_LOC,
        AMS_PRODUCT_ST,
        AMS_PRODUCT_YEAR,
        AMS_PRODUCT_SOURCE,
        AMS_PRODUCT_DELST,
        AMS_PRODUCT_STF,
        AMS_PRODUCT_SET,
        AMS_PRODUCT_FDATE,
        AMS_BUDGET_SOURCE,
        AMS_BUDGET_CLASS,
        AMS_BUDGET_TYPE,
        AMS_PRODUCTSET_NM,
        AMS_PRODUCTSET_NO,
        AMS_PRODUCTSET_QTY,
        AMS_PRODUCTSET_PRICE,
        AMS_PRODUCTSET_TOTAL,
        CASE
            WHEN AMS_BUDGET_SOURCE = '101' THEN 'งบรายได้'
            WHEN AMS_BUDGET_SOURCE = '102' THEN 'งบรายจ่าย'
            WHEN AMS_BUDGET_SOURCE = '103' THEN 'งบอื่นๆ'
        ELSE '' END AS AMS_BUDGET_SOURCENM,
        CASE
            WHEN AMS_BUDGET_CLASS = '201' THEN 'ปริญญาตรี'
            WHEN AMS_BUDGET_CLASS = '202' THEN 'ปริญญาโท'
            WHEN AMS_BUDGET_CLASS = '203' THEN 'ปริญญาเอก'
        ELSE '' END AS AMS_BUDGET_CLASSNM,
        CASE
            WHEN AMS_BUDGET_TYPE = '301' THEN 'ภาคปกติ'
            WHEN AMS_BUDGET_TYPE = '302' THEN 'ภาคพิเศษ'
        ELSE '' END AS AMS_BUDGET_TYPENM,
        CASE
            WHEN AMS_PRODUCT_ST = '10' THEN 'ปกติ'
            WHEN AMS_PRODUCT_ST = '20' THEN 'เสีย'
            WHEN AMS_PRODUCT_ST = '30' THEN 'รอแทงจำหน่าย'
            WHEN AMS_PRODUCT_ST = '40' THEN 'แทงจำหน่าย/ตัดออกจากบัญชี'
        ELSE '' END AS AMS_PRODUCT_STNM

        FROM AMS_PRODUCT
        LEFT JOIN AMS_LCT
        ON AMS_PRODUCT_LCT = AMS_LCT_ID
        AND AMS_LCT_ST = '10'
        LEFT JOIN AMS_BUDGET
        ON AMS_PRODUCT_SOURCE = AMS_BUDGET_ID
        AND AMS_BUDGET_ST = '10'
        LEFT JOIN AMS_DEPRECIATION
        ON AMS_PRODUCT_TYPE = AMS_DEPRECIATION_ID
        AND AMS_DEPRECIATION_ST = '10'
        LEFT JOIN AMS_PRODUCTSET
        ON AMS_PRODUCT_SET = AMS_PRODUCTSET_ID
        WHERE AMS_PRODUCT_DELST != '99'
        ORDER BY AMS_PRODUCT_SDATE ASC
        LIMIT 10
        ";
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

    function ProductAndATCBudgetAll($id, $db)
    {

        $sql = "SELECT AMS_PRODUCT_ID AS IDBD,
        AMS_PRODUCT_NO AS BDNO,
        AMS_PRODUCT_NM AS BDNM,
        AMS_PRODUCT_PRICE AS BDPRICE,
        'PRODUCT' AS TYPEBD 
        FROM AMS_PRODUCT WHERE AMS_PRODUCT_SOURCE = '$id'
        AND AMS_PRODUCT_DELST != '99'
            UNION
        SELECT AMS_ARTICLE_ID AS IDBD,
        AMS_ARTICLE_TYPE AS BDNO,
        AMS_ARTICLE_NM AS BDNM,
        AMS_ARTICLE_PRICEALL AS BDPRICE ,
        'ATC' AS TYPEBD 
        FROM AMS_ARTICLE 
        WHERE AMS_ARTICLE_SOURCE = '$id' 
        AND AMS_ARTICLE_ST != '99'
        ORDER BY TYPEBD";

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

    public function Deprlist($db)
    {
        $sql = "SELECT AMS_DEPRECIATION_ID,AMS_DEPRECIATION_TYPE FROM  AMS_DEPRECIATION WHERE AMS_DEPRECIATION_ST = '10' ORDER BY AMS_DEPRECIATION_ID ASC";
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

    public function LCTToPDashboard()
    {
        $sql = "SELECT COUNT(AMS_PRODUCT_ID) AS CNTLCT,AMS_LCT_NM 
        FROM AMS_PRODUCT
        LEFT JOIN AMS_LCT
        ON AMS_PRODUCT_LCT = AMS_LCT_ID
        WHERE AMS_PRODUCT_DELST != '99' 
        AND AMS_PRODUCT_ST IN ('10','20')
        GROUP BY AMS_PRODUCT_LCT
        ORDER BY COUNT(AMS_PRODUCT_ID) DESC";
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

    public function LCTToPDashboardATC()
    {
        $sql = "SELECT COUNT(AMS_ARTICLE_ID) AS CNTATC,AMS_LCT_NM 
        FROM AMS_ARTICLE 
        LEFT JOIN AMS_LCT
        ON AMS_ARTICLE_LCT = AMS_LCT_ID
        WHERE AMS_ARTICLE_ST != '99'
        GROUP BY AMS_ARTICLE_LCT
        ORDER BY COUNT(AMS_ARTICLE_ID) DESC";
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


    public function Lctlist()
    {
        $sql = "SELECT AMS_LCT_ID,AMS_LCT_NM FROM AMS_LCT WHERE AMS_LCT_ST = '10' ORDER BY AMS_LCT_ID ASC";
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

    public function DisplayHeader($id,$type)
    {
        switch ($type) {
            case '1':
                $sql = "SELECT AMS_DEPRECIATION_TYPE AS DISNM FROM  AMS_DEPRECIATION WHERE AMS_DEPRECIATION_ID ='$id'";
                break;
            case '2':
                $sql = "SELECT AMS_LCT_NM AS DISNM FROM AMS_LCT WHERE AMS_LCT_ID ='$id'";
                break;
            case '3':
                $sql = "SELECT CONCAT(AMS_USER_PNAME,AMS_USER_FNAME,' ',AMS_USER_LNAME) AS DISNM FROM AMS_USER WHERE AMS_USER_ID ='$id'";
                break;
            default:
                # code...
                break;
        }
        
        $query = $this->ConMySql()->query($sql);

        if (!$query) {
            printf("Error: %s\n", $this->ConMySql()->error);
            exit();
        }
        $resultArray = array();
        while ($result = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
            array_push($resultArray, $result);
        }

        if(isset($resultArray['0']['DISNM'])){
            $Display = $resultArray['0']['DISNM'];
        }else{
            $Display = "";
        }
        
         mysqli_close($this->ConMySql());
        // echo $sql;
        return $Display;
    }

    public function RepairAllYear($type)
    {
        $Datestart = date('Y') - 1;
        $Dateend = date('Y');
        if ($type == 1) {
            $sql = "SELECT COUNT(AMS_REPAIR_ID) AS CNTRPYEAR FROM AMS_REPAIR 
            WHERE AMS_REPAIR_ST != '99' 
            AND AMS_REPAIR_DATE BETWEEN '$Datestart-10-01' AND '$Dateend-09-30'";
        } else {

            $sql = "SELECT SUM(AMS_REPAIR_EXPEN) AS SUMRPYEAR FROM AMS_REPAIR 
        WHERE AMS_REPAIR_ST != '99' 
        AND AMS_REPAIR_DATE BETWEEN '$Datestart-10-01' AND '$Dateend-09-30'";
        }

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

    
    function SumPriceAllBudget($id, $type)
    {

        if ($type == 1) {

            $sql = "SELECT SUM(AMS_PRODUCT_PRICE) AS SUMPRICEPRODUCT FROM AMS_PRODUCT WHERE AMS_PRODUCT_SOURCE = '$id' AND AMS_PRODUCT_DELST != '99'";
        } else {
            $sql = "SELECT SUM(AMS_ARTICLE_PRICEALL) AS SUMPRICEATC FROM AMS_ARTICLE WHERE AMS_ARTICLE_SOURCE = '$id' AND AMS_ARTICLE_ST != '99'";
        }

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

    function AgeProduct($rubdate)
    {

        $dateOfBirth = $rubdate;
        $currentDate  = date('Y-m-d');
        $diff = abs(strtotime($currentDate) - strtotime($dateOfBirth));

        $years = floor($diff / (365 * 60 * 60 * 24));
        $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
        $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));

        if ($years != 0 && $months != 0 && $days != 0) {
            $allDate = $years . ' ปี ' . $months . ' เดือน ' . $days . ' วัน';
        }elseif ($years == 0 && $months != 0 && $days != 0) {
            $allDate = $months . ' เดือน ' . $days . ' วัน';
        } elseif ($years == 0 && $months == 0 && $days != 0) {
            $allDate = $days . ' วัน';
        }elseif ($years == 0 && $months != 0 && $days == 0) {
            $allDate = $months . ' เดือน';
        }  else {
            //  $allDate = '<br>1->'.$years.'<br>2->'.$months.'<br>3->'.$days . ' วัน';
            $allDate = $days.' วัน';
        }
        // $allDate = $years.' ปี '.$months.' เดือน '.$days.' วัน';

        return $allDate;
    }
}

// $db->close();
