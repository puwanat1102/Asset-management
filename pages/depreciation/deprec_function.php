<?php

class DeprecResult
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

    public function DeprceList($type,$time,$st,$db)
    {

        if($type != ""){
            $sqlType = "AND AMS_DEPRECIATION_TYPE LIKE '%$type%'";
        }else{

            $sqlType = "";
        }

        if($time != ""){
            $sqlTime = "AND AMS_DEPRECIATION_YEAR = '$time'";
        }else{

            $sqlTime = "";
        }

        if($st != ""){
            $sqlst = "AND AMS_DEPRECIATION_ST = '$st'";
        }else{

            $sqlst = "";
        }

        $sql = "SELECT AMS_DEPRECIATION_ID,
        AMS_DEPRECIATION_TYPE,
        AMS_DEPRECIATION_YEAR,
        AMS_DEPRECIATION_RATE,
        AMS_DEPRECIATION_ST
         FROM AMS_DEPRECIATION 
         WHERE AMS_DEPRECIATION_ST != '99'
         $sqlType
         $sqlTime
         $sqlst
         ORDER BY AMS_DEPRECIATION_ID ASC";

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

    public function DeprceListDel($db)
    {

        $sql = "SELECT AMS_DEPRECIATION_ID,
        AMS_DEPRECIATION_TYPE,
        AMS_DEPRECIATION_YEAR,
        AMS_DEPRECIATION_RATE,
        AMS_DEPRECIATION_ST
         FROM AMS_DEPRECIATION 
         WHERE AMS_DEPRECIATION_ST = '99'
         ORDER BY AMS_DEPRECIATION_ID ASC";

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

        $sql = "SELECT max(AMS_DEPRECIATION_ID) as MAX_ID FROM AMS_DEPRECIATION  where AMS_DEPRECIATION_ID like '$year%' ";
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

    function ResultEditDeprec($id, $db)
    {

        $sql = "SELECT AMS_DEPRECIATION_ID,
        AMS_DEPRECIATION_TYPE,
        AMS_DEPRECIATION_YEAR,
        AMS_DEPRECIATION_RATE,
        AMS_DEPRECIATION_ST
         FROM AMS_DEPRECIATION 
         WHERE AMS_DEPRECIATION_ST != '99'
         AND AMS_DEPRECIATION_ID= '$id'
         ORDER BY AMS_DEPRECIATION_ID ASC";
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

    function InsertDepre($id, $protypesave, $protim, $derate, $destatus, $fstf, $fdate, $db)
    {
        $sql = "INSERT AMS_DEPRECIATION 
        (
            AMS_DEPRECIATION_ID,
            AMS_DEPRECIATION_TYPE,
            AMS_DEPRECIATION_YEAR,
            AMS_DEPRECIATION_RATE,
            AMS_DEPRECIATION_ST,
            AMS_DEPRECIATION_STF,
            AMS_DEPRECIATION_FDATE
        )
        VALUES
        (
            '$id',
            '$protypesave',
            '$protim',
            '$derate',
            '$destatus',
            '$fstf',
            '$fdate'
        )";
        // $query = mysqli_query($conn,$sql);
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

    function UpdateDeprec($id, $protypesave, $protim, $derate, $destatus, $fstf, $fdate, $db)
    {
        $sql = "UPDATE AMS_DEPRECIATION  
        SET        
            AMS_DEPRECIATION_TYPE = '$protypesave',
            AMS_DEPRECIATION_YEAR = '$protim',
            AMS_DEPRECIATION_RATE = '$derate',
            AMS_DEPRECIATION_ST = '$destatus',
            AMS_DEPRECIATION_ESTF = '$fstf',
            AMS_DEPRECIATION_EDATE = '$fdate' 
       WHERE 
        AMS_DEPRECIATION_ID = '$id'
        ";
        // $query = mysqli_query($conn,$sql);
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

    function UpdateDeprecDel($id,$destatus, $fstf, $fdate, $db)
    {
        $sql = "UPDATE AMS_DEPRECIATION  
        SET        
            AMS_DEPRECIATION_ST = '$destatus',
            AMS_DEPRECIATION_ESTF = '$fstf',
            AMS_DEPRECIATION_EDATE = '$fdate' 
       WHERE 
        AMS_DEPRECIATION_ID = '$id'
        ";
        // $query = mysqli_query($conn,$sql);
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
