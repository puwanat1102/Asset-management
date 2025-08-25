<?php
// $_SESSION['chkDup'] = '0';
// include 'product_function.php';
// $ProductEdit = new ProductResult();
// $DeprList = $ProductEdit->Deprlist($db);



?>

<script>
    $(document).ready(function() {



        $("#rowadd-button").on("click", function() {
            let i = $(".tblfood").closest("tbody").find("tr").length;
            i++;
            let price = $('#txtsetprice').val();
            $("#bodyTableAddFood").append(
                "<tr class='del'><td><div class='row gy-4'><h5>รายการที่ [" + i + "]</h5><div class='col-xxl-6 col-md-6'><div><label for='txtproductsubno" + i + "' class='form-label'><b>เลขทะเบียนครุภัณฑ์ย่อย</b></label><input type='hidden' name='idpdcchk2[]' class='chkclass2' value='null'><input type='text' class='required form-control' id='txtproductsubno" + i + "' name='txtproductsubno[]' required='required' maxlength='30'></div></div><div class='col-xxl-6 col-md-6'><div><label for='txtproductsubname" + i + "' class='form-label'><b>ชื่อครุภัณฑ์ย่อย</b></label><input type='text' class='required form-control' name='txtproductsubname[]' required='required' maxlength='200'></div></div><hr/></td></tr>"
            );
            $('#txtsetunit').val($(".tblfood").closest("tbody").find("tr").length);

        });




        // let i = 0;
        $("#rowall-button2").on("click", function() {
            // i++;
            let cnt = $('#txtsetunit').val();
            let price = $('#txtsetprice').val();

            if ($(".tblfood").closest("tbody").find("tr").length > 0) {

                $(".tblfood").closest("tbody").find("tr").remove();
                $('#txtsetunit').val(0);
            } else {

                for (let i = 1; i <= cnt; i++) {

                    $("#bodyTableAddFood").append(
                        "<tr class='del'><td><div class='row gy-4'><h5>รายการที่ [" + i + "]</h5><div class='col-xxl-6 col-md-6'><div><label for='txtproductno" + i + "' class='form-label'><b>เลขทะเบียนครุภัณฑ์</b></label><input type='text' class='required form-control chkpdcno' id='txtproductno" + i + "' name='txtproductno[]' required='required' maxlength='30'></div></div><div class='col-xxl-6 col-md-6'><div><label for='txtproductname" + i + "' class='form-label'><b>ชื่อครุภัณฑ์</b></label><input type='text' class='required form-control' name='txtproductname[]' required='required' maxlength='200'></div></div><div class='col-xxl-3 col-md-6'><div><label for='txtunit" + i + "' class='form-label'><b>หน่วยนับ</b></label><input type='text' class='required form-control' name='txtunit[]' required='required' maxlength='10'></div></div><div class='col-xxl-3 col-md-6'><div><label for='txtprice" + i + "' class='form-label'><b>ราคา</b></label><input type='text' class='required form-control' required='required' value='" + price + "' name='txtprice[]' id='txtprice" + i + "' data-type='currency2' readonly ></div></div><div class='col-xxl-3 col-md-6'><div><label for='txtproductype" + i + "' class='form-label'><b>ประเภทของครุภัณฑ์</b></label><select class='required form-select js-example-basic-single' id='txtproductype" + i + "' name='txtproductype[]' style='width: 100%; height:36px;' required><option  value=''>เลือกประเภทของครุภัณฑ์</option><?php foreach ($DeprList as $key_depr => $value_depr) { ?><option value='<?php echo $value_depr['AMS_DEPRECIATION_ID']; ?>'><?php echo $value_depr['AMS_DEPRECIATION_TYPE']; ?></option><?php } ?></select></div></div><div class='col-xxl-3 col-md-6'><div><label for='txtlocation" + i + "' class='form-label'><b>สถานที่จัดเก็บ</b></label><input type='text' class='required form-control' name='txtlocation[]' required='required' maxlength='100'></div></div></div><hr/></td></tr>"
                    );

                }

            }

        });

        $("#rowall-button").on("click", function() {

            // i++;
            let cnt = $('#txtsetunit').val();
            let pdcid = $('#txtproductsetno').val();
            let pdcnm = $('#txtproductsetname').val();
            let price = $('#txtsetprice').val();
            let sdate = $('#txtsdate').val();
            let expdate = $('#txtexpdate').val();
            let lctrub = $('#txtlctpdcset').val();
            let pdcst = $('#txtstatusproductset').val();
            let year = $('#txtyearatc').val();
            let source = $('#txtsourceatc').val();

            if (pdcid != "" && cnt != "" && pdcnm != "" && price != "" && sdate != "" && expdate != "" && lctrub != "" && pdcst != "" && year != "" && source != "") {

                for (let i = 1; i <= cnt; i++) {


                    $("#bodyTableAddFood").append(
                        "<tr class='del'><td><div class='row gy-4'><h5>รายการที่ [" + i + "]</h5><div class='col-xxl-6 col-md-6'><div><label for='txtproductno" + i + "' class='form-label'><b>เลขทะเบียนครุภัณฑ์</b></label><input type='text' class='required form-control chkpdcno' id='txtproductno" + i + "' name='txtproductno[]' required='required' maxlength='30'></div></div><div class='col-xxl-6 col-md-6'><div><label for='txtproductname" + i + "' class='form-label'><b>ชื่อครุภัณฑ์</b></label><input type='text' class='required form-control' name='txtproductname[]' required='required' maxlength='200'></div></div><div class='col-xxl-3 col-md-6'><div><label for='txtunit" + i + "' class='form-label'><b>หน่วยนับ</b></label><input type='text' class='required form-control' name='txtunit[]' required='required' maxlength='10'></div></div><div class='col-xxl-3 col-md-6'><div><label for='txtprice" + i + "' class='form-label'><b>ราคา</b></label><input type='text' class='required form-control' required='required'  name='txtprice[]' id='txtprice" + i + "' data-type='currency2' ></div></div><div class='col-xxl-3 col-md-6'><div><label for='txtproductype" + i + "' class='form-label'><b>ประเภทของครุภัณฑ์</b></label><select class='required form-select js-example-basic-single' id='txtproductype" + i + "' name='txtproductype[]' style='width: 100%; height:36px;' required><option  value=''>เลือกประเภทของครุภัณฑ์</option><?php foreach ($DeprList as $key_depr => $value_depr) { ?><option value='<?php echo $value_depr['AMS_DEPRECIATION_ID']; ?>'><?php echo $value_depr['AMS_DEPRECIATION_TYPE']; ?></option><?php } ?></select></div></div><div class='col-xxl-3 col-md-6'><div><label for='txtlocation" + i + "' class='form-label'><b>สถานที่จัดเก็บ</b></label><input type='text' class='required form-control' name='txtlocation[]' required='required' maxlength='100'></div></div></div><hr/></td></tr><tr><td><div class='col-xxl-12 col-md-12 text-left'></div><div class='col-xxl-12 col-md-12' id='InputSet" + i + "'><?php include './pages/products/product_addsubsetInset.php'; ?> </div></td></tr>"
                    );

                    $("#btnaddsub"+i+"").on("click", function() {
                        let cntsub = $("#cntsub"+i+"").val();
                        // for (let ii = 1; ii <= cntsub; ii++) {
                            $("#tbodysubset"+i+"").append(
                                "<tr class='del2'><td><div class='row gy-4'><h5></h5><div class='col-xxl-6 col-md-6'><div><label  class='form-label'><b>เลขทะเบียนครุภัณฑ์ย่อย</b></label><input type='hidden' name='idpdcchk[]' class='chkclass' value='null'><input type='text' class='required form-control'  name='txtproductsubno[]' required='required' maxlength='30'></div></div><div class='col-xxl-6 col-md-6'><div><label  class='form-label'><b>ชื่อครุภัณฑ์ย่อย</b></label><input type='text' class='required form-control' name='txtproductsubname[]' required='required' maxlength='200'><input type='hidden' class='required form-control' name='txtchksubandpdc[]' value='"+i+"' maxlength='200'></div></div><hr/></td></tr>"
                            );
                        // }
                    });

                    $("#btndelsub"+i+"").on("click", function() {
                        $(".tblsubset tr:last").remove();
                    });

                }
                $("#warningval").hide();
                $("#addsetall").hide();
                $("#editset").show();
                $("#txtsetunit").prop('readonly', true);
                $("#txtproductsetno").prop('readonly', true);
                $("#txtproductsetname").prop('readonly', true);
                $("#txtsetprice").prop('readonly', true);
                $("#txtsdate").prop('readonly', true);
                $("#txtexpdate").prop('readonly', true);
                $("#txtlctpdcset").prop('readonly', true);
                $("#txtstatusproductset").prop('readonly', true);
                $("#txtyearatc").prop('readonly', true);
                $("#txtsourceatc").prop('readonly', true);


            } else {
                $("#warningval").show();
            }

        });

        $("#rowedit-button").on("click", function() {

            $("#txtsetunit").prop('readonly', false);
            $("#txtproductsetno").prop('readonly', false);
            $("#txtproductsetname").prop('readonly', false);
            $("#txtsetprice").prop('readonly', false);
            $("#txtsdate").prop('readonly', false);
            $("#txtexpdate").prop('readonly', false);
            $("#txtlctpdcset").prop('readonly', false);
            $("#txtstatusproductset").prop('readonly', false);
            $("#txtyearatc").prop('readonly', false);
            $("#txtsourceatc").prop('readonly', false);
            $("#addsetall").show();
            $("#editset").hide();
            $(".tblfood").closest("tbody").find("tr").remove();

        });

        // $("#removeall-button").on("click", function() {

        //         $(".tblfood").remove();
        //         $('#txtsetunit').val(0);
        //         i--;             
        // });


        $("#row-button").on("click", function() {
            let i = $(".tblfood").closest("tbody").find("tr").length;
            i++;
            let price = $('#txtsetprice').val();
            $("#bodyTableAddFood").append(
                "<tr class='del'><td><div class='row gy-4'><h5>รายการที่ [" + i + "]</h5><div class='col-xxl-6 col-md-6'><div><label for='txtproductno" + i + "' class='form-label'><b>เลขทะเบียนครุภัณฑ์</b></label><input type='text' class='required form-control' id='txtproductno" + i + "' name='txtproductno[]' required='required' maxlength='30'></div></div><div class='col-xxl-6 col-md-6'><div><label for='txtproductname" + i + "' class='form-label'><b>ชื่อครุภัณฑ์</b></label><input type='text' class='required form-control' name='txtproductname[]' required='required' maxlength='200'></div></div><div class='col-xxl-3 col-md-6'><div><label for='txtunit" + i + "' class='form-label'><b>หน่วยนับ</b></label><input type='text' class='required form-control' name='txtunit[]' required='required' maxlength='10'></div></div><div class='col-xxl-3 col-md-6'><div><label for='txtprice" + i + "' class='form-label'><b>ราคา</b></label><input type='text' class='required form-control' required='required' value='" + price + "' name='txtprice[]' id='txtprice" + i + "' data-type='currency2' readonly ></div></div><div class='col-xxl-3 col-md-6'><div><label for='txtproductype" + i + "' class='form-label'><b>ประเภทของครุภัณฑ์</b></label><select class='required form-select js-example-basic-single' id='txtproductype" + i + "' name='txtproductype[]' style='width: 100%; height:36px;' required><option  value=''>เลือกประเภทของครุภัณฑ์</option><?php foreach ($DeprList as $key_depr => $value_depr) { ?><option value='<?php echo $value_depr['AMS_DEPRECIATION_ID']; ?>'><?php echo $value_depr['AMS_DEPRECIATION_TYPE']; ?></option><?php } ?></select></div></div><div class='col-xxl-3 col-md-6'><div><label for='txtlocation" + i + "' class='form-label'><b>สถานที่จัดเก็บ</b></label><input type='text' class='required form-control' name='txtlocation[]' required='required' maxlength='100'></div></div></div><hr/></td></tr>"
            );
            $('#txtsetunit').val($(".tblfood").closest("tbody").find("tr").length);
        });




        $("#remove-button").on("click", function() {
            // $("#exp02TBody").closest().remove();
            // $(this).closest('.del').remove();

            // $(this).closest('tr').remove();
            // console.log('remove');
            // if ($(".tblfood").closest("tbody").find("tr").length == 1) {
            // alert('cannot delete last row');
            //} else {
            $(".tblfood tr:last").remove();
            $('#txtsetunit').val($(".tblfood").closest("tbody").find("tr").length);
            i--;
            // console.log(i);
            //}
        });



        $("#txtsetunit, #txtsetprice").on("input", function() {
            var unit = parseFloat($("#txtsetunit").val());
            var bath = parseFloat($("#txtsetprice").val());
            var Allprice = bath * unit;
            $("#txtsetpriceall").val(parseFloat(Allprice).toFixed(2));
        });

        $("#removesubset-button").on("click", function() {
            let classchk = $(".tblfood").closest("tbody").find("input[class='chkclass2']").val();
            if (classchk == 'null') {
                $(".tblfood tr:last").remove();
                $('#txtsetunit').val($(".tblfood").closest("tbody").find("tr").length);
            } else {

            }

            //$(".tblfood tr:last").remove();
            //   alert($(".tblfood").closest("tbody").find("input[class='chkclass']").val());

            return;

        });




    });
</script>