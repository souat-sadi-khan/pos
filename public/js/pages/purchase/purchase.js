/* ------------------------------------------------------------------------------
 *
 *  # Select extension for Datatables
 *
 *  Demo JS code for datatable_extension_select.html page
 *
 * ---------------------------------------------------------------------------- */


// Setup module
// ------------------------------
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
                width: "100px",
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
                    data: 'date',
                    name: 'date'
                }, {
                    data: 'invoice',
                    name: 'invoice'
                }, {
                    data: 'supplier',
                    name: 'supplier'
                }, {
                    data: 'user_id',
                    name: 'user_id'
                }, {
                    data: 'amount',
                    name: 'amount'
                }, {
                    data: 'paid',
                    name: 'paid'
                }, {
                    data: 'due',
                    name: 'due'
                }, {
                    data: 'status',
                    name: 'status'
                }, {
                    data: 'action',
                    name: 'action'
                }
            ]
        });


    };

    var _componentRemoteModalLoad = function() {
        $(document).on('click', '#content_managment', function(e) {
            var supplier_id = $(this).data('id');
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
                    dataType: 'html',
                    data: { supplier_id:supplier_id},
                })
                .done(function(data) {
                    $('.modal-body').html(data).fadeIn(); // load response
                    $('#modal-loader').hide();
                    $('#ref_no').focus();
                    _modalFormValidation();
                    _componentSelect2Normal();
                    _componentDatePicker();
                    _remortClassFormValidation();
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
            _componentDatePicker();
            _formValidation();
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

$('#list').collapse("show");

var products = [];

$(".add-row").click(function(){
    var id = $(this).data('id');
    var url = $(this).data('url');
    var type = $('#number').val();
    var product_id = $(this).data('product_id');
    type = parseInt(type);
    row = type + 1;
    if( products.includes( $(this).data('id') ) ) {
        var qty = $('.update_qty_'+id).val();
        var refresh_qty = parseInt(qty) + 1;
        $('.update_qty_'+id).val(refresh_qty);
        calc();
        toastr.warning('Product Quantity is Updated Successfully');
    } else {
        products.push($(this).data('id'));
        $('#number').val(row);
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'html',
            data: {
                row: row, id:id, product_id:product_id
            },
            success: function(data) {
                $(".purchase_table tbody").append(data);
                toastr.success('Product is added into Cart Successfully');
                calc();
            }
        });
    }
});

$('#tab_logic tbody').on('keyup change',function(){
    calc();
});

function calc()
{
    $('#tab_logic tbody tr').each(function(i, element) {
        var html = $(this).html();
        if(html!='')
        {
            var qty = $(this).find('.qty').val();
            var sell_price = $(this).find('.sell_price').val();
            var tax = $(this).find('.product_tax').val();
            var unique_price = parseInt(tax) + parseInt(sell_price);
            $(this).find('.net_total').val((qty*unique_price).toFixed(2));
            
            calc_total();
        }
    });
}

function calc_total()
{
    sub_total=0;
    $('.net_total').each(function() {
        sub_total += parseInt($(this).val());
    });
    $('#subtotal').val(sub_total.toFixed(2));
    $('#total').val(sub_total.toFixed(2)); 

    tax_sum=sub_total/100*$('#order_tax').val();
    $('#order_tax').val(tax_sum.toFixed(2));
    $('#total').val((tax_sum+sub_total).toFixed(2));
    $('#shiping_charge').val(0);
    $('#other_charge').val(0);
    $('#discount').val(0);
    $('#paid').val(tax_sum+sub_total);
    $('#due').val(0.00);
}

$(document).on('keyup change', '#order_tax', function() {
    var tax = parseInt($(this).val());
    var sub_total = parseInt($('#subtotal').val());
    var tax_amount = (sub_total * tax) / 100;
    var total = sub_total + tax_amount;
    $('#total').val(total);
    $('#paid').val(total);
    $('#due').val(0.00);
});

$(document).on('keyup change', '#shiping_charge', function() {
    var ship = parseInt($(this).val());
    var sub_total = parseInt($('#subtotal').val());
    var tax = parseInt($('#order_tax').val());
    var tax_amount = (sub_total * tax) / 100;
    var total = sub_total + ship + tax_amount;
    $('#total').val(total);
    $('#paid').val(total);
    $('#due').val(0.00);
});

$(document).on('keyup change', '#other_charge', function() {
    var other = parseInt($(this).val());
    var ship = parseInt($('#shiping_charge').val());
    var sub_total = parseInt($('#subtotal').val());
    var tax = parseInt($('#order_tax').val());
    var tax_amount = (sub_total * tax) / 100;
    var total = sub_total + ship + tax_amount + other;
    $('#total').val(total);
    $('#paid').val(total);
    $('#due').val(0.00);
});

$(document).on('keyup change', '#discount', function() {
    var discount = parseInt($(this).val());
    var other = parseInt($('#other_charge').val());
    var ship = parseInt($('#shiping_charge').val());
    var sub_total = parseInt($('#subtotal').val());
    var tax = parseInt($('#order_tax').val());
    var tax_amount = (sub_total * tax) / 100;
    var total = sub_total + ship + tax_amount + other - discount;
    $('#total').val(total);
    $('#paid').val(total);
    $('#due').val(0.00);
});
    // delete the row
$(document).on('click', '.delete_row', function() {
    var row_id = $(this).data('id');
    $("#table_row_" + row_id).fadeOut('slow').remove();
    calc();
});

// change paid amount
$('#paid').keyup(function() {
    var val = $(this).val();
    var total = $('#total').val();

    var due = parseInt(total) - parseInt(val);

    $('#due').val(due);
});
$('#supplier_id').change(function() {
    var id = $(this).val();
    var url = $(this).data('url');
    $.ajax({
        url: url,
        type: 'POST',
        dataType: 'json',
        data: {
            id:id
        },
        success: function(data) {
            $('#main_supplier').fadeOut().remove();
            $('#supplier_id_input_field_area').fadeIn();
            $('#supplier_id_input_field').val(data.name);
            $('#supplier_id_input_field_main').val(id);
        }
    });

    $.ajax({
        url: '/admin/show-product-for-purchase',
        type: 'POST',
        dataType: 'html',
        data: {
            id:id
        },
        success: function(data) {
            $('#product_area').fadeIn('slow');
            $('#product_area').html(data);
        }
    });
});

$('.select_color').select2({width:'20%'});

$('#payment_method').change(function() {
    var val = $(this).val();
    $.ajax({
        url: '/admin/check-payment-method',
        type: 'GET',
        dataType: 'html',
        data: {
            val:val
        },
        success: function(data) {
            $('#payment_method_info').html(data);
        }
    });
})