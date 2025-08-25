$(document).ready(function () {

    jQuery.validator.addMethod("passwordABC", function(value, element) {
        return this.optional(element) || (value.match(/[a-zA-Z]/) && value.match(/[0-9]/));
    }, "รหัสผ่านต้องประกอบไปด้วยตัวอักษร a-z อย่างน้อย 1 ตัวอักษร และตัวเลข 0-9");
    
    // ValidationFormUser
    var form6 = $("#f_users");
        form6.validate({
            errorPlacement: function errorPlacement(error, element) { element.before(error); },
            rules: {
                txtpname: {
                    required: true
                },
                txtfname: "required",
                txtlname: "required",
                txttype: {
                    required: true
                },
                txtgrp: {
                    required: true
                },
                txtusernm: "required",
                // txtpassword: "required",
                // txtconpassword: "required",
                txtusertype: {
                    required: true
                },
                txtuserst: {
                    required: true
                },
                txtpassword : {
                    required: true,
                    minlength : 4,
                    // maxlength : 10
                    passwordABC : true
                },
                txtconpassword : {
                    required: true,
                    minlength : 4,
                    // maxlength : 10,
                    equalTo : "#txtpassword",
                    passwordABC : true
                },
                txtusernm: {
                    required: true,
                    minlength: 5,
                    remote: {
                        url: "https://mct-system.com/pages/user/user_ajaxusername.php",
                        type: "get",
                        data: {
                            action: function () {
                                return "checkusername";
                            },
                            txtusernm: function() {
                                var txtusernm = $("#txtusernm").val();
                                return txtusernm;
                            }
                        }
                    },
                    // lettersonly: true
                }
                
            }
            ,
            messages: {
                txtpname: "<font color='red'>กรุณาเลือกคำนำหน้า</font>",
                txtfname: "<font color='red'>กรุณาระบุชื่อ</font>",
                txtlname: "<font color='red'>กรุณาระบุนามสกุล</font>",
                txttype: "<font color='red'>กรุณาเลือกประเภท</font>",
                txtgrp: "<font color='red'>กรุณาเลือกตำแหน่ง</font>",
                txtpassword : {
                    required: "<font color='red'>กรุณาระบุรหัสผ่าน</font>",
                    minlength :"<font color='red'>ความยาวของรหัสผ่านต้องมากว่า 4 ตัว</font>",
                    passwordABC : "<font color='red'>รหัสผ่านต้องประกอบไปด้วยตัวอักษร a-z อย่างน้อย 1 ตัวอักษร และตัวเลข 0-9</font>"
                    // maxlength :"<font color='red'>ความยาวของรหัสผ่านไม่เกิน 10 ตัว</font>"
                },txtconpassword : {
                    required: "<font color='red'>กรุณากยืนยันรหัสผ่าน</font>",
                    minlength :"<font color='red'>ความยาวของรหัสผ่านต้องมากว่า 4 ตัว</font>",
                    passwordABC : "<font color='red'>รหัสผ่านต้องประกอบไปด้วยตัวอักษร a-z อย่างน้อย 1 ตัวอักษร และตัวเลข 0-9</font>",
                    // maxlength :"<font color='red'>ความยาวของรหัสผ่านไม่เกิน 10 ตัว</font>",
                    equalTo : "<font color='red'>รหัสผ่านไม่ตรงกัน</font>"
                },
                txtusertype: "<font color='red'>กรุณาเลือกสิทธิการใช้งาน</font>",
                txtuserst: "<font color='red'>กรุณาเลือกสถานะการใช้งาน</font>",
                txtusernm: {
                    required: "<font color='red'>กรุณาระบุชื่อผู้ใช้งาน</font>",
                    minlength :"<font color='red'>ความยาวของผู้ใช้งานต้องมากว่า 5 ตัว</font>",
                    remote: "<font color='red'>ชื่อผู้ใช้งานซ้ำ</font>",
                    // lettersonly:"<font color='red'>ภาษาอังกฤษเท่านั้น</font>"
                },
            }
        });
    // ValidationFormUser
    
    // ValidationFormUser2
    var form7 = $("#f_usersed");
        form7.validate({
            errorPlacement: function errorPlacement(error, element) { element.before(error); },
            rules: {
                txtpname: {
                    required: true
                },
                txtfname: "required",
                txtlname: "required",
                txttype: {
                    required: true
                },
                txtgrp: {
                    required: true
                },
                txtusernm: "required",
                // txtpassword: "required",
                // txtconpassword: "required",
                txtusertype: {
                    required: true
                },
                txtuserst: {
                    required: true
                },
                txtpassword : {
                    // required: true,
                    minlength : 4,
                    // maxlength : 10
                    passwordABC : true
                },
                txtconpassword : {
                    // required: true,
                    minlength : 4,
                    // maxlength : 10,
                    equalTo : "#txtpassword",
                    passwordABC : true
                },
                txtusernm: {
                    required: true,
                    minlength: 5,
                    remote: {
                        url: "https://mct-system.com/pages/user/user_ajaxusernameedit.php",
                        type: "get",
                        data: {
                            action: function () {
                                return "checkusername";
                            },
                            txtusernm: function() {
                                var txtusernm = $("#txtusernm").val();
                                return txtusernm;
                            },
                            txtusernmchk: function() {
                                var txtusernmchk = $("#txtusernmchk").val();
                                return txtusernmchk;
                            }
                        }
                    },
                    // lettersonly: true
                }
                
            }
            ,
            messages: {
                txtpname: "<font color='red'>กรุณาเลือกคำนำหน้า</font>",
                txtfname: "<font color='red'>กรุณาระบุชื่อ</font>",
                txtlname: "<font color='red'>กรุณาระบุนามสกุล</font>",
                txttype: "<font color='red'>กรุณาเลือกประเภท</font>",
                txtgrp: "<font color='red'>กรุณาเลือกตำแหน่ง</font>",
                txtpassword : {
                    // required: "<font color='red'>กรุณาระบุรหัสผ่าน</font>",
                    minlength :"<font color='red'>ความยาวของรหัสผ่านต้องมากว่า 4 ตัว</font>",
                    passwordABC : "<font color='red'>รหัสผ่านต้องประกอบไปด้วยตัวอักษร a-z อย่างน้อย 1 ตัวอักษร และตัวเลข 0-9</font>"
                    // maxlength :"<font color='red'>ความยาวของรหัสผ่านไม่เกิน 10 ตัว</font>"
                },txtconpassword : {
                    // required: "<font color='red'>กรุณากยืนยันรหัสผ่าน</font>",
                    minlength :"<font color='red'>ความยาวของรหัสผ่านต้องมากว่า 4 ตัว</font>",
                    passwordABC : "<font color='red'>รหัสผ่านต้องประกอบไปด้วยตัวอักษร a-z อย่างน้อย 1 ตัวอักษร และตัวเลข 0-9</font>",
                    // maxlength :"<font color='red'>ความยาวของรหัสผ่านไม่เกิน 10 ตัว</font>",
                    equalTo : "<font color='red'>รหัสผ่านไม่ตรงกัน</font>"
                },
                txtusertype: "<font color='red'>กรุณาเลือกสิทธิการใช้งาน</font>",
                txtuserst: "<font color='red'>กรุณาเลือกสถานะการใช้งาน</font>",
                txtusernm: {
                    required: "<font color='red'>กรุณาระบุชื่อผู้ใช้งาน</font>",
                    minlength :"<font color='red'>ความยาวของผู้ใช้งานต้องมากว่า 5 ตัว</font>",
                    remote: "<font color='red'>ชื่อผู้ใช้งานซ้ำ</font>",
                    // lettersonly:"<font color='red'>ภาษาอังกฤษเท่านั้น</font>"
                },
            }
        });
    // ValidationFormUser2
    
    // ValidationFormUser3
    var form8 = $("#f_userspass");
        form8.validate({
            errorPlacement: function errorPlacement(error, element) { element.before(error); },
            rules: {
                txtpassword : {
                    required: true,
                    minlength : 4,
                    // maxlength : 10
                    passwordABC : true
                },
                txtconpassword : {
                    required: true,
                    minlength : 4,
                    // maxlength : 10,
                    equalTo : "#txtpassword",
                    passwordABC : true
                },
                txtpasswordold: {
                    required: true,
                    remote: {
                        url: "https://mct-system.com/pages/user/user_ajaxpassword.php",
                        type: "get",
                        data: {
                            action: function () {
                                return "checkpassword";
                            },
                            txtpasswordold: function() {
                                var txtpasswordold = $("#txtpasswordold").val();
                                return txtpasswordold;
                            },
                            userid: function() {
                                var userid = $("#userid").val();
                                return userid;
                            }
                        }
                    },
                    // lettersonly: true
                }
                
            }
            ,
            messages: {
                txtpassword : {
                    required: "<font color='red'>กรุณาระบุรหัสผ่าน</font>",
                    minlength :"<font color='red'>ความยาวของรหัสผ่านต้องมากว่า 4 ตัว</font>",
                    passwordABC : "<font color='red'>รหัสผ่านต้องประกอบไปด้วยตัวอักษร a-z อย่างน้อย 1 ตัวอักษร และตัวเลข 0-9</font>"
                    // maxlength :"<font color='red'>ความยาวของรหัสผ่านไม่เกิน 10 ตัว</font>"
                },txtconpassword : {
                    required: "<font color='red'>กรุณากยืนยันรหัสผ่านใหม่</font>",
                    minlength :"<font color='red'>ความยาวของรหัสผ่านต้องมากว่า 4 ตัว</font>",
                    passwordABC : "<font color='red'>รหัสผ่านต้องประกอบไปด้วยตัวอักษร a-z อย่างน้อย 1 ตัวอักษร และตัวเลข 0-9</font>",
                    equalTo : "<font color='red'>รหัสผ่านไม่ตรงกัน</font>"
                },
                txtpasswordold: {
                    required: "<font color='red'>กรุณาระบุรหัสผ่านเดิม</font>",
                    remote: "<font color='red'>รหัสเดิมไม่ถูกต้อง</font>",
                   
                },
            }
        });
    // ValidationFormUser3

    $(function() {
        $('#sa-successuser').click();
        $('#sa-erroruser').click();

        $('#sa-successuserinfo').click();
        $('#sa-erroruserinfo').click();

        $('#sa-successuserpass').click();
        $('#sa-erroruserpass').click();

        $('#sa-successuserlct').click();
        $('#sa-erroruserlct').click();
    });
    
    });