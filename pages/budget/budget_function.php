<?php
class BudgetResult
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

    function show_maxidNew($year, $db)
    {

        $sql = "SELECT max(AMS_BUDGET_ID) as MAX_ID FROM AMS_BUDGET  where AMS_BUDGET_ID like '$year%' ";
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

    function SumPriceAllBudget($id, $type, $db)
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


    function InsertBudgetYear($id, $yearbudget, $sourcebudget, $edubudget, $papedbudget, $toSaveprice, $statusbd, $fdate, $fstf, $etcbudget, $db)
    {


        $sql = "INSERT AMS_BUDGET 
        (
            AMS_BUDGET_ID,
            AMS_BUDGET_YEAR,
            AMS_BUDGET_SOURCE,
            AMS_BUDGET_CLASS,
            AMS_BUDGET_TYPE,
            AMS_BUDGET_AMOUNT,
            AMS_BUDGET_ETC,
            AMS_BUDGET_ST,
            AMS_BUDGET_STF,
            AMS_BUDGET_FDATE

        )
        VALUES
        (
            '$id',
            '$yearbudget',
            '$sourcebudget',
            '$edubudget',
            '$papedbudget',
            '$toSaveprice',
            '$etcbudget',
            '$statusbd',
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

    function ListBudgetAll($db, $year, $source, $edu, $type, $status)
    {

        if ($year != "") {
            $yearTosql = "AND AMS_BUDGET_YEAR = '$year'";
        } else {
            $yearTosql = "";
        }

        if ($source != "") {
            $sourceTosql = "AND AMS_BUDGET_SOURCE = '$source'";
        } else {
            $sourceTosql = "";
        }

        if ($edu != "") {
            $eduTosql = "AND AMS_BUDGET_CLASS = '$edu'";
        } else {
            $eduTosql = "";
        }

        if ($type != "") {
            $typeTosql = "AND AMS_BUDGET_TYPE = '$type'";
        } else {
            $typeTosql = "";
        }
        if ($status != "") {
            $statusTosql = "AND AMS_BUDGET_ST = '$status'";
        } else {
            $statusTosql = "";
        }

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
        WHERE AMS_BUDGET_ST != '99'
        $yearTosql
        $sourceTosql
        $eduTosql
        $typeTosql
        $statusTosql
        ORDER BY AMS_BUDGET_YEAR ASC";
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

    function ListBudgetAllBins($db)
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
        WHERE AMS_BUDGET_ST = '99'
        ORDER BY AMS_BUDGET_YEAR ASC";
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

    function EditResultBudget($id, $db)
    {

        $sql = "SELECT AMS_BUDGET_ID,AMS_BUDGET_YEAR,AMS_BUDGET_SOURCE,AMS_BUDGET_CLASS,AMS_BUDGET_TYPE,AMS_BUDGET_AMOUNT,AMS_BUDGET_ETC,AMS_BUDGET_STF,AMS_BUDGET_ST
        FROM AMS_BUDGET
        WHERE AMS_BUDGET_ID = '$id'";
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



    function UpdateBudgetYear($id, $yearbudget, $sourcebudget, $edubudget, $papedbudget, $toSaveprice, $statusbd, $fdate, $fstf, $etcbudget, $db)
    {


        $sql = "UPDATE AMS_BUDGET
        SET 
        AMS_BUDGET_YEAR = '$yearbudget',
        AMS_BUDGET_SOURCE = '$sourcebudget',
        AMS_BUDGET_CLASS = '$edubudget',
        AMS_BUDGET_TYPE = '$papedbudget',
        AMS_BUDGET_AMOUNT = '$toSaveprice',
        AMS_BUDGET_ETC = '$etcbudget',
        AMS_BUDGET_ST = '$statusbd',
        AMS_BUDGET_ESTF = '$fstf',
        AMS_BUDGET_EDATE = '$fdate'
        WHERE
        AMS_BUDGET_ID = '$id'";


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

    function DelBudgetYear($id, $statusbd, $fdate, $fstf, $db)
    {


        $sql = "UPDATE AMS_BUDGET 
        SET 
        AMS_BUDGET_ST = '$statusbd',
        AMS_BUDGET_ESTF = '$fstf',
        AMS_BUDGET_EDATE = '$fdate'
        WHERE AMS_BUDGET_ID = '$id'";

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
