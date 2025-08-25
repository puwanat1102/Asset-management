/*
Template Name: Velzon - Admin & Dashboard Template
Author: Themesbrand
Website: https://Themesbrand.com/
Contact: Themesbrand@gmail.com
File: Modal init js
*/

//User
var varyingcontentModal = document.getElementById('varyingcontentModal');
var varyingDelcontentModal = document.getElementById('deleteRecordModal');
var varyingRecontentModal = document.getElementById('RestoreRecordModal');
//Budget
var DeletebudgetModal = document.getElementById('DeletebudgetModal'); 
var RestoreBDRecordModal = document.getElementById('RestoreBDRecordModal'); 
var BudgetStatusModal = document.getElementById('BudgetStatusModal');

//Article
var ArticlecontentModal = document.getElementById('ArticlecontentModal');

//Product
var ProductcontentModal = document.getElementById('ProductcontentModal');
var DeleteSetProductModal = document.getElementById('DeleteSetProductModal'); 
var RestorePDCSetRecordModal = document.getElementById('RestorePDCSetRecordModal'); 
var RestorePDCSetAllRecordModal = document.getElementById('RestorePDCSetAllRecordModal'); 
//Repair
var RepaircontentModal = document.getElementById('RepaircontentModal');
var RepairHistoryModal = document.getElementById('RepairHistoryModal');

var RepairReportModal = document.getElementById('RepairReportModal');


if(BudgetStatusModal){

    BudgetStatusModal.addEventListener('show.bs.modal', function (event) {
        // Button that triggered the modal
        var button = event.relatedTarget
        // Extract info from data-bs-* attributes
        var detail = button.getAttribute('data-bs-detail');
        //
        // Update the modal's content.
        var modalTitle = BudgetStatusModal.querySelector('.modal-title');
        // var modalIDDelInput = BudgetStatusModal.querySelector('.idbd input');
 
        modalTitle.textContent = 'สถานะงบประมาณ '+detail ;
        // modalIDDelInput.value = idbd;

    })

}

if(RepairHistoryModal){

    RepairHistoryModal.addEventListener('show.bs.modal', function (event) {
        // Button that triggered the modal
        var button = event.relatedTarget
        // Extract info from data-bs-* attributes
        // var idpro = button.getAttribute('data-bs-idbd');
        //
        // Update the modal's content.
        var modalTitle = RepairHistoryModal.querySelector('.modal-title');
        // var modalIDDelInput = RepairHistoryModal.querySelector('.idpro input');
 
        modalTitle.textContent = 'ประวัติการซ่อม' ;
        // modalIDDelInput.value = idpro;

       
    })


}

if (varyingcontentModal) {
    varyingcontentModal.addEventListener('show.bs.modal', function (event) {
        // Button that triggered the modal
        var button = event.relatedTarget
        // Extract info from data-bs-* attributes
        var fullname = button.getAttribute('data-bs-fullname');
        var id = button.getAttribute('data-bs-id');
        var type = button.getAttribute('data-bs-type');
        var pos = button.getAttribute('data-bs-pos');
        var grp = button.getAttribute('data-bs-grp');
        var username = button.getAttribute('data-bs-username');
        var status = button.getAttribute('data-bs-status');
        var fdate = button.getAttribute('data-bs-fdate');
        // If necessary, you could initiate an AJAX request here
        // and then do the updating in a callback.
        //
        // Update the modal's content.
        var modalTitle = varyingcontentModal.querySelector('.modal-title');
        var modalFullnameInput = varyingcontentModal.querySelector('.dspname input');
        var modalTypeInput = varyingcontentModal.querySelector('.type input');
        var modalPosInput = varyingcontentModal.querySelector('.position input');
        var modaGrpInput = varyingcontentModal.querySelector('.grp input');
        var modalUsernameInput = varyingcontentModal.querySelector('.username input');
        var modalStatusInput = varyingcontentModal.querySelector('.status input');
        var modalFdateInput = varyingcontentModal.querySelector('.fdate input');

        modalTitle.textContent = 'รายละเอียด ' + id;
        modalFullnameInput.value = fullname;
        modalTypeInput.value = type;
        modalPosInput.value = pos;
        modaGrpInput.value = grp;
        modalUsernameInput.value = username;
        modalStatusInput.value = status;
        modalFdateInput.value = fdate;
    })
}

