$(document).ready(function () {
    //เลือกปีงบ
    $("#txtyearatc").change(function () {
        $.ajax({
            type: "POST",
            url: "https://mct-system.com/pages/article/article_ajaxYearBudgets.php",
            cache: false,
            data: { txtyearatc: $(this).val() },
            success: function (html) {
                $("#txtsourceatc").html(html);
            },
        });
        return false;
    });

    // วันที่
    $(function () {
        $("#txtfdate").datepicker({
            language: "th-th",
            format: "dd/mm/yyyy",
            autoclose: true,
        });

        $("#txtldate").datepicker({
            language: "th-th",
            format: "dd/mm/yyyy",
            autoclose: true,
        });

        $("#txtsucessdate").datepicker({
            language: "th-th",
            format: "dd/mm/yyyy",
            autoclose: true,
        });

    });


});