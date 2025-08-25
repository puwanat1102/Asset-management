<?php
class ArticleResult
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

    public function ArticleList($atcname, $atctype, $atcyear, $atcsource, $fdate, $ldate, $atcstatus, $db)
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
        if ($fdate != "" && $ldate != "") {
            $sqlqtcexpdate = "AND  (AMS_ARTICLE_EXPDATE BETWEEN '$fdate' AND '$ldate')";
        } else {
            if ($fdate != "") {
                $sqlqtcexpdate = "AND  (AMS_ARTICLE_EXPDATE BETWEEN '$fdate' AND '$fdate')";
            } else {
                $sqlqtcexpdate = "";
            }
        }
        if ($atcstatus != "") {
            $sqlqtst = "AND AMS_ARTICLE_ST = '$atcstatus'";
        } else {
            $sqlqtst = "";
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
        $sqlqtcexpdate
        $sqlqtst
        ORDER BY AMS_ARTICLE_ID ASC";
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


    public function ListArticleAllBins($db)
    {
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
        WHERE AMS_ARTICLE_ST = '99'
        ORDER BY AMS_ARTICLE_ID ASC";
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

    public function ListArticleAllWarranty($expST, $fdate, $ldate, $atcstatus, $db)
    {
        $expNow = date('Y-m-d');
        $expMonth = date('m');
        $expYear = date('Y');

        if ($expST == '0') {
            $sqlexpst = "AND AMS_ARTICLE_EXPDATE >= '$expNow'";
        } elseif ($expST == '1') {
            $sqlexpst = "AND AMS_ARTICLE_EXPDATE < '$expNow'";
        } elseif ($expST == '2') {
            $sqlexpst = "AND MONTH(AMS_ARTICLE_EXPDATE) = '$expMonth' AND YEAR(AMS_ARTICLE_EXPDATE) = '$expYear'";
        } elseif ($expST == '3') {
            $sqlexpst = "";
        }

        if ($fdate != "" && $ldate != "") {
            $sqlqtcexpdate = "AND  (AMS_ARTICLE_EXPDATE BETWEEN '$fdate' AND '$ldate')";
        } else {
            if ($fdate != "") {
                $sqlqtcexpdate = "AND  (AMS_ARTICLE_EXPDATE BETWEEN '$fdate' AND '$fdate')";
            } else {
                $sqlqtcexpdate = "";
            }
        }
        if ($atcstatus != "") {
            $sqlqtst = "AND AMS_ARTICLE_ST = '$atcstatus'";
        } else {
            $sqlqtst = "";
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
        $sqlexpst
        $sqlqtcexpdate
        $sqlqtst
        ORDER BY AMS_ARTICLE_EXPDATE ASC";
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

    public function ResultEditAtc($id, $db)
    {
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
        AMS_BUDGET_AMOUNT,
        AMS_BUDGET_TYPE,
        AMS_ARTICLE_LCT,
        AMS_LCT_NM,
        AMS_ARTICLE_BALANCE,
        AMS_ARTICLE_DBL,
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

    public function DetailBudgets($year, $db)
    {
        $sql = "SELECT AMS_BUDGET_ID,
        AMS_BUDGET_YEAR,
        AMS_BUDGET_SOURCE,
        CASE
            WHEN AMS_BUDGET_SOURCE = 101 THEN 'งบรายได้ '
            WHEN AMS_BUDGET_SOURCE = 102 THEN 'งบรายจ่าย '
            WHEN AMS_BUDGET_SOURCE = 103 THEN 'งบอื่นๆ '
        ELSE '' END AS AMS_BUDGET_SOURCENM,
        AMS_BUDGET_CLASS,
        CASE 
            WHEN AMS_BUDGET_CLASS = 201 THEN 'ปริญญาตรี '
            WHEN AMS_BUDGET_CLASS = 202 THEN 'ปริญญาโท '
            WHEN AMS_BUDGET_CLASS = 203 THEN 'ปริญญาเอก '
        ELSE '' END AS AMS_BUDGET_CLASSNM ,
        AMS_BUDGET_TYPE,
        CASE 
            WHEN AMS_BUDGET_TYPE = 301 THEN 'ภาคปกติ'
            WHEN AMS_BUDGET_TYPE = 302 THEN 'ภาคพิเศษ'
        ELSE '' END AS AMS_BUDGET_TYPENM,
        AMS_BUDGET_AMOUNT
        FROM AMS_BUDGET
        WHERE AMS_BUDGET_YEAR = '$year'
        AND AMS_BUDGET_ST = '10'
        ORDER BY AMS_BUDGET_ID ASC";
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

        $sql = "SELECT max(	AMS_ARTICLE_ID) as MAX_ID FROM AMS_ARTICLE  where 	AMS_ARTICLE_ID like '$year%' ";
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

    function InsertArticle($id, $Atcnamesave, $Atctype, $Atccnt, $Atcunit, $toSaveAtcprice, $Tosaveexpdate, $Atcyear, $Atcsource, $Atclct, $Atcbalance, $Tosavebalance, $Atcstatus, $Atcfdate, $Atcfstf, $TosavepriceAll, $db)
    {
        $sql = "INSERT INTO AMS_ARTICLE 
        (
            AMS_ARTICLE_ID,
            AMS_ARTICLE_NM,
            AMS_ARTICLE_TYPE,
            AMS_ARTICLE_QTY,
            AMS_ARTICLE_UNIT,
            AMS_ARTICLE_PRICE,
            AMS_ARTICLE_PRICEALL,
            AMS_ARTICLE_EXPDATE,
            AMS_ARTICLE_YEAR,
            AMS_ARTICLE_SOURCE,
            AMS_ARTICLE_LCT,
            AMS_ARTICLE_BALANCE,
            AMS_ARTICLE_DBL,
            AMS_ARTICLE_ST,
            AMS_ARTICLE_FDATE,
            AMS_ARTICLE_STF
        )
        VALUES
        (
            '$id',
            '$Atcnamesave',
            '$Atctype',
            '$Atccnt',
            '$Atcunit',
            '$toSaveAtcprice',
            '$TosavepriceAll',
            '$Tosaveexpdate',
            '$Atcyear',
            '$Atcsource',
            '$Atclct',
            $Atcbalance,
            $Tosavebalance,
            '$Atcstatus',
            '$Atcfdate',
            '$Atcfstf'
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

    function UpdateArticle($id, $Atcnamesave, $Atctype, $Atccnt, $Atcunit, $toSaveAtcprice, $Tosaveexpdate, $Atcyear, $Atcsource, $Atclct, $Atcbalance, $Tosavebalance, $Atcstatus, $Atcfdate, $Atcfstf, $TosavepriceAll, $db)
    {
        $sql = "UPDATE AMS_ARTICLE SET
        AMS_ARTICLE_NM = '$Atcnamesave',
        AMS_ARTICLE_TYPE = '$Atctype',
        AMS_ARTICLE_QTY = '$Atccnt',
        AMS_ARTICLE_UNIT = '$Atcunit',
        AMS_ARTICLE_PRICE = '$toSaveAtcprice',
        AMS_ARTICLE_PRICEALL = '$TosavepriceAll',
        AMS_ARTICLE_EXPDATE = '$Tosaveexpdate',
        AMS_ARTICLE_YEAR = '$Atcyear',
        AMS_ARTICLE_SOURCE = '$Atcsource',
        AMS_ARTICLE_LCT = '$Atclct',
        AMS_ARTICLE_BALANCE = $Atcbalance,
        AMS_ARTICLE_DBL = $Tosavebalance,
        AMS_ARTICLE_ST = '$Atcstatus',
        AMS_ARTICLE_EDATE = '$Atcfdate',
        AMS_ARTICLE_ESTF = '$Atcfstf'
        WHERE AMS_ARTICLE_ID = '$id'";

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

    function DelArticle($iddel, $statusdel, $deldate, $delstf, $db)
    {

        $sql = "UPDATE AMS_ARTICLE SET
        AMS_ARTICLE_ST = '$statusdel',
        AMS_ARTICLE_EDATE = '$deldate',
        AMS_ARTICLE_ESTF = '$delstf'
        WHERE AMS_ARTICLE_ID = '$iddel'";

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

    public function CountATCToDisplay($status){

        if($status == '100'){
            $sql = "SELECT count(AMS_ARTICLE_ID) AS CNTATC
            FROM AMS_ARTICLE 
            WHERE AMS_ARTICLE_ST != '99'";
        }else{
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

    public function UpdateKRP($idatc, $Atcbalance, $Tosavebalance, $Atcfstf, $Atcfdate)
    {

        $sql = "UPDATE AMS_ARTICLE SET
        AMS_ARTICLE_BALANCE = $Atcbalance,
        AMS_ARTICLE_DBL = $Tosavebalance,
        AMS_ARTICLE_ESTF = '$Atcfstf',
        AMS_ARTICLE_EDATE = '$Atcfdate'
        WHERE AMS_ARTICLE_ID = '$idatc'";

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
}
// $db->close();
