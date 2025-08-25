
$(document).ready(function () {
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

  $('.btn-blockdas').on('click',function(){
    var id = $(this).data('bs-idbd');
    // alert(id);
    $('.rphis').html('loading');

       $.ajax({
        type: 'POST',
        url: 'https://mct-system.com/pages/repair/repair_ajaxhistory.php?action=hisrepair',
        data:{id: id},
        success: function(data) {
          $('.rphis').html(data);
        },
        error:function(err){
          alert("error"+JSON.stringify(err));
        }
    });
 });

 

});