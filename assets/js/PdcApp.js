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

  //เลือกปีงบ
  $("#txtyearatc2").change(function () {
    $.ajax({
      type: "POST",
      url: "https://mct-system.com/pages/article/article_ajaxYearBudgets.php",
      cache: false,
      data: { txtyearatc: $(this).val() },
      success: function (html) {
        $("#txtsourceatc2").html(html);
      },
    });
    return false;
  });

  // วันที่
  $(function () {
    $("#txtsdate").datepicker({
      language: "th-th",
      format: "dd/mm/yyyy",
      autoclose: true,
    });

    $("#txtexpdate").datepicker({
      language: "th-th",
      format: "dd/mm/yyyy",
      autoclose: true,
    });
    $("#txtsdate2").datepicker({
      language: "th-th",
      format: "dd/mm/yyyy",
      autoclose: true,
    });

    $("#txtexpdate2").datepicker({
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

  var form6 = $("#f_product");
  form6.validate({
    errorPlacement: function errorPlacement(error, element) {
      element.before(error);
    },
    rules: {
      // txtproductno: {
      //   required: true,
      // },
      txtproductno: {
        required: true,
        remote: {
          url: "https://mct-system.com/pages/products/product_ajaxproductno.php",
          type: "get",
          data: {
            action: function () {
              return "checkpdcno";
            },
            txtproductno: function () {
              var txtproductno = $("#txtproductno").val();
              return txtproductno;
            }
          }
        },

      },
      txtproductname: {
        required: true,
      },
      txtunit: {
        required: true,
      },
      txtprice: {
        required: true,
        maxlength: 14,
      },
      txtsdate: {
        required: true,
      },
      txtexpdate: {
        required: true,
      },
      txtproductype: {
        required: true,
      },
      txtlctpdc: {
        required: true,
      },
      txtlocation: {
        required: true,
      },
      txtstatusproduct: {
        required: true,
      },
      txtyearatc: {
        required: true,
      },
      // txtsourceatc: {
      //   required: true,
      // },
      txtsourceatc: {
        required: true,
        remote: {
          url: "https://mct-system.com/pages/products/product_ajaxchkbudget.php",
          type: "get",
          data: {
            action: function () {
              return "checkbudget";
            },
            txtsourceatc: function () {
              var txtsourceatc = $("#txtsourceatc").val();
              return txtsourceatc;
            },
            txtprice: function () {
              var txtprice = $("#txtprice").val();
              return txtprice;
            }
          },
        },
      },
    },
    messages: {
      // txtproductno: "<font color='red'>กรุณาระบุเลขทะเบียนครุภัณฑ์</font>",
      txtproductno: {
        required: "<font color='red'>กรุณาระบุเลขทะเบียนครุภัณฑ์</font>",
        remote: "<font color='red'>เลขทะเบียนครุภัณฑ์นี้มีในระบบแล้ว</font>",
      },
      txtproductname: "<font color='red'>กรุณาระบุชื่อครุภัณฑ์</font>",
      txtunit: "<font color='red'>กรุณาระบุหน่วยนับ</font>",
      txtprice: {
        required: "<font color='red'>กรุณาระบุราคา</font>",
        maxlength: "<font color='red'>จำนวนเงินเกินที่กำหนด</font>",
      },
      txtsdate: "<font color='red'>กรุณาระบุวันที่ส่งมอบ</font>",
      txtexpdate: "<font color='red'>กรุณาระบุวันสิ้นสุดประกัน</font>",
      txtproductype: "<font color='red'>กรุณาเลือกประเภทของครุภัณฑ์</font>",
      txtlctpdc: "<font color='red'>กรุณาเลือกหน่วยงานรับผิดชอบ</font>",
      txtlocation: "<font color='red'>กรุณาระบุสถานที่จัดเก็บ</font>",
      txtstatusproduct: "<font color='red'>กรุณาเลือกสถานะครุภัณฑ์</font>",
      txtyearatc: "<font color='red'>กรุณาเลือกปีงบประมาณ</font>",
      // txtsourceatc: "<font color='red'>กรุณาเลือกที่มางบประมาณ</font>",
      txtsourceatc: {
        required: "<font color='red'>กรุณาเลือกที่มางบประมาณ</font>",
        remote: "<font color='red'>ราคาเกินงบประมาณที่เลือก</font>",
      },
    },
  });


  var form2 = $("#f_producted");
  form2.validate({
    errorPlacement: function errorPlacement(error, element) {
      element.before(error);
    },
    rules: {
      // txtproductno: {
      //   required: true,
      // },
      txtproductno: {
        required: true,
        remote: {
          url: "https://mct-system.com/pages/products/product_ajaxproductnoed.php",
          type: "get",
          data: {
            action: function () {
              return "checkpdcno";
            },
            txtproductno: function () {
              var txtproductno = $("#txtproductno").val();
              return txtproductno;
            },
            txtproductnochk: function () {
              var txtproductnochk = $("#txtproductnochk").val();
              return txtproductnochk;
            }
          }
        },

      },
      txtproductname: {
        required: true,
      },
      txtunit: {
        required: true,
      },
      txtprice: {
        required: true,
        maxlength: 14,
      },
      txtsdate: {
        required: true,
      },
      txtexpdate: {
        required: true,
      },
      txtproductype: {
        required: true,
      },
      txtlctpdc: {
        required: true,
      },
      txtlocation: {
        required: true,
      },
      txtstatusproduct: {
        required: true,
      },
      txtyearatc: {
        required: true,
      },
      // txtsourceatc: {
      //   required: true,
      // },
      txtsourceatc: {
        required: true,
        remote: {
          url: "https://mct-system.com/pages/products/product_ajaxchkbudgeted.php",
          type: "get",
          data: {
            action: function () {
              return "checkbudget";
            },
            txtsourceatc: function () {
              var txtsourceatc = $("#txtsourceatc").val();
              return txtsourceatc;
            },
            txtprice: function () {
              var txtprice = $("#txtprice").val();
              return txtprice;
            },
            txtpriceed: function () {
              var txtpriceed = $("#txtpriceed").val();
              return txtpriceed;
            }
          },
        },
      },
    },
    messages: {
      // txtproductno: "<font color='red'>กรุณาระบุเลขทะเบียนครุภัณฑ์</font>",
      txtproductno: {
        required: "<font color='red'>กรุณาระบุเลขทะเบียนครุภัณฑ์</font>",
        remote: "<font color='red'>เลขทะเบียนครุภัณฑ์นี้มีในระบบแล้ว</font>",
      },
      txtproductname: "<font color='red'>กรุณาระบุชื่อครุภัณฑ์</font>",
      txtunit: "<font color='red'>กรุณาระบุหน่วยนับ</font>",
      txtprice: {
        required: "<font color='red'>กรุณาระบุราคา</font>",
        maxlength: "<font color='red'>จำนวนเงินเกินที่กำหนด</font>",
      },
      txtsdate: "<font color='red'>กรุณาระบุวันที่ส่งมอบ</font>",
      txtexpdate: "<font color='red'>กรุณาระบุวันสิ้นสุดประกัน</font>",
      txtproductype: "<font color='red'>กรุณาเลือกประเภทของครุภัณฑ์</font>",
      txtlctpdc: "<font color='red'>กรุณาเลือกหน่วยงานรับผิดชอบ</font>",
      txtlocation: "<font color='red'>กรุณาระบุสถานที่จัดเก็บ</font>",
      txtstatusproduct: "<font color='red'>กรุณาเลือกสถานะครุภัณฑ์</font>",
      txtyearatc: "<font color='red'>กรุณาเลือกปีงบประมาณ</font>",
      // txtsourceatc: "<font color='red'>กรุณาเลือกที่มางบประมาณ</font>",
      txtsourceatc: {
        required: "<font color='red'>กรุณาเลือกที่มางบประมาณ</font>",
        remote: "<font color='red'>ราคาเกินงบประมาณที่เลือก</font>",
      },
    },
  });

  var form3 = $("#f_productset");
  // var cntsetlist = $("#txtsetunit").val();
  form3.validate({
    errorPlacement: function errorPlacement(error, element) {
      element.before(error);
    },
    rules: {

      "txtproductno[]": "required",
      "txtproductname[]": "required",
      "txtunit[]": "required",
      "txtproductype[]": "required",
      "txtlocation[]": "required",
   

      txtproductsetno: {
        required: true,
        remote: {
          url: "https://mct-system.com/pages/products/product_ajaxproductno.php",
          type: "get",
          data: {
            action: function () {
              return "checkpdcsetno";
            },
            txtproductsetno: function () {
              var txtproductsetno = $("#txtproductsetno").val();
              return txtproductsetno;
            }
          }
        },

      },
      txtproductsetname: {
        required: true,
      },
      txtsetprice: {
        required: true,
        maxlength: 14,
      },
      txtsetunit: {
        required: true,
      },
      txtsdate: {
        required: true,
      },
      txtexpdate: {
        required: true,
      },
      txtlctpdcset: {
        required: true,
      },
      txtstatusproductset: {
        required: true,
      },
      txtyearatc: {
        required: true,
      },
      txtsourceatc: {
        required: true,
        remote: {
          url: "https://mct-system.com/pages/products/product_ajaxchkbudget.php",
          type: "get",
          data: {
            action: function () {
              return "checkbudgetset";
            },
            txtsourceatc: function () {
              var txtsourceatc = $("#txtsourceatc").val();
              return txtsourceatc;
            },
            txtsetprice: function () {
              var txtsetprice = $("#txtsetprice").val();
              return txtsetprice;
            },
            txtsetunit: function () {
              var txtsetunit = $("#txtsetunit").val();
              return txtsetunit;
            }
          },
        },
      },
    },
    messages: {
      // Product

      "txtproductno[]": "<font color='red'>กรุณาระบุเลขทะเบียนครุภัณฑ์</font>",
      "txtproductname[]": "<font color='red'>กรุณาระบุชื่อครุภัณฑ์</font>",
      "txtunit[]": "<font color='red'>กรุณาระบุหน่วยนับ</font>",
      "txtproductype[]": "<font color='red'>กรุณาเลือกประเภทของครุภัณฑ์</font>",
      "txtlocation[]": "<font color='red'>กรุณาระบุสถานที่จัดเก็บ</font>",

      // Product

      // Set
      // txtproductsetno: "<font color='red'>กรุณาระบุเลขชุดครุภัณฑ์</font>",
      txtproductsetno: {
        required: "<font color='red'>กรุณาระบุเลขชุดครุภัณฑ์</font>",
        remote: "<font color='red'>เลขชุดครุภัณฑ์นี้มีในระบบแล้ว</font>",
      },
      txtproductsetname: "<font color='red'>กรุณาระบุชื่อชุดครุภัณฑ์</font>",
      txtsetunit: "<font color='red'>กรุณาระบุจำนวน</font>",
      txtsetprice: {
        required: "<font color='red'>กรุณาระบุราคา</font>",
        maxlength: "<font color='red'>จำนวนเงินเกินที่กำหนด</font>",
      },
      txtsdate: "<font color='red'>กรุณาระบุวันที่ส่งมอบ</font>",
      txtexpdate: "<font color='red'>กรุณาระบุวันสิ้นสุดประกัน</font>",
      txtlctpdcset: "<font color='red'>กรุณาเลือกหน่วยงานรับผิดชอบ</font>",
      txtstatusproductset: "<font color='red'>กรุณาเลือกสถานะครุภัณฑ์</font>",
      txtyearatc: "<font color='red'>กรุณาเลือกปีงบประมาณ</font>",
      txtsourceatc: {
        required: "<font color='red'>กรุณาเลือกที่มางบประมาณ</font>",
        remote: "<font color='red'>ราคาเกินงบประมาณที่เลือก</font>",
      },
      // Set
    },
  });

  var form4 = $("#f_productsetlisted");
  form4.validate({
    errorPlacement: function errorPlacement(error, element) {
      element.before(error);
    },
    rules: {
      txtproductno: {
        required: true,
        remote: {
          url: "https://mct-system.com/pages/products/product_ajaxproductnoed.php",
          type: "get",
          data: {
            action: function () {
              return "checkpdcno";
            },
            txtproductno: function () {
              var txtproductno = $("#txtproductno").val();
              return txtproductno;
            },
            txtproductnochk: function () {
              var txtproductnochk = $("#txtproductnochk").val();
              return txtproductnochk;
            }
          }
        },

      },
      txtproductname: {
        required: true,
      },
      txtunit: {
        required: true,
      },
      txtprice: {
        required: true,
        maxlength: 14,
      },
      txtproductype: {
        required: true,
      },
      txtlocation: {
        required: true,
      },
      txtstatusproduct: {
        required: true,
      },
    },
    messages: {
      txtproductno: {
        required: "<font color='red'>กรุณาระบุเลขทะเบียนครุภัณฑ์</font>",
        remote: "<font color='red'>เลขทะเบียนครุภัณฑ์นี้มีในระบบแล้ว</font>",
      },
      txtproductname: "<font color='red'>กรุณาระบุชื่อครุภัณฑ์</font>",
      txtunit: "<font color='red'>กรุณาระบุหน่วยนับ</font>",
      txtprice: {
        required: "<font color='red'>กรุณาระบุราคา</font>",
        maxlength: "<font color='red'>จำนวนเงินเกินที่กำหนด</font>",
      },
      txtproductype: "<font color='red'>กรุณาเลือกประเภทของครุภัณฑ์</font>",
      txtlocation: "<font color='red'>กรุณาระบุสถานที่จัดเก็บ</font>",
      txtstatusproduct: "<font color='red'>กรุณาเลือกสถานะครุภัณฑ์</font>",
    },
  });


  var form15 = $("#f_productseted");
  form15.validate({
    errorPlacement: function errorPlacement(error, element) {
      element.before(error);
    },
    rules: {
      "txtproductno[]": "required",
      "txtproductname[]": "required",
      "txtunit[]": "required",
      "txtproductype[]": "required",
      "txtlocation[]": "required",
      "txtstatusproductset[]": "required",

      txtproductsetno: {
        required: true,
        remote: {
          url: "https://mct-system.com/pages/products/product_ajaxproductnoed.php",
          type: "get",
          data: {
            action: function () {
              return "checkpdcsetnoed";
            },
            txtproductsetno: function () {
              var txtproductsetno = $("#txtproductsetno").val();
              return txtproductsetno;
            },
            txtproductsetnochk: function () {
              var txtproductsetnochk = $("#txtproductsetnochk").val();
              return txtproductsetnochk;
            }
          }
        },

      },
      txtproductsetname: {
        required: true,
      },
      txtsetprice: {
        required: true,
        maxlength: 14,
      },
      txtsdate2: {
        required: true,
      },
      txtexpdate2: {
        required: true,
      },
      txtlctpdcset: {
        required: true,
      },
      txtyearatc: {
        required: true,
      },
      txtsourceatc2: {
        required: true,
        remote: {
          url: "https://mct-system.com/pages/products/product_ajaxchkbudgeted.php",
          type: "get",
          data: {
            action: function () {
              return "checkbudgetset";
            },
            txtsourceatc: function () {
              var txtsourceatc = $("#txtsourceatc2").val();
              return txtsourceatc;
            },
            txtsetprice: function () {
              var txtsetprice = $("#txtsetprice").val();
              return txtsetprice;
            },
            txtsetunit: function () {
              var txtsetunit = $("#txtsetunit").val();
              return txtsetunit;
            },
            txtsetpricechk: function () {
              var txtsetpricechk = $("#txtsetpricechk").val();
              return txtsetpricechk;
            },
            txtsetunitchk: function () {
              var txtsetunitchk = $("#txtsetunitchk").val();
              return txtsetunitchk;
            }
          },
        },
      },
    },
    messages: {
      // Product
      "txtproductno[]": "<font color='red'>กรุณาระบุเลขทะเบียนครุภัณฑ์</font>",
      "txtproductname[]": "<font color='red'>กรุณาระบุชื่อครุภัณฑ์</font>",
      //   txtproductno: {
      //     required: "<font color='red'>กรุณาระบุเลขทะเบียนครุภัณฑ์</font>",
      //     remote: "<font color='red'>เลขทะเบียนครุภัณฑ์นี้มีในระบบแล้ว</font>",
      // },
      "txtunit[]": "<font color='red'>กรุณาระบุหน่วยนับ</font>",
      "txtproductype[]": "<font color='red'>กรุณาเลือกประเภทของครุภัณฑ์</font>",
      "txtlocation[]": "<font color='red'>กรุณาระบุสถานที่จัดเก็บ</font>",
      "txtstatusproductset[]": "<font color='red'>กรุณาเลือกสถานะครุภัณฑ์</font>",
      // Product

      // Set
      // txtproductsetno: "<font color='red'>กรุณาระบุเลขชุดครุภัณฑ์</font>",
      txtproductsetno: {
        required: "<font color='red'>กรุณาระบุเลขชุดครุภัณฑ์</font>",
        remote: "<font color='red'>เลขชุดครุภัณฑ์นี้มีในระบบแล้ว</font>",
      },
      txtproductsetname: "<font color='red'>กรุณาระบุชื่อชุดครุภัณฑ์</font>",
      txtsetprice: {
        required: "<font color='red'>กรุณาระบุราคา</font>",
        maxlength: "<font color='red'>จำนวนเงินเกินที่กำหนด</font>",
      },
      txtsdate2: "<font color='red'>กรุณาระบุวันที่ส่งมอบ</font>",
      txtexpdate2: "<font color='red'>กรุณาระบุวันสิ้นสุดประกัน</font>",
      txtlctpdcset: "<font color='red'>กรุณาเลือกหน่วยงานรับผิดชอบ</font>",
      
      txtyearatc: "<font color='red'>กรุณาเลือกปีงบประมาณ</font>",
      txtsourceatc2: {
        required: "<font color='red'>กรุณาเลือกที่มางบประมาณ</font>",
        remote: "<font color='red'>ราคาเกินงบประมาณที่เลือก</font>",
      },
      // Set
    },
  });



  $(function () {
    $('#sa-successpdc').click();
    $('#sa-errorpdc').click();

  });


  $('.subset').on('click',function(){
    var id = $(this).data('bs-id');
    //  alert(id);
    $('.rssubset').html('loading');
  
       $.ajax({
        type: 'POST',
        url: 'https://mct-system.com/pages/products/product_ajaxsubset.php?action=productsubset',
        data:{id: id},
        success: function(data) {
          $('.rssubset').html(data);
        },
        error:function(err){
          alert("error"+JSON.stringify(err));
        }
    });
  });




});