if (ArticlecontentModal) {
    ArticlecontentModal.addEventListener('show.bs.modal', function (event) {
        // Button that triggered the modal
        var button = event.relatedTarget
        // Extract info from data-bs-* attributes
        // var fullname = button.getAttribute('data-bs-fullname');
        var id = button.getAttribute('data-bs-id');
        var atcnm = button.getAttribute('data-bs-atcnm');
        var type = button.getAttribute('data-bs-type');
        var cnt = button.getAttribute('data-bs-cnt');
        var price = button.getAttribute('data-bs-price');
        var expdate = button.getAttribute('data-bs-expdate');
        var year = button.getAttribute('data-bs-year');
        var lct = button.getAttribute('data-bs-lct');
        var bl = button.getAttribute('data-bs-bl');
        var bldate = button.getAttribute('data-bs-bldate');
        var status = button.getAttribute('data-bs-status');
        var unit = button.getAttribute('data-bs-unit');
        var fdate = button.getAttribute('data-bs-fdate');

        var modalTitle = ArticlecontentModal.querySelector('.modal-title');
        var modalAtcNameInput = ArticlecontentModal.querySelector('.atcname input');
        var modalTypeInput = ArticlecontentModal.querySelector('.type input');
        var modalCntInput = ArticlecontentModal.querySelector('.cnt input');
        var modaPriceInput = ArticlecontentModal.querySelector('.price input');
        var modalEXPDateInput = ArticlecontentModal.querySelector('.expdate input');
        var modalYearInput = ArticlecontentModal.querySelector('.year input');
        var modalLctInput = ArticlecontentModal.querySelector('.lct input');
        var modalBalanceInput = ArticlecontentModal.querySelector('.bl input');
        var modalBldateInput = ArticlecontentModal.querySelector('.bldate input');
        var modalStatusInput = ArticlecontentModal.querySelector('.status input');
        var modalUnitInput = ArticlecontentModal.querySelector('.unit input');
        var modalFdateInput = ArticlecontentModal.querySelector('.fdate input')

        modalTitle.textContent = 'รายละเอียด ' + id;
        modalAtcNameInput.value = atcnm;
        modalTypeInput.value = type;
        modalCntInput.value = cnt;
        modaPriceInput.value = price;
        modalEXPDateInput.value = expdate;
        modalYearInput.value = year;
        modalLctInput.value = lct;
        modalBalanceInput.value = bl;
        modalBldateInput.value = bldate;
        modalStatusInput.value = status;
        modalUnitInput.value = unit;
        modalFdateInput.value = fdate;
    })
}

if(ProductcontentModal){
    ProductcontentModal.addEventListener('show.bs.modal',function (event) {
        var button = event.relatedTarget
        var id = button.getAttribute('data-bs-id');
        var pno = button.getAttribute('data-bs-pno');
        var pname = button.getAttribute('data-bs-pname');
        var unit = button.getAttribute('data-bs-unit');
        var price = button.getAttribute('data-bs-price');
        var sdate = button.getAttribute('data-bs-sdate');
        var expdate = button.getAttribute('data-bs-expdate');
        var ptype = button.getAttribute('data-bs-ptype');
        var plct = button.getAttribute('data-bs-plct');
        var ploc = button.getAttribute('data-bs-ploc');
        var pstatus = button.getAttribute('data-bs-pstatus');
        var pset = button.getAttribute('data-bs-pset');
        var pyear = button.getAttribute('data-bs-pyear');
        var psource = button.getAttribute('data-bs-psource');
        var pdatast = button.getAttribute('data-bs-pdatast');
        var pfdate = button.getAttribute('data-bs-pfdate');
        var pcntset = button.getAttribute('data-bs-pcntset');
        var ppriceunit = button.getAttribute('data-bs-ppriceunit');
        var ppricetotal = button.getAttribute('data-bs-ppricetotal');

        var modalTitle = ProductcontentModal.querySelector('.modal-title');
        var modalPno = ProductcontentModal.querySelector('.pno input');
        var modalPname = ProductcontentModal.querySelector('.pname input');
        var modalUnit = ProductcontentModal.querySelector('.unit input');
        var modalPrice = ProductcontentModal.querySelector('.price input');
        var modalSdate = ProductcontentModal.querySelector('.sdate input');
        var modalExpdate = ProductcontentModal.querySelector('.expdate input');
        var modalPtype = ProductcontentModal.querySelector('.ptype input');
        var modalPlct = ProductcontentModal.querySelector('.plct input');
        var modalPloc = ProductcontentModal.querySelector('.ploc input');
        var modalPstatus = ProductcontentModal.querySelector('.pstatus input');
        var modalPset = ProductcontentModal.querySelector('.pset input');
        var modalPyear = ProductcontentModal.querySelector('.pyear input');
        var modalPsource = ProductcontentModal.querySelector('.psource input');
        var modalPdatast = ProductcontentModal.querySelector('.pdatast input');
        var modalPfdate = ProductcontentModal.querySelector('.pfdate input');
        var modalPcntset = ProductcontentModal.querySelector('.pcntset input');
        var modalPpriceunit = ProductcontentModal.querySelector('.ppriceunit input');
        // var modalPpricetotal = ProductcontentModal.querySelector('.ppricetotal input');

        modalTitle.textContent = 'รายละเอียด ' + id;
        modalPno.value = pno;
        modalPname.value = pname;
        modalUnit.value = unit;
        modalPrice.value = price;
        modalSdate.value = sdate;
        modalExpdate.value = expdate;
        modalPtype.value = ptype;
        modalPlct.value = plct;
        modalPloc.value = ploc;
        modalPstatus.value = pstatus;
        modalPset.value = pset;
        modalPyear.value = pyear;
        modalPsource.value = psource;
        modalPdatast.value = pdatast;
        modalPfdate.value = pfdate;
        modalPcntset.value = pcntset;
        modalPpriceunit.value = ppriceunit;
        // modalPpricetotal.value = ppricetotal;

    })

}

