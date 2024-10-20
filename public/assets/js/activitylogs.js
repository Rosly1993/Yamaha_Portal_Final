$(document).ready(function () {
    console.log("Document ready");

    var url = $('#data-table-url').data('url');
    console.log("Data URL: " + url);
    
    var currentMonth = new Date().getMonth() + 1;
    var currentYear = new Date().getFullYear();
     // Set the default value of the input to the current year
     $('#filter-year').val(currentYear);

     $('#filter-month').val(currentMonth);


    $('#filter-year').datepicker({
        format: "yyyy",
        viewMode: "years", 
        minViewMode: "years",
        endDate: currentYear.toString(), // Set maximum year as the current year
        autoclose: true
    }).keydown(function(e) {
        e.preventDefault(); // Prevent manual input
    });

    var table = $('#items_table').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],  // Initialize with no default ordering
        "ajax": {
            "url": url,
            "type": "GET",  
            "data": function(d) {
                d.month = $('#filter-month').val() || currentMonth;
                d.year = $('#filter-year').val() || currentYear;
            }
        },
        "columns": [
            { data: 'IndexKey', className: 'table-cell text-center font-size-14' },
            { data: 'ip_address', className: 'table-cell text-center font-size-14' },
            { data: 'username', className: 'table-cell text-center font-size-14' },
            { data: 'activity', className: 'table-cell text-center font-size-14' },
            { data: 'details', className: 'table-cell text-center font-size-14 text-wrap' },
            { data: 'date_record', className: 'table-cell text-center font-size-14' }
        ],
        "responsive": true,
        "autoWidth": false,
        "lengthMenu": [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "All"]
        ],
        "pageLength": 10,
    });

    console.log("DataTable initialized");

    new $.fn.dataTable.Buttons(table, {
        buttons: [
            {
                extend: 'excelHtml5',
                text: '<a class="text-white"><i class="fas fa-file-download text-white"></i>&nbsp;&nbsp;Excel</a>',
                className: 'btn-excel',
                autoFilter: true,
                sheetName: 'Exported data',
                exportOptions: {
                    modifier: {
                        page: 'all' // Export all pages, not just the current page
                    },
                    columns: ':visible' // Export only visible columns
                },
                title: 'Yamaha Portal'
            },
            {
                extend: 'print',
                text: '<a class="text-white"><i class="fas fa-print text-white"></i>&nbsp;&nbsp;Print</a>',
                className: 'btn-print',
                autoFilter: true,
                sheetName: 'Exported data',
                exportOptions: {
                    modifier: {
                        page: 'all' // Export all pages, not just the current page
                    },
                    columns: ':visible' // Export only visible columns
                },
                title: 'Yamaha Portal'
            },
            {
                extend: 'copy',
                text: '<a class="text-white"><i class="far fa-clipboard text-white"></i>&nbsp;&nbsp;Copy</a>',
                className: 'btn-copy',
                autoFilter: true,
                sheetName: 'Exported data',
                exportOptions: {
                    modifier: {
                        page: 'all' // Export all pages, not just the current page
                    },
                    columns: ':visible' // Export only visible columns
                },
                title: 'Yamaha Portal'
            }
        ]
    });
    
    console.log("Buttons initialized");

    table.buttons().container().appendTo($('.dataTables_length', table.wrapper));

    console.log("Buttons appended to container");

    // Reload data on filter change
    $('#filter-month, #filter-year').on('change', function () {
        table.ajax.reload();
    });var currentYear = new Date().getFullYear();

    // Initialize the datepicker with max year as current year
    
});
