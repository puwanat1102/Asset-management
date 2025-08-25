<script>
    $(document).ready(function() {

        $("#row-buttoned").on("click", function() {
            let i = $(".tblfood").closest("tbody").find("tr").length;
            // let price = $('#txtsetprice').val();
            i++;

            $("#bodyTableAddFood").append(
                "<tr class='del'><td><div class='row gy-4'><h5>รายการที่ [" + i + "]</h5><div class='col-xxl-6 col-md-6'><input type='hidden' name='idpdcchk[]' class='chkclass' value='null'><div><label for='txtproductno" + i + "' class='form-label'><b>เลขทะเบียนครุภัณฑ์</b></label><input type='text' class='required form-control'  id='txtproductno" + i + "' name='txtproductno[]' required='required' maxlength='30'></div></div><div class='col-xxl-6 col-md-6'><div><label for='txtproductname" + i + "' class='form-label'><b>ชื่อครุภัณฑ์</b></label><input type='text' class='required form-control' name='txtproductname[]' required='required' maxlength='200'></div></div><div class='col-xxl-3 col-md-6'><div><label for='txtunit" + i + "' class='form-label'><b>หน่วยนับ</b></label><input type='text' class='required form-control' name='txtunit[]' required='required' maxlength='10'></div></div><div class='col-xxl-3 col-md-6'><div id='pcddiv"+i+"'><label for='txtprice" + i + "' class='form-label'><b>ราคา</b></label><input type='text' class='required form-control price' required='required'  name='txtprice[]' id='txtprice" + i + "' data-type='currency2' ></div></div><div class='col-xxl-3 col-md-6'><div><label for='txtproductype" + i + "' class='form-label'><b>ประเภทของครุภัณฑ์</b></label><select class='required form-select js-example-basic-single' id='txtproductype" + i + "' name='txtproductype[]' style='width: 100%; height:36px;' required><option value=''>เลือกประเภทของครุภัณฑ์</option><?php foreach ($DeprList as $key_depr => $value_depr) { ?><option value='<?php echo $value_depr['AMS_DEPRECIATION_ID']; ?>'><?php echo $value_depr['AMS_DEPRECIATION_TYPE']; ?></option><?php } ?></select></div></div><div class='col-xxl-3 col-md-6'><div><label for='txtlocation" + i + "' class='form-label'><b>สถานที่จัดเก็บ</b></label><input type='text' class='required form-control' name='txtlocation[]' required='required' maxlength='100'></div></div><div class='col-xxl-3 col-md-6'><div><label for='txtstatusproductset" + i + "' class='form-label'><b>สถานะครุภัณฑ์</b></label><select class='required form-select' id='txtstatusproductset" + i + "' name='txtstatusproductset[]' style='width: 100%; height:36px;' required><option value=''>เลือกสถานะครุภัณฑ์</option><option value='10'>ปกติ</option><option value='20'>เสีย</option><option value='30'>รอแทงจำหน่าย</option><option value='40'>แทงจำหน่าย/ตัดออกจากบัญชี</option></select></div></div><div class='col-xxl-2 col-md-6'><div><label for='txtpdcsetstlist" + i + "' class='form-label'><b>สถานะของข้อมูล</b></label><select class='required form-select' id='txtpdcsetstlist" + i + "' name='txtpdcsetstlist[]' style='width: 100%; height:36px;' required><option value='10'>ใช้งาน</option><option value='20'>แบบร่าง</option></select></div></div><hr /></td><td></td> </tr>"
            );
            $('#txtsetunit').val($(".tblfood").closest("tbody").find("tr").length);
            
            return;
        });

        $("#exp02Table").on('click', '.btnDelete', function() {
            // let i = $(".tblfood").closest("tbody").find("tr").length;
            $(this).closest('tr').remove();
            // i--;
            // console.log(i);
            return;
        });

        $("#remove-button").on("click", function() {
            let classchk = $(".tblfood").closest("tbody").find("input[class='chkclass']").val();
            if(classchk == 'null'){
                $(".tblfood tr:last").remove();  
                $('#txtsetunit').val($(".tblfood").closest("tbody").find("tr").length);
            }else{

            }
            
                 //$(".tblfood tr:last").remove();
            //   alert($(".tblfood").closest("tbody").find("input[class='chkclass']").val());

                return;

        });


        $("#price-buttoned").on("click", function() {

            let alltr = $(".tblfood").closest("tbody").find("tr").length;
            let allpricechange = $('#txtsetprice').val();
            for (let index = 1; index <= alltr; index++) {
                $("#pcddiv"+index+"").find('.price').val(allpricechange);
            }
           
           
           
           return;

        });


        $("#rowadd-button").on("click", function() {
            let i = $(".tblfood2").closest("tbody").find("tr").length;
            i++;

            $("#bodyTableAddFood2").append(
                "<tr class='del'><td><div class='row gy-4'><h5>รายการที่ [" + i + "]</h5><div class='col-xxl-6 col-md-6'><div><label for='txtproductsubno" + i + "' class='form-label'><b>เลขทะเบียนครุภัณฑ์ย่อย</b></label><input type='hidden' name='idpdcchk2[]' class='chkclass2' value='null'><input type='text' class='required form-control' id='txtproductsubno" + i + "' name='txtproductsubno[]' required='required' maxlength='30'></div></div><div class='col-xxl-6 col-md-6'><div><label for='txtproductsubname" + i + "' class='form-label'><b>ชื่อครุภัณฑ์ย่อย</b></label><input type='text' class='required form-control' name='txtproductsubname[]' required='required' maxlength='200'></div></div><hr/></td></tr>"
            );

        });


        $("#removesubset-button").on("click", function() {
            let classchk = $(".tblfood2").closest("tbody").find("input[class='chkclass2']").val();
            if(classchk == 'null'){
                $(".tblfood2 tr:last").remove();  
            }else{

            }
            
                return;

        });








    });

    // <div class='col-xxl-3 col-md-6'><div><label for='txtlctpdcset' class='form-label'><b>หน่วยงานรับผิดชอบ</b></label><select class='required form-select js-example-basic-single' id='txtlctpdcset' name='txtlctpdcset' style='width: 100%; height:36px;' required><option value=''>เลือกหน่วยงานรับผิดชอบ</option><?php foreach ($lctList as $key_lct => $value_lct) { ?><option value='<?php echo $value_lct['AMS_LCT_ID']; ?>'><?php echo $value_lct['AMS_LCT_NM']; ?></option><?php } ?></select></div></div>
    // <td><button type='button' class='btn btn-danger2 text-dark btnDelete' >ลบ</button></td>
</script>