if(RepaircontentModal){
    RepaircontentModal.addEventListener('show.bs.modal', function (event) {

        var button = event.relatedTarget
        var id = button.getAttribute('data-bs-id');
        var pno = button.getAttribute('data-bs-pno');
        var pname = button.getAttribute('data-bs-pname');
        var rpcase = button.getAttribute('data-bs-rpcase');
        var rpdate = button.getAttribute('data-bs-rpdate');
        var rpdates = button.getAttribute('data-bs-rpdates');
        var rpprice = button.getAttribute('data-bs-rpprice');
        var rpcom = button.getAttribute('data-bs-rpcom');
        var rpstatus = button.getAttribute('data-bs-rpstatus');
        var pdatast = button.getAttribute('data-bs-pdatast');
        var pfdate = button.getAttribute('data-bs-pfdate');

        var modalTitle = RepaircontentModal.querySelector('.modal-title');
        var modalPno = RepaircontentModal.querySelector('.pno input');
        var modalPname = RepaircontentModal.querySelector('.pname input');
        var modalrRpcase = RepaircontentModal.querySelector('.rpcase textarea');
        var modalRpdate = RepaircontentModal.querySelector('.rpdate input');
        var modalRpdates = RepaircontentModal.querySelector('.rpdates input');
        var modalRpprice = RepaircontentModal.querySelector('.rpprice input');
        var modalRpcom = RepaircontentModal.querySelector('.rpcom input');
        var modalRpstatus = RepaircontentModal.querySelector('.rpstatus input');
        var modalRpdatast = RepaircontentModal.querySelector('.pdatast input');
        var modalRpfdate = RepaircontentModal.querySelector('.pfdate input');

        modalTitle.textContent = 'รายละเอียด ' + id;
        modalPno.value = pno;
        modalPname.value = pname;
        modalrRpcase.value = rpcase;
        modalRpdate.value = rpdate;
        modalRpdates.value = rpdates;
        modalRpprice.value = rpprice;
        modalRpcom.value = rpcom;
        modalRpstatus.value = rpstatus;
        modalRpdatast.value = pdatast;
        modalRpfdate.value = pfdate;

    })

}


