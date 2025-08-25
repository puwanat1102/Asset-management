<?php
class ProductResult
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

    public function ProductSetAllList($db)
    {
        $sql = "SELECT AMS_PRODUCTSET_ID,
        AMS_PRODUCTSET_NM,
        AMS_PRODUCTSET_NO
        FROM AMS_PRODUCTSET
        WHERE AMS_PRODUCTSET_ST != '99'";
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
    public function ListProduct($pdcno, $pdcnm, $pdctype, $pdcstatus, $pdcyear, $pdcsource, $pdcdatast, $set, $db)
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

        if ($pdcdatast != "") {
            $sqlpdcdatast = "AND AMS_PRODUCT_DELST = '$pdcdatast'";
        } else {
            $sqlpdcdatast = "";
        }

        if ($set != "") {
            $sqlset = "AND AMS_PRODUCT_SET = '$set'";
        } else {
            $sqlset = "";
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
        $sqlpdcdatast
        $sqlset
        ORDER BY AMS_PRODUCT_ID ASC
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

    public function ListProductAllWarranty($expST, $fdate, $ldate, $atcstatus, $db)
    {
        $expNow = date('Y-m-d');
        $exMonth = date('m');
        $exYear = date('Y');

        if ($expST == '0') {
            $sqlexpst = "AND AMS_PRODUCT_EXPDATE >= '$expNow'";
        } elseif ($expST == '1') {
            $sqlexpst = "AND AMS_PRODUCT_EXPDATE < '$expNow'";
        } elseif ($expST == '2') {
            $sqlexpst = "AND MONTH(AMS_PRODUCT_EXPDATE) = '$exMonth' AND YEAR(AMS_PRODUCT_EXPDATE)='$exYear'";
        } elseif ($expST == '3') {
            $sqlexpst = "";
        }

        if ($fdate != "" && $ldate != "") {
            $sqlqtcexpdate = "AND  (AMS_PRODUCT_EXPDATE BETWEEN '$fdate' AND '$ldate')";
        } else {
            if ($fdate != "") {
                $sqlqtcexpdate = "AND  (AMS_PRODUCT_EXPDATE BETWEEN '$fdate' AND '$fdate')";
            } else {
                $sqlqtcexpdate = "";
            }
        }
        if ($atcstatus != "") {
            $sqlqtst = "AND AMS_PRODUCT_DELST = '$atcstatus'";
        } else {
            $sqlqtst = "";
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
        $sqlexpst
        $sqlqtcexpdate
        $sqlqtst
        ORDER BY AMS_PRODUCT_EXPDATE ASC";
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

    public function ListProductDel($db)
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
        AMS_PRODUCTSET_ST,
        AMS_PRODUCT_FDATE,
        AMS_BUDGET_SOURCE,
        AMS_BUDGET_CLASS,
        AMS_BUDGET_TYPE,
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
        WHERE AMS_PRODUCT_DELST = '99'
        ORDER BY AMS_PRODUCT_ID ASC
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

    public function ListProductDelSet($db)
    {
        $sql = "SELECT 
        AMS_PRODUCTSET_ID,
        AMS_PRODUCTSET_NM,
        AMS_PRODUCTSET_NO,
        AMS_PRODUCTSET_QTY,
        AMS_PRODUCTSET_PRICE,
        AMS_PRODUCTSET_TOTAL,
        AMS_PRODUCTSET_YEAR,
        AMS_PRODUCTSET_SOURCE,
        AMS_PRODUCTSET_LCT,
        AMS_PRODUCTSET_ST
        FROM AMS_PRODUCTSET
        WHERE AMS_PRODUCTSET_ST = '99'
        ORDER BY AMS_PRODUCTSET_ID ASC
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

    function ListUserAMS($db)
    {
        $sql = "SELECT AMS_USER_ID,AMS_USER_FNAME,AMS_USER_LNAME,AMS_USER_PNAME,AMS_USER_POS,AMS_USER_GRP,AMS_USER_ST,AMS_POS.AMS_POS_NM,AMS_USER_TYPE,AMS_USER_USN,AMS_USER_FDATE,
        CASE 
        WHEN AMS_USER_GRP = '201' THEN 'ผู้ใช้ทั่วไป'
        WHEN AMS_USER_GRP = '202' THEN 'วัสดุ'
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
        return $resultArray;
    }


    public function ListProductEdit($id, $db)
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
        AMS_BUDGET_AMOUNT,
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
        WHERE AMS_PRODUCT_DELST != '99'
        AND AMS_PRODUCT_ID = '$id'
        ORDER BY AMS_PRODUCT_ID ASC
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

    public function ProductSetEditAll($id, $db)
    {
        $sql = "SELECT AMS_PRODUCTSET_ID,
        AMS_PRODUCTSET_NM,
        AMS_PRODUCTSET_NO,
        AMS_PRODUCTSET_QTY,
        AMS_PRODUCTSET_PRICE,
        AMS_PRODUCTSET_TOTAL,
        AMS_PRODUCTSET_YEAR,
        AMS_PRODUCTSET_SOURCE,
        AMS_PRODUCTSET_LCT,
        AMS_PRODUCTSET_RUB,
        AMS_PRODUCTSET_ST,
        AMS_BUDGET_SOURCE,
        AMS_BUDGET_CLASS,
        AMS_BUDGET_TYPE,
        AMS_BUDGET_AMOUNT,
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
         FROM AMS_PRODUCTSET
         LEFT JOIN AMS_BUDGET
         ON AMS_PRODUCTSET_SOURCE = AMS_BUDGET_ID
         AND AMS_BUDGET_ST = '10'
         WHERE AMS_PRODUCTSET_ID = '$id'";
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

    public function ListProductToSetEdit($id, $db)
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
        AMS_BUDGET_AMOUNT,
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
        WHERE AMS_PRODUCT_DELST != '99'
        AND AMS_PRODUCT_SET = '$id'
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
        // echo $sql;
        return $resultArray;
    }

    public function Lctlist($db)
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

    public function show_maxidNew($year, $db)
    {

        $sql = "SELECT max(	AMS_PRODUCT_ID) as MAX_ID FROM AMS_PRODUCT  where 	AMS_PRODUCT_ID like '$year%' ";
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

    public function productSubsetList($id, $db)
    {

        $sql = "SELECT AMS_PRODUCTSUBSET_ID,AMS_PRODUCTSUBSET_PID,AMS_PRODUCTSUBSET_NO,	AMS_PRODUCTSUBSET_NM 
        FROM  AMS_PRODUCTSUBSET 
        WHERE AMS_PRODUCTSUBSET_PID ='$id' 
        AND AMS_PRODUCTSUBSET_DELST != '99'";
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

    public function productSubsetList2($id, $db)
    {

        $sql = "SELECT AMS_PRODUCTSUBSET_ID,AMS_PRODUCTSUBSET_PID,AMS_PRODUCTSUBSET_NO,	AMS_PRODUCTSUBSET_NM 
        FROM  AMS_PRODUCTSUBSET 
        WHERE AMS_PRODUCTSUBSET_PID ='$id' 
        AND AMS_PRODUCTSUBSET_DELST != '99'";
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



    public function chkSetlistToid($id, $db)
    {

        $sql = "SELECT AMS_PRODUCT_ID FROM AMS_PRODUCT WHERE AMS_PRODUCT_SET ='$id'";
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

    public function show_maxidNewSet($year, $db)
    {

        $sql = "SELECT max(AMS_PRODUCTSET_ID) as MAX_ID FROM AMS_PRODUCTSET  where 	AMS_PRODUCTSET_ID like '$year%' ";
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

    public function show_maxidNewSubSet($year, $db)
    {

        $sql = "SELECT max(AMS_PRODUCTSUBSET_ID) as MAX_ID FROM AMS_PRODUCTSUBSET  where 	AMS_PRODUCTSUBSET_ID like '$year%' ";
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

    public function InsertProductSet($id, $pdcsetname, $pdcsetno, $pdcsetunit, $toSaveproductPriceSet, $toSaveproductPriceSetall, $pdcsetyear, $pdcsetsorce, $pdclctset, $pdcsetdatast, $productFstf, $productFdate, $productrubpid, $db)
    {
        $sql = "INSERT INTO AMS_PRODUCTSET
        (
            AMS_PRODUCTSET_ID,
            AMS_PRODUCTSET_NM,
            AMS_PRODUCTSET_NO,
            AMS_PRODUCTSET_QTY,
            AMS_PRODUCTSET_PRICE,
            AMS_PRODUCTSET_TOTAL,
            AMS_PRODUCTSET_YEAR,
            AMS_PRODUCTSET_SOURCE,
            AMS_PRODUCTSET_LCT,
            AMS_PRODUCTSET_ST,
            AMS_PRODUCTSET_STF,
            AMS_PRODUCTSET_FDATE,
            AMS_PRODUCTSET_RUB


        )
        VALUES
        (
            '$id',
            '$pdcsetname',
            '$pdcsetno',
            '$pdcsetunit',
            '$toSaveproductPriceSet',
            '$toSaveproductPriceSetall',
            '$pdcsetyear',
            '$pdcsetsorce',
            '$pdclctset',
            '$pdcsetdatast',
            '$productFstf',
            '$productFdate',
            $productrubpid
        )";

        $query = $this->ConMySql()->query($sql);

        if ($query) {

            $mes = '1';
            $this->ConMySql()->commit();
        } else {

            $mes = '0';
            $this->ConMySql()->rollback();
        }
        mysqli_close($this->ConMySql());
        return $mes;
    }

    public function InsertProductSubSet($id, $id2, $productSubNo, $productSubName, $productDatastatus, $productFstf, $productFdate, $db)
    {
        $sql = "INSERT INTO AMS_PRODUCTSUBSET 
        (
            AMS_PRODUCTSUBSET_ID,
            AMS_PRODUCTSUBSET_PID,
            AMS_PRODUCTSUBSET_NO,
            AMS_PRODUCTSUBSET_NM,
            AMS_PRODUCTSUBSET_DELST,
            AMS_PRODUCTSUBSET_STF,
            AMS_PRODUCTSUBSET_FDATE
        )
        VALUES
        (
            '$id',
            '$id2',
            '$productSubNo',
            '$productSubName',
            '$productDatastatus',
            '$productFstf',
            '$productFdate'
        )";

        $query = $this->ConMySql()->query($sql);

        if ($query) {

            $mes = '1';
            $this->ConMySql()->commit();
        } else {

            $mes = '0';
            $this->ConMySql()->rollback();
        }
        mysqli_close($this->ConMySql());
        return $mes;
    }

    public function InsertProduct($id, $productNo, $productName, $productUnit, $toSaveproductPrice, $TosaveProductSdate, $TosaveproductExpdate, $productType, $productLct, $productLocation, $productStatus, $productYear, $productSource, $productDatastatus, $productFstf, $productFdate, $db)
    {
        $sql = "INSERT INTO AMS_PRODUCT
        (
            AMS_PRODUCT_ID,
            AMS_PRODUCT_NO,
            AMS_PRODUCT_NM,
            AMS_PRODUCT_QTY,
            AMS_PRODUCT_PRICE,
            AMS_PRODUCT_SDATE,
            AMS_PRODUCT_EXPDATE,
            AMS_PRODUCT_TYPE,
            AMS_PRODUCT_LCT,
            AMS_PRODUCT_LOC,
            AMS_PRODUCT_ST,
            AMS_PRODUCT_YEAR,
            AMS_PRODUCT_SOURCE,
            AMS_PRODUCT_DELST,
            AMS_PRODUCT_STF,
            AMS_PRODUCT_FDATE
        )
        VALUES
        (
            '$id',
            '$productNo',
            '$productName',
            '$productUnit',
            '$toSaveproductPrice',
            $TosaveProductSdate,
            $TosaveproductExpdate,
            '$productType',
            '$productLct',
            '$productLocation',
            '$productStatus',
            '$productYear',
            '$productSource',
            '$productDatastatus',
            '$productFstf',
            '$productFdate'
        )
        ";

        $query = $this->ConMySql()->query($sql);

        if ($query) {

            $mes = '1';
            $this->ConMySql()->commit();
        } else {

            $mes = '0';
            $this->ConMySql()->rollback();
        }
        // echo $sql;
        mysqli_close($this->ConMySql());
        return $mes;
    }

    public function InsertProductAddSet($id, $productNo, $productName, $productUnit, $toSaveproductPrice, $TosaveProductSdate, $TosaveproductExpdate, $productType, $productLct, $productLocation, $productStatus, $productYear, $productSource, $productDatastatus, $productFstf, $productFdate, $set, $db)
    {
        $sql = "INSERT INTO AMS_PRODUCT
        (
            AMS_PRODUCT_ID,
            AMS_PRODUCT_NO,
            AMS_PRODUCT_NM,
            AMS_PRODUCT_QTY,
            AMS_PRODUCT_PRICE,
            AMS_PRODUCT_SDATE,
            AMS_PRODUCT_EXPDATE,
            AMS_PRODUCT_TYPE,
            AMS_PRODUCT_LCT,
            AMS_PRODUCT_LOC,
            AMS_PRODUCT_ST,
            AMS_PRODUCT_YEAR,
            AMS_PRODUCT_SOURCE,
            AMS_PRODUCT_DELST,
            AMS_PRODUCT_STF,
            AMS_PRODUCT_FDATE,
            AMS_PRODUCT_SET
        )
        VALUES
        (
            '$id',
            '$productNo',
            '$productName',
            '$productUnit',
            '$toSaveproductPrice',
            $TosaveProductSdate,
            $TosaveproductExpdate,
            '$productType',
            '$productLct',
            '$productLocation',
            '$productStatus',
            '$productYear',
            '$productSource',
            '$productDatastatus',
            '$productFstf',
            '$productFdate',
            '$set'
        )
        ";

        $query = $this->ConMySql()->query($sql);

        if ($query) {

            $mes = '1';
            $this->ConMySql()->commit();
        } else {

            $mes = '0';
            $this->ConMySql()->rollback();
        }
        mysqli_close($this->ConMySql());
        return $mes;
    }

    public function UpdateProduct($IdProduct, $productNo, $productName2, $productUnit, $toSaveproductPrice, $TosaveProductSdate, $TosaveproductExpdate, $productType, $productLct, $productLocation, $productStatus, $productYear, $productSource, $productDatastatus, $productFstf, $productFdate, $db)
    {
        $sql = "UPDATE AMS_PRODUCT
        SET
        AMS_PRODUCT_NO = '$productNo',
        AMS_PRODUCT_NM = '$productName2',
        AMS_PRODUCT_QTY = '$productUnit',
        AMS_PRODUCT_PRICE = '$toSaveproductPrice',
        AMS_PRODUCT_SDATE = $TosaveProductSdate,
        AMS_PRODUCT_EXPDATE = $TosaveproductExpdate,
        AMS_PRODUCT_TYPE = '$productType',
        AMS_PRODUCT_LCT = '$productLct',
        AMS_PRODUCT_LOC = '$productLocation',
        AMS_PRODUCT_ST = '$productStatus',
        AMS_PRODUCT_YEAR = '$productYear',
        AMS_PRODUCT_SOURCE = '$productSource',
        AMS_PRODUCT_DELST = '$productDatastatus',
        AMS_PRODUCT_ESTF = '$productFstf',
        AMS_PRODUCT_EDATE = '$productFdate'
        WHERE AMS_PRODUCT_ID = '$IdProduct'
        ";

        $query = $this->ConMySql()->query($sql);

        if ($query) {

            $mes = '1';
            $this->ConMySql()->commit();
        } else {

            $mes = '0';
            $this->ConMySql()->rollback();
        }
        // echo $sql;
        mysqli_close($this->ConMySql());
        return $mes;
    }

    public function UpdateProductSet($idsetpdc, $setnm, $setno, $setqty, $toSaveproductPriceSet, $setTotal, $setyear, $setsource, $setlct, $setdatast, $setfstf, $setfdate, $productrubpid, $db)
    {
        $sql = "UPDATE AMS_PRODUCTSET SET
                AMS_PRODUCTSET_NM = '$setnm',
                AMS_PRODUCTSET_NO = '$setno',
                AMS_PRODUCTSET_QTY = '$setqty',
                AMS_PRODUCTSET_PRICE = '$toSaveproductPriceSet',
                AMS_PRODUCTSET_TOTAL = '$setTotal',
                AMS_PRODUCTSET_YEAR = '$setyear',
                AMS_PRODUCTSET_SOURCE = '$setsource',
                AMS_PRODUCTSET_LCT = '$setlct',
                AMS_PRODUCTSET_ST = '$setdatast',
                AMS_PRODUCTSET_ESTF = '$setfstf',
                AMS_PRODUCTSET_EDATE = '$setfdate',
                AMS_PRODUCTSET_RUB = $productrubpid
                WHERE AMS_PRODUCTSET_ID = '$idsetpdc'";

        $query = $this->ConMySql()->query($sql);

        if ($query) {

            $mes = '1';
            $this->ConMySql()->commit();
        } else {

            $mes = '0';
            $this->ConMySql()->rollback();
        }
        mysqli_close($this->ConMySql());
        return $mes;
    }

    public function UpdateProductToSets($idsetpdc, $IdProduct, $productNo, $productName2, $productUnit, $toSaveproductPrice, $TosaveProductSdate, $TosaveproductExpdate, $productType, $setlct, $productLocation, $productStatus, $setyear, $setsource, $productDatastatus, $setfstf, $setfdate, $db)
    {
        $sql = "UPDATE AMS_PRODUCT
            SET
            AMS_PRODUCT_NO = '$productNo',
            AMS_PRODUCT_NM = '$productName2',
            AMS_PRODUCT_QTY = '$productUnit',
            AMS_PRODUCT_PRICE = '$toSaveproductPrice',
            AMS_PRODUCT_SDATE = $TosaveProductSdate,
            AMS_PRODUCT_EXPDATE = $TosaveproductExpdate,
            AMS_PRODUCT_TYPE = '$productType',
            AMS_PRODUCT_LCT = '$setlct',
            AMS_PRODUCT_LOC = '$productLocation',
            AMS_PRODUCT_ST = '$productStatus',
            AMS_PRODUCT_YEAR = '$setyear',
            AMS_PRODUCT_SOURCE = '$setsource',
            AMS_PRODUCT_DELST = '$productDatastatus',
            AMS_PRODUCT_ESTF = '$setfstf',
            AMS_PRODUCT_EDATE = '$setfdate'
            WHERE AMS_PRODUCT_ID = '$IdProduct'
            AND AMS_PRODUCT_SET ='$idsetpdc'";

        $query = $this->ConMySql()->query($sql);

        if ($query) {

            $mes = '1';
            $this->ConMySql()->commit();
        } else {

            $mes = '0';
            $this->ConMySql()->rollback();
        }
        mysqli_close($this->ConMySql());
        return $mes;
    }

    public function UpdateStatusProductSet($IdProductset, $cntplusQTY, $priceall, $db)
    {
        $sql = "UPDATE AMS_PRODUCTSET SET AMS_PRODUCTSET_QTY ='$cntplusQTY',AMS_PRODUCTSET_TOTAL='$priceall' WHERE AMS_PRODUCTSET_ID = '$IdProductset'";

        $query = $this->ConMySql()->query($sql);

        if ($query) {

            $mes = '1';
            $this->ConMySql()->commit();
        } else {

            $mes = '0';
            $this->ConMySql()->rollback();
        }
        mysqli_close($this->ConMySql());
        return $mes;
    }


    public function UpdateStatusProduct($IdProductDel, $DelStatus, $Estf, $Edate, $db)
    {
        $sql = "UPDATE AMS_PRODUCT SET
        AMS_PRODUCT_DELST = '$DelStatus',
        AMS_PRODUCT_ESTF = '$Estf',
        AMS_PRODUCT_EDATE = '$Edate'
        WHERE AMS_PRODUCT_ID = '$IdProductDel'";

        $query = $this->ConMySql()->query($sql);

        if ($query) {

            $mes = '1';
            $this->ConMySql()->commit();
        } else {

            $mes = '0';
            $this->ConMySql()->rollback();
        }
        // echo $sql;
        mysqli_close($this->ConMySql());
        return $mes;
    }

    public function UpdateStatusProductDelset($DelStatus, $Estf, $Edate, $Setid, $db)
    {
        $sql = "UPDATE AMS_PRODUCT SET
        AMS_PRODUCT_DELST = '$DelStatus',
        AMS_PRODUCT_ESTF = '$Estf',
        AMS_PRODUCT_EDATE = '$Edate'
        WHERE AMS_PRODUCT_SET ='$Setid'";

        $query = $this->ConMySql()->query($sql);

        if ($query) {

            $mes = '1';
            $this->ConMySql()->commit();
        } else {

            $mes = '0';
            $this->ConMySql()->rollback();
        }
        mysqli_close($this->ConMySql());
        return $mes;
    }

    public function UpdateStatusDelsetMain($DelStatus, $Estf, $Edate, $Setid, $db)
    {
        $sql = "UPDATE AMS_PRODUCTSET SET 
        AMS_PRODUCTSET_ST = '$DelStatus',
        AMS_PRODUCTSET_ESTF = '$Estf',
        AMS_PRODUCTSET_EDATE = '$Edate'
        WHERE AMS_PRODUCTSET_ID = '$Setid'";

        $query = $this->ConMySql()->query($sql);

        if ($query) {

            $mes = '1';
            $this->ConMySql()->commit();
        } else {

            $mes = '0';
            $this->ConMySql()->rollback();
        }
        mysqli_close($this->ConMySql());
        return $mes;
    }


    public function UpdateSubSetPdc($SubsetNo, $SubsetName, $productFstf, $productFdate, $productDatastatus, $IdProductSubset, $db)
    {
        $sql = "UPDATE AMS_PRODUCTSUBSET SET 
        AMS_PRODUCTSUBSET_NO = '$SubsetNo',
        AMS_PRODUCTSUBSET_NM = '$SubsetName',
        AMS_PRODUCTSUBSET_ESTF = '$productFstf',
        AMS_PRODUCTSUBSET_EDATE = '$productFdate',
        AMS_PRODUCTSUBSET_DELST = '$productDatastatus'
        WHERE AMS_PRODUCTSUBSET_ID = '$IdProductSubset'";

        $query = $this->ConMySql()->query($sql);

        if ($query) {

            $mes = '1';
            $this->ConMySql()->commit();
        } else {

            $mes = '0';
            $this->ConMySql()->rollback();
        }
        mysqli_close($this->ConMySql());
        return $mes;
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

    public function UpdateKRP($IdProduct, $productLct, $productLocation, $productFstf, $productFdate)
    {
        $sql = "UPDATE AMS_PRODUCT SET
        AMS_PRODUCT_LCT = '$productLct',
        AMS_PRODUCT_LOC = '$productLocation',
        AMS_PRODUCT_ESTF = '$productFstf',
        AMS_PRODUCT_EDATE = '$productFdate'
        WHERE AMS_PRODUCT_ID ='$IdProduct'
        ";
        $query = $this->ConMySql()->query($sql);

        if ($query) {

            $mes = '1';
            $this->ConMySql()->commit();
        } else {

            $mes = '0';
            $this->ConMySql()->rollback();
        }
        mysqli_close($this->ConMySql());
        return $mes;
    }

    public function UpdateSetKRP($IdsetProduct, $productLct, $productFstf, $productFdate)
    {
        $sql = "UPDATE AMS_PRODUCTSET SET
        AMS_PRODUCTSET_LCT = '$productLct',
        AMS_PRODUCTSET_ESTF = '$productFstf',
        AMS_PRODUCTSET_EDATE = '$productFdate'
        WHERE AMS_PRODUCTSET_ID = '$IdsetProduct'
        ";
        $query = $this->ConMySql()->query($sql);

        if ($query) {

            $mes = '1';
            $this->ConMySql()->commit();
        } else {

            $mes = '0';
            $this->ConMySql()->rollback();
        }
        mysqli_close($this->ConMySql());
        return $mes;
    }


    public function strspace($data, $type)
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

    public function dateTosave($date)
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

    public function dateToThai($date)
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
