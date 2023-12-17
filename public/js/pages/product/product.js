/* ------------------------------------------------------------------------------
 *
 *  # Select extension for Datatables
 *
 *  Demo JS code for datatable_extension_select.html page
 *
 * ---------------------------------------------------------------------------- */


// Setup module
// ------------------------------

var _componentModalLoad = function() {
    $(document).on('click', '.content_manage', function(e) {
        e.preventDefault();
        //open modal
        $('#modal_remote').modal('toggle');
        // it will get action url
        var url = $(this).data('url');
        // leave it blank before ajax call
        $('.modal-body').html('');
        // load ajax loader
        $('#modal-loader').show();
        $.ajax({
                url: url,
                type: 'GET',
                dataType: 'html'
            })
            .done(function(data) {
                $('.modal-body').html(data).fadeIn(); // load response
                $('#modal-loader').hide();
                $('#customer_name').focus();
                _remortClassFormValidation();
                _componentDropFile();
                _componentSelect2Normal();
            })
            .fail(function(data) {
                $('.modal-body').html('<span style="color:red; font-weight: bold;"> Something Went Wrong. Please Try again later.......</span>');
                $('#modal-loader').hide();
            });
    });
};

var emran = "";
var DatatableSelect = function() {

    // Basic Datatable examples
    var _componentDatatableSelect = function() {
        if (!$().DataTable) {
            console.warn('Warning - datatables.min.js is not loaded.');
            return;
        }

        // Setting datatable defaults
        $.extend($.fn.dataTable.defaults, {
            autoWidth: false,
            responsive: true,
            dom: '<"datatable-header"fl><"datatable-scroll-wrap"t><"datatable-footer"ip>',
            language: {
                search: '<span>Filter:</span> _INPUT_',
                searchPlaceholder: 'Type to filter...',
                processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> ',
                lengthMenu: '<span>Show:</span> _MENU_',
                paginate: {
                    'first': 'First',
                    'last': 'Last',
                    'next': $('html').attr('dir') == 'rtl' ? '&larr;' : '&rarr;',
                    'previous': $('html').attr('dir') == 'rtl' ? '&rarr;' : '&larr;'
                }
            }
        });

        emran = $('.content_managment_table').DataTable({
            responsive: {
                details: {
                    type: 'column',
                    target: 'tr'
                }
            },
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'copyHtml5',
                    text: '<i class="fa fa-clipboard" aria-hidden="true"></i>',
                    className: 'btn btn-sm btn-outline-info',
                    footer: true
                },
                {
                    extend: 'excelHtml5',
                    text: '<i class="fa fa-file-excel-o" aria-hidden="true"></i>',
                    className: 'btn btn-sm btn-outline-info',
                    footer: true
                },
                {
                    extend: 'csvHtml5',
                    text: '<i class="fa fa-table" aria-hidden="true"></i>',
                    className: 'btn btn-sm btn-outline-info',
                    footer: true
                },
                {
                    extend: 'pdfHtml5',
                    text: '<i class="fa fa-file-pdf-o" aria-hidden="true"></i>',
                    className: 'btn btn-sm btn-outline-info',
                    footer: true
                },
                {
                    extend: 'print',
                    text: '<i class="fa fa-print" aria-hidden="true"></i>',
                    className: 'btn btn-sm btn-outline-info',
                    footer: true
                },
            ],

            columnDefs: [{
                width: "80px",
                targets: [0]
            }, {
                orderable: false,
                targets: [4]
            }],

            order: [0, 'desc'],
            processing: true,
            serverSide: true,

            ajax: $('.content_managment_table').data('url'),
            columns: [
                // { data: 'checkbox', name: 'checkbox' },
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                }, {
                    data: 'image',
                    name: 'image'
                }, {
                    data: 'product_code',
                    name: 'product_code'
                }, {
                    data: 'product_name',
                    name: 'product_name'
                }, {
                    data: 'supplier',
                    name: 'supplier'
                }, {
                    data: 'status',
                    name: 'status'
                }, {
                    data: 'action',
                    name: 'action'
                }, {
                    data: 'delete',
                    name: 'delete'
                }
            ]

        });


    };

    var _componentRemoteModalLoad = function() {
        $(document).on('click', '#content_managment', function(e) {

            e.preventDefault();
            //open modal
            $('#modal_remote').modal('toggle');
            // it will get action url
            var url = $(this).data('url');
            // leave it blank before ajax call
            $('.modal-body').html('');
            // load ajax loader
            $('#modal-loader').show();
            $.ajax({
                    url: url,
                    type: 'Get',
                    dataType: 'html'
                })
                .done(function(data) {
                    $('.modal-body').html(data).fadeIn(); // load response
                    $('#modal-loader').hide();
                    $('#customer_name').focus();
                    _modalFormValidation();
                    _componentDropFile();
                    _componenteditor();
                    _componentSelect2Normal();
                })
                .fail(function(data) {
                    $('.modal-body').html('<span style="color:red; font-weight: bold;"> Something Went Wrong. Please Try again later.......</span>');
                    $('#modal-loader').hide();
                });
        });
    };



    //
    // Return objects assigned to module
    //

    return {
        init: function() {
            _componentDatatableSelect();
            _componentRemoteModalLoad();
            _componentSelect2Normal();
            _formValidation();
            _componentDropFile();
            _componenteditor();
            _componentModalLoad();
        }
    }
}();