if(RepairReportModal){
    RepairReportModal.addEventListener('show.bs.modal', function (event) {

        var button = event.relatedTarget
        var id = button.getAttribute('data-bs-id');
        var pno = button.getAttribute('data-bs-pno');
        var pname = button.getAttribute('data-bs-pname');
        var rpcase = button.getAttribute('data-bs-rpcase');
        var rpdate = button.getAttribute('data-bs-rpdate');
        var rpdates = button.getAttribute('data-bs-rpdates');
        var rpprice = button.getAttribute('data-bs-rpprice');
        var rpcom = button.getAttribute('data-bs-rpcom');
        var rpstatus = button.getAttribute('data-bs-rpstatus');
        var pdatast = button.getAttribute('data-bs-pdatast');
        var pfdate = button.getAttribute('data-bs-pfdate');

        var unit = button.getAttribute('data-bs-unit');
        var price = button.getAttribute('data-bs-price');
        var sdate = button.getAttribute('data-bs-sdate');
        var expdate = button.getAttribute('data-bs-expdate');
        var ptype = button.getAttribute('data-bs-ptype');
        var plct = button.getAttribute('data-bs-plct');
        var ploc = button.getAttribute('data-bs-ploc');
        var pstatus = button.getAttribute('data-bs-pstatus');
        var pset = button.getAttribute('data-bs-pset');
        var pyear = button.getAttribute('data-bs-pyear');
        var psource = button.getAttribute('data-bs-psource');
        // var pdatastpdc = button.getAttribute('data-bs-pdatastpdc');
        // var pfdatepdc = button.getAttribute('data-bs-pfdatepdc');
        var pcntset = button.getAttribute('data-bs-pcntset');
        var ppriceunit = button.getAttribute('data-bs-ppriceunit');

        var modalTitle = RepairReportModal.querySelector('.modal-title');
        var modalPno = RepairReportModal.querySelector('.pno input');
        var modalPname = RepairReportModal.querySelector('.pname input');
        var modalrRpcase = RepairReportModal.querySelector('.rpcase textarea');
        var modalRpdate = RepairReportModal.querySelector('.rpdate input');
        var modalRpdates = RepairReportModal.querySelector('.rpdates input');
        var modalRpprice = RepairReportModal.querySelector('.rpprice input');
        var modalRpcom = RepairReportModal.querySelector('.rpcom input');
        var modalRpstatus = RepairReportModal.querySelector('.rpstatus input');
        var modalRpdatast = RepairReportModal.querySelector('.pdatast input');
        var modalRpfdate = RepairReportModal.querySelector('.pfdate input');

        var modalUnit = RepairReportModal.querySelector('.unit input');
        var modalPrice = RepairReportModal.querySelector('.price input');
        var modalSdate = RepairReportModal.querySelector('.sdate input');
        var modalExpdate = RepairReportModal.querySelector('.expdate input');
        var modalPtype = RepairReportModal.querySelector('.ptype input');
        var modalPlct = RepairReportModal.querySelector('.plct input');
        var modalPloc = RepairReportModal.querySelector('.ploc input');
        var modalPstatus = RepairReportModal.querySelector('.pstatus input');
        var modalPset = RepairReportModal.querySelector('.pset input');
        var modalPyear = RepairReportModal.querySelector('.pyear input');
        var modalPsource = RepairReportModal.querySelector('.psource input');
        // var modalPdatastpdc = RepairReportModal.querySelector('.pdatastpdc input');
        // var modalPfdatepdc = RepairReportModal.querySelector('.pfdatepdc input');
        var modalPcntset = RepairReportModal.querySelector('.pcntset input');
        var modalPpriceunit = RepairReportModal.querySelector('.ppriceunit input');

        modalTitle.textContent = 'รายละเอียด ' + id;
        modalPno.value = pno;
        modalPname.value = pname;
        modalrRpcase.value = rpcase;
        modalRpdate.value = rpdate;
        modalRpdates.value = rpdates;
        modalRpprice.value = rpprice;
        modalRpcom.value = rpcom;
        modalRpstatus.value = rpstatus;
        modalRpdatast.value = pdatast;
        modalRpfdate.value = pfdate;

        modalUnit.value = unit;
        modalPrice.value = price;
        modalSdate.value = sdate;
        modalExpdate.value = expdate;
        modalPtype.value = ptype;
        modalPlct.value = plct;
        modalPloc.value = ploc;
        modalPstatus.value = pstatus;
        modalPset.value = pset;
        modalPyear.value = pyear;
        modalPsource.value = psource;
        // modalPdatastpdc.value = pdatastpdc;
        // modalPfdatepdc.value = pfdatepdc;
        modalPcntset.value = pcntset;
        modalPpriceunit.value = ppriceunit;

    })

}

if(varyingDelcontentModal){

    varyingDelcontentModal.addEventListener('show.bs.modal', function (event) {
        // Button that triggered the modal
        var button = event.relatedTarget
        // Extract info from data-bs-* attributes
        var iduserdel = button.getAttribute('data-bs-iduser');
        var NameDel = button.getAttribute('data-bs-delnm');
        //
        // Update the modal's content.
        // var modalTitle = varyingDelcontentModal.querySelector('.modal-title');
        var modalIDDelInput = varyingDelcontentModal.querySelector('.iddel input');
        var modalDelName = varyingDelcontentModal.querySelector('.delname b');
      

        // modalTitle.textContent = 'รายละเอียด ' + id;
        modalIDDelInput.value = iduserdel;
        modalDelName.textContent = NameDel;
       
    })


}

