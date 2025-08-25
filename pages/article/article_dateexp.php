
<?php
if ($AtcexpdateST == '0') {
?>

    <script>
        $("#txtexpdatewar").datepicker({
            language: "th-th",
            format: "dd/mm/yyyy",
            autoclose: true,
            startDate: new Date(),
            //endDate: new Date() 
        });

        $("#txtexpdatewar2").datepicker({
            language: "th-th",
            format: "dd/mm/yyyy",
            autoclose: true,
            startDate: new Date(),
            //endDate: new Date()
        });
    </script>

<?php
} elseif ($AtcexpdateST == '1') {
?>
    <script>
        $("#txtexpdatewar").datepicker({
            language: "th-th",
            format: "dd/mm/yyyy",
            autoclose: true,
            // startDate: new Date(),
            endDate: new Date()
        });

        $("#txtexpdatewar2").datepicker({
            language: "th-th",
            format: "dd/mm/yyyy",
            autoclose: true,
            // startDate: new Date(),
            endDate: new Date()
        });
    </script>

<?php
} elseif ($AtcexpdateST == '2') {
} elseif ($AtcexpdateST == '3') {
?>

    <script>
        $("#txtexpdatewar").datepicker({
            language: "th-th",
            format: "dd/mm/yyyy",
            autoclose: true,

        });

        $("#txtexpdatewar2").datepicker({
            language: "th-th",
            format: "dd/mm/yyyy",
            autoclose: true,

        });
    </script>

<?php
}
?>