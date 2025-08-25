<!-- JAVASCRIPT -->
<script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/libs/simplebar/simplebar.min.js"></script>
<script src="assets/libs/node-waves/waves.min.js"></script>
<script src="assets/libs/feather-icons/feather.min.js"></script>
<script src="assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
<script src="assets/js/plugins.js"></script>


<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> -->

<script src="assets/js/main/jquery-3.6.0.min.js"></script>

<!--datatable js-->
<!-- <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script> -->
<script src="assets/js/datatables/jquery.dataTables.min.js"></script>
<!-- <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script> -->
<script src="assets/js/datatables/dataTables.bootstrap5.min.js"></script>
<!-- <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script> -->
<script src="assets/js/datatables/dataTables.responsive.min.js"></script>
<!-- <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script> -->
<script src="assets/js/datatables/dataTables.buttons.min.js"></script>
<!-- <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script> -->
<script src="assets/js/datatables/buttons.print.min.js"></script>
<!-- <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script> -->
<script src="assets/js/datatables/buttons.html5.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script> -->
<script src="assets/js/datatables/vfs_fonts.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script> -->
<script src="assets/js/datatables/pdfmake.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script> -->
<script src="assets/js/datatables/jszip.min.js"></script>

<!-- apexcharts -->
<script src="assets/libs/apexcharts/apexcharts.min.js"></script>

<!-- Vector map-->
<script src="assets/libs/jsvectormap/js/jsvectormap.min.js"></script>
<script src="assets/libs/jsvectormap/maps/world-merc.js"></script>

<!--Swiper slider js-->
<script src="assets/libs/swiper/swiper-bundle.min.js"></script>

<!-- prismjs plugin -->
<script src="assets/libs/prismjs/prism.js"></script>

<!-- Dashboard init -->
<script src="assets/js/pages/dashboard-ecommerce.init.js"></script>
<script src="assets/js/pages/dashboard-crypto.init.js"></script>

<script src="assets/js/pages/datatables.init.js"></script>
<script src="assets/js/pages/form-validation.init.js"></script>

<script src="assets/js/pages/plugins/jquery-validation/dist/jquery.validate.min.js"></script>

<!--select2 cdn-->
<!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->
<script src="assets/js/select2/select2.min.js"></script>

<script src="assets/js/pages/select2.init.js"></script>

<!-- Lord Icon -->
<!-- <script src="https://cdn.lordicon.com/libs/mssddfmo/lord-icon-2.1.0.js"></script> -->
<script src="assets/js/lordicon/lord-icon-2.1.0.js"></script>

<!-- Modal Js -->
<script src="assets/js/pages/modal.init.js"></script>

<!-- เรียกใช้ datepicker ภาษาไทย -->
<!-- <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" /> -->
<link href="assets/css/font-awesome.min.css" rel="stylesheet" />
<link href="assets/js/pages/bootstrap-datepicker-thai/css/datepicker.css" rel="stylesheet">
<script type="text/javascript" src="assets/js/pages/bootstrap-datepicker-thai/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="assets/js/pages/bootstrap-datepicker-thai/js/bootstrap-datepicker-thai.js"></script>
<script type="text/javascript" src="assets/js/pages/bootstrap-datepicker-thai/js/locales/bootstrap-datepicker.th.js"></script>

<!-- Sweet Alerts js -->
<script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>

<!-- Sweet alert init js-->
<script src="assets/js/pages/sweetalerts.init.js"></script>


<script>
  $("#btnSubmit").click(function() {
        grecaptcha.ready(async function() {
          let token = await grecaptcha.execute('6LfDA_UgAAAAAJ9Wr8AKJ2kNWWU_40voWH22IBSw', {
            action: 'validate_captcha'
          }).then(function(token) {           
            $("#g-recaptcha-response").val(token)
            return token
          });
          if (token) {      
            $("#tokenVali").submit();
          }
        });
      });
</script>


