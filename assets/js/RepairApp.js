$(document).ready(function () {
  //เลือกปีงบ
  // $("#txtyearatc").change(function () {
  //   $.ajax({
  //     type: "POST",
  //     url: "https://mct-system.com/pages/article/article_ajaxYearBudgets.php",
  //     cache: false,
  //     data: { txtyearatc: $(this).val() },
  //     success: function (html) {
  //       $("#txtsourceatc").html(html);
  //     },
  //   });
  //   return false;
  // });

  // วันที่
  $(function () {
    $("#txtrpdate").datepicker({
      language: "th-th",
      format: "dd/mm/yyyy",
      autoclose: true,
    });

    $("#textsuccessdate").datepicker({
      language: "th-th",
      format: "dd/mm/yyyy",
      autoclose: true,
    });

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

    $("#txtfdateper").datepicker({
      language: "th-th",
      format: "dd/mm/yyyy",
      autoclose: true,
    });

    $("#txtldateper").datepicker({
      language: "th-th",
      format: "dd/mm/yyyy",
      autoclose: true,
    });

    $("#txtsucessdateper").datepicker({
      language: "th-th",
      format: "dd/mm/yyyy",
      autoclose: true,
    });
  });

  // จำนวนเงิน
  $("input[data-type='currency']").on({
    keyup: function () {
      formatCurrency($(this));
    },
    blur: function () {
      formatCurrency($(this), "blur");
    },
  });

  function formatNumber(n) {
    // format number 1000000 to 1,234,567
    return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  }

  function formatCurrency(input, blur) {
    // appends $ to value, validates decimal side
    // and puts cursor back in right position.

    // get input value
    var input_val = input.val();

    // don't validate empty input
    if (input_val === "") {
      return;
    }

    // original length
    var original_len = input_val.length;

    // initial caret position
    var caret_pos = input.prop("selectionStart");

    // check for decimal
    if (input_val.indexOf(".") >= 0) {
      // get position of first decimal
      // this prevents multiple decimals from
      // being entered
      var decimal_pos = input_val.indexOf(".");

      // split number by decimal point
      var left_side = input_val.substring(0, decimal_pos);
      var right_side = input_val.substring(decimal_pos);

      // add commas to left side of number
      left_side = formatNumber(left_side);

      // validate right side
      right_side = formatNumber(right_side);

      // On blur make sure 2 numbers after decimal
      if (blur === "blur") {
        right_side += "00";
      }

      // Limit decimal to only 2 digits
      right_side = right_side.substring(0, 2);

      // join number by .
      input_val = left_side + "." + right_side;
    } else {
      // no decimal entered
      // add commas to number
      // remove all non-digits
      input_val = formatNumber(input_val);
      input_val = input_val;

      // final formatting
      if (blur === "blur") {
        input_val += ".00";
      }
    }

    // send updated string to input
    input.val(input_val);

    // put caret back in the right position
    var updated_len = input_val.length;
    caret_pos = updated_len - original_len + caret_pos;
    input[0].setSelectionRange(caret_pos, caret_pos);
  }

  var form = $("#f_repair");
  form.validate({
    errorPlacement: function errorPlacement(error, element) {
      element.before(error);
    },
    rules: {
      txtrppdcno: {
        required: true,
      },
      txtrppdcname: {
        required: true,
      },
      txtrpcase: {
        required: true,
      },
      txtprice: {
        required: true,
        maxlength: 14,
      },
      txtrpdate: {
        required: true,
      },
      textsuccessdate: {
        required: true,
      },
      txtvendar: {
        required: true,
        maxlength: 200,
      },
      txtrepairst: {
        required: true,
      },
    },
    messages: {
      txtrppdcno: "<font color='red'>กรุณาระบุเลขทะเบียนครุภัณฑ์</font>",
      txtrppdcname: "<font color='red'>กรุณาระบุชื่อครุภัณฑ์</font>",
      txtrpcase: "<font color='red'>กรุณาระบุอาการเสีย</font>",
      txtprice: {
        required: "<font color='red'>กรุณาระบุจำนวนเงิน</font>",
        maxlength: "<font color='red'>จำนวนเงินเกินที่กำหนด</font>",
      },
      txtrpdate: "<font color='red'>กรุณาระบุวันที่ส่งซ่อม</font>",
      textsuccessdate: "<font color='red'>กรุณาระบุวันที่กำหนดแล้วเสร็จ</font>",
      txtvendar: {
        required: "<font color='red'>กรุณาระบุบริษัทที่ส่งซ่อม</font>",
        maxlength: "<font color='red'>จำนวนอักษรเกินกว่ากำหนด</font>",
      },
      txtrepairst: "<font color='red'>กรุณาเลือกสถานะรายการซ่อม</font>",
    },
  });

  $(function () {
      $('#sa-successrp').click();
      $('#sa-errorrp').click();
  });

  $('.btn-block').on('click',function(){
    var id = $(this).data('bs-idbd');
    // alert(id);
    $('.modal-body').html('loading');

       $.ajax({
        type: 'POST',
        url: 'https://mct-system.com/pages/repair/repair_ajaxhistory.php?action=hisrepair',
        data:{id: id},
        success: function(data) {
          $('.modal-body').html(data);
        },
        error:function(err){
          alert("error"+JSON.stringify(err));
        }
    });
 });
});