// Initialize module
// ------------------------------

document.addEventListener('DOMContentLoaded', function() {
    DatatableSelect.init();
});

$('#close').click(function() {
    $('#content_form')[0].reset();
    $('#create').collapse("hide");
    $('#list').collapse("show");
});
// $('#list').collapse("show");

$('#product_category_id').select2({width:'92%'});
$('#supplier_id').select2({width:'92%'});
$('#brand_id').select2({width:'92%'});
$('#box_id').select2({width:'92%'});
$('#unit_id').select2({width:'92%'});
$('#tax_id').select2({width:'92%'});
$('#product_code').val(Math.floor(Math.random() * 10000) + 1);
$('.generate_random_number').click(function() {
    $('#product_code').val(Math.floor(Math.random() * 10000) + 1);
});

$('#product_variations').change(function() {
    var val = $(this).val();
    if(val == 1) {
        var url = $(this).data('url');
        $('#product_price').attr('disabled','1');
        $('#product_price').removeAttr('required');
        $('#product_cost').attr('disabled','1');
        $('#product_cost').removeAttr('required');
        $('#product_cost_area').fadeOut();
        $('#product_price_area').fadeOut();
        $.ajax({
            url: url,
            type: "GET",
            success: function(data){
                $('#product_variations_data').fadeIn();
                $("#product_variations_data").html(data);
            }
        });
    } else {
        $('#product_price').attr('required','1');
        $('#product_price').removeAttr('disabled');
        $('#product_cost').attr('required','1');
        $('#product_cost').removeAttr('disabled');
        $('#product_variations_data').fadeOut();
        $('#product_variations_data').html('');
        $('#product_cost_area').fadeIn();
        $('#product_price_area').fadeIn();
    }
});
var array = [];

$(document).on('change', '.delete', function() {
    if(this.checked) {
        array.push($(this).data('id'));
    } else {
        var index = array.indexOf($(this).data('id'));
        if (index > -1) {
            array.splice(index, 1);
        }
    }

    if(array.length > 0) {
        $('#del_item').removeAttr('disabled');
    } else {
        $('#del_item').attr('disabled', 1);
    }
});

$('#del_item').click(function() {
    var url = $(this).data('url');
    var data = array;
    $('#del_item').attr('disabled', 1);
    $('#del_item').html("Processing....");
    $.ajax({
        url: url,
        type: "POST",
        data: {data : data},
        success: function(data){
            if(data.status == 'error') {
                toastr.error(data.message);
            } else {
                toastr.success(data.message);
            }

            if (typeof(emran) != "undefined" && emran !== null) {
                emran.ajax.reload(null, false);
            } 
            array = [];

            $('#del_item').attr('disabled', 1);
            $('#del_item').html("Delete");

        }
    });
});