if(varyingRecontentModal){

    varyingRecontentModal.addEventListener('show.bs.modal', function (event) {
        // Button that triggered the modal
        var button = event.relatedTarget
        // Extract info from data-bs-* attributes
        var iduserrestore = button.getAttribute('data-bs-iduser');
        // Update the modal's content.
        var modalRestoreInput = varyingRecontentModal.querySelector('.restore input');
      
        // modalTitle.textContent = 'รายละเอียด ' + id;
        modalRestoreInput.value = iduserrestore;
       
    })

}


if(DeletebudgetModal){

  DeletebudgetModal.addEventListener('show.bs.modal', function (event) {
      // Button that triggered the modal
      var button = event.relatedTarget
      // Extract info from data-bs-* attributes
      var idbudgetDel = button.getAttribute('data-bs-idbd');
      var NameDel = button.getAttribute('data-bs-delnm');
      // Update the modal's content.
      var modalDelBudgetInput = DeletebudgetModal.querySelector('.iddel input');
      var modalDelName = DeletebudgetModal.querySelector('.delname b');
      // modalTitle.textContent = 'รายละเอียด ' + id;
      modalDelBudgetInput.value = idbudgetDel;
      modalDelName.textContent = NameDel;
     
  })

}


if(DeleteSetProductModal){

    DeleteSetProductModal.addEventListener('show.bs.modal', function (event) {
        // Button that triggered the modal
        var button = event.relatedTarget
        // Extract info from data-bs-* attributes
        var idbudgetDel = button.getAttribute('data-bs-idbd');
        var NameDel = button.getAttribute('data-bs-delnm');
        var Setid = button.getAttribute('data-bs-setid');
        // Update the modal's content.
        var modalDelBudgetInput = DeleteSetProductModal.querySelector('.iddel input');
        var modalDelName = DeleteSetProductModal.querySelector('.delname b');
        var modalDelSet = DeleteSetProductModal.querySelector('.iddelset input');
        // modalTitle.textContent = 'รายละเอียด ' + id;
        modalDelBudgetInput.value = idbudgetDel;
        modalDelName.textContent = NameDel;
        modalDelSet.value = Setid;
       
    })
  
  }


if(RestoreBDRecordModal){

  RestoreBDRecordModal.addEventListener('show.bs.modal', function (event) {
      // Button that triggered the modal
      var button = event.relatedTarget
      // Extract info from data-bs-* attributes
      var idbdrestore = button.getAttribute('data-bs-idbd');
      // Update the modal's content.
      var modalRestoreBDInput = RestoreBDRecordModal.querySelector('.restore input');
    
      // modalTitle.textContent = 'รายละเอียด ' + id;
      modalRestoreBDInput.value = idbdrestore;
     
  })

}

if(RestorePDCSetRecordModal){

    RestorePDCSetRecordModal.addEventListener('show.bs.modal', function (event) {
        // Button that triggered the modal
        var button = event.relatedTarget
        // Extract info from data-bs-* attributes
        var idbdrestore = button.getAttribute('data-bs-idbd');
        var idset = button.getAttribute('data-bs-idset');
        // Update the modal's content.
        var modalRestoreBDInput = RestorePDCSetRecordModal.querySelector('.restore input');
        var modalRestoreSetInput = RestorePDCSetRecordModal.querySelector('.restoreset input');
      
        // modalTitle.textContent = 'รายละเอียด ' + id;
        modalRestoreBDInput.value = idbdrestore;
        modalRestoreSetInput.value = idset;
       
    })
}

if(RestorePDCSetAllRecordModal){

    RestorePDCSetAllRecordModal.addEventListener('show.bs.modal', function (event) {
        // Button that triggered the modal
        var button = event.relatedTarget
        // Extract info from data-bs-* attributes
        var idbdrestore = button.getAttribute('data-bs-idbd');
        // Update the modal's content.
        var modalRestoreBDInput = RestorePDCSetAllRecordModal.querySelector('.restore input');
      
        // modalTitle.textContent = 'รายละเอียด ' + id;
        modalRestoreBDInput.value = idbdrestore;
       
    })
  
  }







