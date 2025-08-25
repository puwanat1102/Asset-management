/*
Template Name: Velzon - Admin & Dashboard Template
Author: Themesbrand
Website: https://Themesbrand.com/
Contact: Themesbrand@gmail.com
File: datatables init js
*/

document.addEventListener('DOMContentLoaded', function () {
    let table = new DataTable('#example',);
});


document.addEventListener('DOMContentLoaded', function () {
    let table = new DataTable('#scroll-vertical', {
        "scrollY": "450px",
        "scrollCollapse": true,
        "paging": false
    });

});

document.addEventListener('DOMContentLoaded', function () {
    let table = new DataTable('#scroll-horizontal', {
        "scrollX": true
    });
});

document.addEventListener('DOMContentLoaded', function () {
    let table = new DataTable('#alternative-pagination', {
        "pagingType": "full_numbers"
    });
});

$(document).ready(function () {
    var t = $('#add-rows').DataTable();
    var counter = 1;

    $('#addRow').on('click', function () {
        t.row.add([
            counter + '.1',
            counter + '.2',
            counter + '.3',
            counter + '.4',
            counter + '.5',
            counter + '.6',
            counter + '.7',
            counter + '.8',
            counter + '.9',
            counter + '.10',
            counter + '.11',
            counter + '.12'
        ]).draw(false);

        counter++;
    });

    // Automatically add a first row of data
    $('#addRow').click();
});


$(document).ready(function () {

    var d = new Date();
    var month = d.getMonth() + 1;
    var day = d.getDate();

    var output = day + '_' +
        (('' + month).length < 2 ? '0' : '') + month + '_' +
        (('' + day).length < 2 ? '0' : '') + d.getFullYear();


    $('#example').DataTable();
    $('#usermanage').DataTable();
    $('#userbins').DataTable();
    $('#repairmanage').DataTable();
    $('#repairhisall').DataTable();
    $('#repairmanageall').DataTable();
    $('#budgetmanageall').DataTable();
    $('#budgetmanageallreport').DataTable(
        {
            order: [[0, 'desc'], [1, 'asc']],
            // dom: 'Bfrtip',
            // buttons: [
            //     {
            //         extend: 'excelHtml5',
            //         text: 'ดาวน์โหลด Excel',
            //         title: 'รายละเอียดงบประมาณ' + output,
            //         footer: true,
            //         exportOptions: {
            //             columns: [1, 2, 3, 4, 5]
            //         }
            //     },
            // ]
        }
    );
    $('#repairmanageallreport').DataTable(
        {
            order: [[0, 'desc']],
            // dom: 'Bfrtip',
            // buttons: [
            //     {
            //         extend: 'excelHtml5',
            //         text: 'ดาวน์โหลด Excel',
            //         title: 'รายงานการซ่อมบำรุง' + output,
            //         exportOptions: {
            //             columns: [1, 2, 3, 4, 5, 6, 7, 8, 9]
            //         }
            //     },
            // ]
        }
    );

    $('#producrmanagereport').DataTable({
        order: [[0, 'asc'], [1, 'asc'], [2, 'asc']],
        // dom: 'Bfrtip',
        // buttons: [
        //     {
        //         extend: 'excelHtml5',
        //         text: 'ดาวน์โหลด Excel',
        //         title: 'รายงานครุภัณฑ์' + output,
        //         exportOptions: {
        //             columns: [4, 5, 6, 7, 8, 9, 10, 11]
        //         }
        //     },
        // ]
    });

    $('#articlemanagereport').DataTable({
        order: [[0, 'asc'], [1, 'asc'], [2, 'asc']],
        searching: true,
        // dom: 'Bfrtip',
        // buttons: [
        //     {
        //         extend: 'excelHtml5',
        //         text: 'ดาวน์โหลด Excel',
        //         title: 'รายงานวัสดุ' + output,
        //         exportOptions: {
        //             columns: [4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14]
        //         }
        //     },
        // ]
    });

    $('#budgetmanage').DataTable({
        order: [[0, 'asc']],
    });

    $('#budgetbins').DataTable();

    $('#deprecmanage').DataTable({
        order: [[0, 'asc']],
    });

    $('#articlebins').DataTable();
    $('#producrmanage').DataTable(
        {
            order: [[0, 'desc']],
        }
    );
    $('#producrmanagewar').DataTable(
        {
            order: [[0, 'asc']],
        }
    );
    $('#articlemanage').DataTable({
        order: [[0, 'desc']],
    });
    $('#articlewaranty').DataTable({
        order: [[0, 'asc']],
    });

    $('#repairdashboard').DataTable({
        order: [[0, 'asc']],
        pageLength : 5,
    });
});

//fixed header
document.addEventListener('DOMContentLoaded', function () {
    let table = new DataTable('#fixed-header', {
        "fixedHeader": true
    });

});

//modal data datables
document.addEventListener('DOMContentLoaded', function () {
    let table = new DataTable('#model-datatables', {
        responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.modal({
                    header: function (row) {
                        var data = row.data();
                        return 'Details for ' + data[0] + ' ' + data[1];
                    }
                }),
                renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                    tableClass: 'table'
                })
            }
        }
    });

});

//buttons exmples
document.addEventListener('DOMContentLoaded', function () {
    let table = new DataTable('#buttons-datatables', {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'print', 'pdf'
        ]
    });
});

//buttons exmples
document.addEventListener('DOMContentLoaded', function () {
    let table = new DataTable('#ajax-datatables', {
        "ajax": 'assets/json/datatable.json'
    });
}); 