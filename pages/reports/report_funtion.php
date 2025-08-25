<?php
class ReportResult
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

    public function PDFRepair($id, $type)
    {

        if ($type == '1') {
            $sql = "SELECT SUM(AMS_REPAIR_EXPEN) AS SUMEXPEN FROM AMS_REPAIR WHERE AMS_REPAIR_ID IN ($id)";
        } elseif ($type == '2') {
            $sql = "SELECT COUNT(AMS_REPAIR_ID) AS CNTRP FROM AMS_REPAIR WHERE AMS_REPAIR_ID IN ($id) AND AMS_REPAIR_RST = '1'";
        } elseif ($type == '3') {
            $sql = "SELECT COUNT(AMS_REPAIR_ID) AS CNTRP FROM AMS_REPAIR WHERE AMS_REPAIR_ID IN ($id) AND AMS_REPAIR_RST = '0'";
        } elseif ($type == '4') {
            $sql = "SELECT SUM(AMS_ARTICLE_PRICEALL) AS SUMATC FROM AMS_ARTICLE WHERE AMS_ARTICLE_ID IN ($id)";
        }elseif ($type == '5') {
            $sql = "SELECT SUM(AMS_PRODUCT_PRICE) AS SUMPDC FROM  AMS_PRODUCT WHERE AMS_PRODUCT_ID IN ($id)";
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

    public function RepairAllTabResult($fdate, $ldate, $rppcdno, $rppcdnm, $rpsdate, $rpcpn, $rpfsave, $rpst, $rpdst, $rpaped, $rpedcob, $db)
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
         ORDER BY AMS_REPAIR_DATE DESC";
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

    public function YearBudgets($db)
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

    function ProductAndATCBudgetAll($id, $db)
    {

        $sql = "SELECT AMS_PRODUCT_ID AS IDBD,
        AMS_PRODUCT_NO AS BDNO,
        AMS_PRODUCT_NM AS BDNM,
        AMS_PRODUCT_PRICE AS BDPRICE,
        AMS_PRODUCT_YEAR AS BDYEAR,
        'PRODUCT' AS TYPEBD 
        FROM AMS_PRODUCT WHERE AMS_PRODUCT_SOURCE = '$id'
        AND AMS_PRODUCT_DELST != '99'
            UNION
        SELECT AMS_ARTICLE_ID AS IDBD,
        AMS_ARTICLE_TYPE AS BDNO,
        AMS_ARTICLE_NM AS BDNM,
        AMS_ARTICLE_PRICEALL AS BDPRICE ,
        AMS_ARTICLE_YEAR AS BDYEAR,
        'ATC' AS TYPEBD 
        FROM AMS_ARTICLE 
        WHERE AMS_ARTICLE_SOURCE = '$id' 
        AND AMS_ARTICLE_ST != '99'
        ORDER BY TYPEBD DESC,BDYEAR ASC,BDNM DESC";

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

    public function ProductAndATCBudgetAllPDF($id,$type)
    {

        if($type == 1){
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
            WHERE AMS_PRODUCT_SOURCE = '$id'
            AND AMS_PRODUCT_DELST != '99'
            ORDER BY AMS_PRODUCT_ID DESC";

        }elseif($type == 2){

            $sql = "SELECT AMS_ARTICLE_ID,
            AMS_ARTICLE_NM,
            AMS_ARTICLE_TYPE,
            CASE
                WHEN AMS_ARTICLE_TYPE = '10' THEN 'วัสดุสิ้นเปลือง'
                WHEN AMS_ARTICLE_TYPE = '20' THEN 'วัสดุคงทน'
            ELSE '' END AS AMS_ARTICLE_TYPENM,
            AMS_ARTICLE_QTY,
            AMS_ARTICLE_UNIT,
            AMS_ARTICLE_PRICE,
            AMS_ARTICLE_PRICEALL,
            AMS_ARTICLE_EXPDATE,
            AMS_ARTICLE_YEAR,
            AMS_ARTICLE_SOURCE,
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
            AMS_BUDGET_TYPE,
            AMS_ARTICLE_LCT,
            AMS_LCT_NM,
            AMS_ARTICLE_BALANCE,
            AMS_ARTICLE_DBL,
            AMS_ARTICLE_FDATE,
            AMS_ARTICLE_ST 
            FROM AMS_ARTICLE 
            LEFT JOIN AMS_BUDGET
            ON AMS_ARTICLE.AMS_ARTICLE_SOURCE = AMS_BUDGET.AMS_BUDGET_ID
            AND AMS_BUDGET.AMS_BUDGET_ST != '99'
            LEFT JOIN AMS_LCT 
            ON AMS_ARTICLE.AMS_ARTICLE_LCT = AMS_LCT.AMS_LCT_ID
            AND AMS_LCT_ST != '99'
            WHERE AMS_ARTICLE_SOURCE = '$id' 
            AND AMS_ARTICLE_ST != '99'
            ORDER BY AMS_ARTICLE_ID DESC";
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

    public function ListProduct($pdcno, $pdcnm, $pdctype, $pdcstatus, $pdcyear, $pdcsource, $expST, $pedcob, $db)
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

        if ($pdctype != "") {
            $sqlpdctype = "AND AMS_PRODUCT_TYPE = '$pdctype'";
        } else {
            $sqlpdctype = "";
        }

        if ($pdcstatus != "") {
            $sqlpdcstatus = "AND AMS_PRODUCT_ST = '$pdcstatus'";
        } else {
            $sqlpdcstatus = "";
        }

        if ($pdcyear != "") {
            $sqlpdcyear = "AND 	AMS_PRODUCT_YEAR = '$pdcyear'";
        } else {
            $sqlpdcyear = "";
        }

        if ($pdcsource != "") {
            $sqlpdcsource = "AND AMS_PRODUCT_SOURCE = '$pdcsource'";
        } else {
            $sqlpdcsource = "";
        }

        $expNow = date('Y-m-d');
        if ($expST != "") {
            if ($expST == '0') {
                $sqlexpst = "AND AMS_PRODUCT_EXPDATE >= '$expNow'";
            } elseif ($expST == '1') {
                $sqlexpst = "AND AMS_PRODUCT_EXPDATE < '$expNow'";
            } elseif ($expST == '2') {
                $sqlexpst = "AND AMS_PRODUCT_EXPDATE = '$expNow'";
            } elseif ($expST == '3') {
                $sqlexpst = "";
            }
        } else {
            $sqlexpst = "";
        }

        if ($pedcob != "") {
            $sqlpedcob = "AND AMS_PRODUCT_LCT = '$pedcob'";
        } else {
            $sqlpedcob = "";
        }

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
        $sqlpdcno
        $sqlpdcnm
        $sqlpdctype
        $sqlpdcstatus
        $sqlpdcyear
        $sqlpdcsource
        $sqlexpst
        $sqlpedcob
        ORDER BY AMS_PRODUCT_YEAR ASC,AMS_BUDGET_SOURCENM ASC,AMS_PRODUCTSET_NO ASC
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
        return $resultArray;
    }

    public function ListProductDisplayToKH($pdcno, $pdcnm, $pdctype, $pdcstatus, $pdcyear, $pdcsource, $expST, $pedcob)
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

        if ($pdctype != "") {
            $sqlpdctype = "AND AMS_PRODUCT_TYPE = '$pdctype'";
        } else {
            $sqlpdctype = "";
        }

        if ($pdcstatus != "") {
            $sqlpdcstatus = "AND AMS_PRODUCT_ST = '$pdcstatus'";
        } else {
            $sqlpdcstatus = "";
        }

        if ($pdcyear != "") {
            $sqlpdcyear = "AND 	AMS_PRODUCT_YEAR = '$pdcyear'";
        } else {
            $sqlpdcyear = "";
        }

        if ($pdcsource != "") {
            $sqlpdcsource = "AND AMS_PRODUCT_SOURCE = '$pdcsource'";
        } else {
            $sqlpdcsource = "";
        }

        $expNow = date('Y-m-d');
        if ($expST != "") {
            if ($expST == '0') {
                $sqlexpst = "AND AMS_PRODUCT_EXPDATE >= '$expNow'";
            } elseif ($expST == '1') {
                $sqlexpst = "AND AMS_PRODUCT_EXPDATE < '$expNow'";
            } elseif ($expST == '2') {
                $sqlexpst = "AND AMS_PRODUCT_EXPDATE = '$expNow'";
            } elseif ($expST == '3') {
                $sqlexpst = "";
            }
        } else {
            $sqlexpst = "";
        }

        if ($pedcob != "") {
            $sqlpedcob = "AND AMS_PRODUCT_LCT = '$pedcob'";
        } else {
            $sqlpedcob = "";
        }

        $sql = "SELECT COUNT(AMS_PRODUCT_ID) AS CNT,AMS_PRODUCT_ST
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
        $sqlpdcno
        $sqlpdcnm
        $sqlpdctype
        $sqlpdcstatus
        $sqlpdcyear
        $sqlpdcsource
        $sqlexpst
        $sqlpedcob
        GROUP BY AMS_PRODUCT_ST
        ORDER BY AMS_PRODUCT_ST ASC
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
        return $resultArray;
    }


    public function ArticleList($atcname, $atctype, $atcyear, $atcsource, $fdate, $rubpid, $expST, $db)
    {
        if ($atcname != "") {
            $sqlqtcname = "AND AMS_ARTICLE_NM LIKE '%$atcname%'";
        } else {
            $sqlqtcname = "";
        }
        if ($atctype != "") {
            $sqlqtctype = "AND AMS_ARTICLE_TYPE = '$atctype'";
        } else {
            $sqlqtctype = "";
        }
        if ($atcyear != "") {
            $sqlqtcyear = "AND AMS_ARTICLE_YEAR = '$atcyear'";
        } else {
            $sqlqtcyear = "";
        }
        if ($atcsource != "") {
            $sqlqtcsource = "AND AMS_ARTICLE_SOURCE = '$atcsource'";
        } else {
            $sqlqtcsource = "";
        }
        // if ($fdate != "" && $ldate != "") {
        //     $sqlqtcexpdate = "AND  (AMS_ARTICLE_EXPDATE BETWEEN '$fdate' AND '$ldate')";
        // } else {
        //     if ($fdate != "") {
        //         $sqlqtcexpdate = "AND  (AMS_ARTICLE_EXPDATE BETWEEN '$fdate' AND '$fdate')";
        //     } else {
        //         $sqlqtcexpdate = "";
        //     }
        // }

        if ($rubpid != "") {
            $sqlrubpid = "AND AMS_ARTICLE_LCT = '$rubpid'";
        } else {
            $sqlrubpid = "";
        }

        $expNow = date('Y-m-d');

        if ($expST != "") {
            if ($expST == '0') {
                $sqlexpst = "AND AMS_ARTICLE_EXPDATE >= '$expNow'";
            } elseif ($expST == '1') {
                $sqlexpst = "AND AMS_ARTICLE_EXPDATE < '$expNow'";
            } elseif ($expST == '2') {
                $sqlexpst = "AND AMS_ARTICLE_EXPDATE = '$expNow'";
            } elseif ($expST == '3') {
                $sqlexpst = "";
            }
        } else {
            $sqlexpst = "";
        }

        $sql = "SELECT AMS_ARTICLE_ID,
        AMS_ARTICLE_NM,
        AMS_ARTICLE_TYPE,
        CASE
            WHEN AMS_ARTICLE_TYPE = '10' THEN 'วัสดุสิ้นเปลือง'
            WHEN AMS_ARTICLE_TYPE = '20' THEN 'วัสดุคงทน'
        ELSE '' END AS AMS_ARTICLE_TYPENM,
        AMS_ARTICLE_QTY,
        AMS_ARTICLE_UNIT,
        AMS_ARTICLE_PRICE,
        AMS_ARTICLE_PRICEALL,
        AMS_ARTICLE_EXPDATE,
        AMS_ARTICLE_YEAR,
        AMS_ARTICLE_SOURCE,
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
        AMS_BUDGET_TYPE,
        AMS_ARTICLE_LCT,
        AMS_LCT_NM,
        AMS_ARTICLE_BALANCE,
        AMS_ARTICLE_DBL,
        AMS_ARTICLE_FDATE,
        AMS_ARTICLE_ST 
        FROM AMS_ARTICLE 
        LEFT JOIN AMS_BUDGET
        ON AMS_ARTICLE.AMS_ARTICLE_SOURCE = AMS_BUDGET.AMS_BUDGET_ID
        AND AMS_BUDGET.AMS_BUDGET_ST != '99'
        LEFT JOIN AMS_LCT 
        ON AMS_ARTICLE.AMS_ARTICLE_LCT = AMS_LCT.AMS_LCT_ID
        AND AMS_LCT_ST != '99'
        WHERE AMS_ARTICLE_ST != '99'
        $sqlqtcname
        $sqlqtctype
        $sqlqtcyear
        $sqlqtcsource
        $sqlrubpid
        $sqlexpst
        ORDER BY AMS_BUDGET_YEAR ASC,AMS_BUDGET_SOURCENM ASC,AMS_ARTICLE_NM ASC";
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

    public function ArticleListDisplayToKH($atcname, $atctype, $atcyear, $atcsource, $fdate, $rubpid, $expST)
    {
        if ($atcname != "") {
            $sqlqtcname = "AND AMS_ARTICLE_NM LIKE '%$atcname%'";
        } else {
            $sqlqtcname = "";
        }
        if ($atctype != "") {
            $sqlqtctype = "AND AMS_ARTICLE_TYPE = '$atctype'";
        } else {
            $sqlqtctype = "";
        }
        if ($atcyear != "") {
            $sqlqtcyear = "AND AMS_ARTICLE_YEAR = '$atcyear'";
        } else {
            $sqlqtcyear = "";
        }
        if ($atcsource != "") {
            $sqlqtcsource = "AND AMS_ARTICLE_SOURCE = '$atcsource'";
        } else {
            $sqlqtcsource = "";
        }
        if ($rubpid != "") {
            $sqlrubpid = "AND AMS_ARTICLE_LCT = '$rubpid'";
        } else {
            $sqlrubpid = "";
        }

        $expNow = date('Y-m-d');

        if ($expST != "") {
            if ($expST == '0') {
                $sqlexpst = "AND AMS_ARTICLE_EXPDATE >= '$expNow'";
            } elseif ($expST == '1') {
                $sqlexpst = "AND AMS_ARTICLE_EXPDATE < '$expNow'";
            } elseif ($expST == '2') {
                $sqlexpst = "AND AMS_ARTICLE_EXPDATE = '$expNow'";
            } elseif ($expST == '3') {
                $sqlexpst = "";
            }
        } else {
            $sqlexpst = "";
        }

        $sql = "SELECT count(AMS_ARTICLE_ID) AS CNT,AMS_ARTICLE_TYPE AS TYPE
        FROM AMS_ARTICLE 
        LEFT JOIN AMS_BUDGET
        ON AMS_ARTICLE.AMS_ARTICLE_SOURCE = AMS_BUDGET.AMS_BUDGET_ID
        AND AMS_BUDGET.AMS_BUDGET_ST != '99'
        LEFT JOIN AMS_LCT 
        ON AMS_ARTICLE.AMS_ARTICLE_LCT = AMS_LCT.AMS_LCT_ID
        AND AMS_LCT_ST != '99'
        WHERE AMS_ARTICLE_ST != '99'
        $sqlqtcname
        $sqlqtctype
        $sqlqtcyear
        $sqlqtcsource
        $sqlrubpid
        $sqlexpst
        GROUP BY AMS_ARTICLE_TYPE
        ORDER BY AMS_ARTICLE_TYPE ASC";
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

    public function ArticleListToModal($id, $type)
    {

        if ($type == "ATC") {

            $sql = "SELECT AMS_ARTICLE_ID,
        AMS_ARTICLE_NM,
        AMS_ARTICLE_TYPE,
        CASE
            WHEN AMS_ARTICLE_TYPE = '10' THEN 'วัสดุสิ้นเปลือง'
            WHEN AMS_ARTICLE_TYPE = '20' THEN 'วัสดุคงทน'
        ELSE '' END AS AMS_ARTICLE_TYPENM,
        AMS_ARTICLE_QTY,
        AMS_ARTICLE_UNIT,
        AMS_ARTICLE_PRICE,
        AMS_ARTICLE_PRICEALL,
        AMS_ARTICLE_EXPDATE,
        AMS_ARTICLE_YEAR,
        AMS_ARTICLE_SOURCE,
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
        AMS_BUDGET_TYPE,
        AMS_ARTICLE_LCT,
        AMS_LCT_NM,
        AMS_ARTICLE_BALANCE,
        AMS_ARTICLE_DBL,
        AMS_ARTICLE_FDATE,
        AMS_ARTICLE_ST 
        FROM AMS_ARTICLE 
        LEFT JOIN AMS_BUDGET
        ON AMS_ARTICLE.AMS_ARTICLE_SOURCE = AMS_BUDGET.AMS_BUDGET_ID
        AND AMS_BUDGET.AMS_BUDGET_ST != '99'
        LEFT JOIN AMS_LCT 
        ON AMS_ARTICLE.AMS_ARTICLE_LCT = AMS_LCT.AMS_LCT_ID
        AND AMS_LCT_ST != '99'
        WHERE AMS_ARTICLE_ST != '99'
        AND AMS_ARTICLE_ID = '$id'
        ORDER BY AMS_ARTICLE_ID ASC";
        } else {

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
        AND AMS_PRODUCT_ID = '$id'
        ORDER BY AMS_PRODUCT_ID ASC";
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

    public function DisplayHeader($id, $type)
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

        if (isset($resultArray['0']['DISNM'])) {
            $Display = $resultArray['0']['DISNM'];
        } else {
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
