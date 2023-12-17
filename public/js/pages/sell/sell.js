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
                $(".sell_table tbody").append(data);
                toastr.success('Product is added into Cart Successfully');
                calc();
            }
        });
    }

    // $('.pay_now').attr('id', 'content_managment');
    // $('.hold').attr('id', 'content_managment');
});

$('.sell_table tbody').on('keyup change',function(){
    calc();
});

function calc()
{
    $('.sell_table tbody tr').each(function(i, element) {
        var html = $(this).html();
        if(html!='')
        {
            var qty = $(this).find('.qty').val();
            var sell_price = $(this).find('.sell_price').val();
            $(this).find('.net_total').val((qty*sell_price).toFixed(2));
            
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
    $('.sub_total').html(sub_total.toFixed(2)); 
    $('#subtotal').val(sub_total.toFixed(2)); 

    tax_sum=sub_total/100*$('#order_tax').val();
    $('#total').val((tax_sum+sub_total).toFixed(2));
    $('#shiping_charge').val(0);
    $('#other_charge').val(0);
    $('#discount').val(0);

    var discount = parseInt($('#discount').val());
    var other = parseInt($('#other_charge').val());
    var ship = parseInt($('#shiping_charge').val());
    var sub_total = parseInt($('#subtotal').val());
    var tax = parseInt($('#order_tax').val());
    var tax_amount = (sub_total * tax) / 100;
    var total = sub_total + ship + tax_amount + other - discount;
    $('.total').html(total.toFixed(2));
    $('#total').val(total);
}

// discount
$(document).on('keyup change', '#discount', function() {
    var discount = parseInt($(this).val());
    var other = parseInt($('#other_charge').val());
    var ship = parseInt($('#shiping_charge').val());
    var sub_total = parseInt($('#subtotal').val());
    var tax = parseInt($('#order_tax').val());
    var tax_amount = (sub_total * tax) / 100;
    var total = sub_total + ship + tax_amount + other - discount;
    $('.total').html(total.toFixed(2));
    $('#total').val(total);
});

// shiping_charge
$(document).on('keyup change', '#shiping_charge', function() {
    var discount = parseInt($('#discount').val());
    var other = parseInt($('#other_charge').val());
    var ship = parseInt($('#shiping_charge').val());
    var sub_total = parseInt($('#subtotal').val());
    var tax = parseInt($('#order_tax').val());
    var tax_amount = (sub_total * tax) / 100;
    var total = sub_total + ship + tax_amount + other - discount;
    $('.total').html(total.toFixed(2));
    $('#total').val(total);
});

// order tax
$(document).on('keyup change', '#order_tax', function() {
    var discount = parseInt($('#discount').val());
    var other = parseInt($('#other_charge').val());
    var ship = parseInt($('#shiping_charge').val());
    var sub_total = parseInt($('#subtotal').val());
    var tax = parseInt($('#order_tax').val());
    var tax_amount = (sub_total * tax) / 100;
    var total = sub_total + ship + tax_amount + other - discount;
    $('.total').html(total.toFixed(2));
    $('#total').val(total);
});

// other charge
$(document).on('keyup change', '#other_charge', function() {
    var discount = parseInt($('#discount').val());
    var other = parseInt($('#other_charge').val());
    var ship = parseInt($('#shiping_charge').val());
    var sub_total = parseInt($('#subtotal').val());
    var tax = parseInt($('#order_tax').val());
    var tax_amount = (sub_total * tax) / 100;
    var total = sub_total + ship + tax_amount + other - discount;
    $('.total').html(total.toFixed(2));
    $('#total').val(total);
});


    // delete the row
$(document).on('click', '.delete_row', function() {
    var row_id = $(this).data('id');

    $("#table_row_" + row_id).fadeOut('slow').remove();
    calc();
});


$(document).on('keyup', '#search_product', function() {
    var val = $(this).val();
    $('#pos_loader').fadeIn();
    $('.product-cart-area').html('');
    $.ajax({
        url: '/admin/get_product_from_pos',
        type: 'GET',
        dataType: 'html',
        data: {
            val:val
        },
        success: function(data) {
            $('.product-cart-area').html(data);
            $('#pos_loader').fadeOut();
        }
    });
});

// make an error while pay now click if no product selected
$('#not_to_change').click(function() {
    toastr.error('Please Select At Least One Product Item');
})

// make an error while hold click if no product selected
$('#not_to_change_hold').click(function() {
    toastr.error('Please Select At Least One Product Item');
})


$(document).on('click', '.select_customer', function() {
    var id = $(this).data('id');
    $.ajax({
        url: '/admin/set_customer_for_pos',
        type: 'GET',
        dataType: 'json',
        data: {
            id:id
        },
        success: function(data) {
            $('.show_customer_list').html('');
            toastr.success(data.message);
            $('#customer_name').val(data.name);
            $('#customer_id').val(data.id);
            var due = data.due;
            $('#dueAmount').html(due);
            $('.edit_customer').attr('data-id' , data.id);
            $('.edit_customer_mobile').attr('data-id' , data.id);
        }
    });
});

$('#customer_name').focus(function() {
    $('#customer_name').val('');
    $.ajax({
        url: '/admin/show_customer_list_for_pos',
        type: 'GET',
        dataType: 'html',
        success: function(data) {
            $('.show_customer_list').html(data);
        }
    });
})

$('#search_category_wise').val('all').trigger('change');
$('#search_category_wise').change(function() {
    var cat_id = $(this).val();
    var url = $(this).data('url');

    $('.product-cart-area').html('');
    $('#pos_loader').fadeIn();
    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'html',
        data: {
            cat_id:cat_id
        },
        success: function(data) {
            $('.product-cart-area').html(data);
            $('#pos_loader').fadeOut();
        }
    });
});

// edit customer info
$('.edit_customer').click(function() {
    var id = $(this).data('id');
    var url = $(this).data('url');

    //open modal
    $('#modal_remote').modal('toggle');
    // leave it blank before ajax call
    $('.modal-body').html('');
    // load ajax loader
    $('#modal-loader').show();
    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'html',
        data: { id:id},
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

// edit_customer_mobile
$('.edit_customer_mobile').click(function() {
    var id = $(this).data('id');
    var url = $(this).data('url');

    //open modal
    $('#modal_remote').modal('toggle');
    // leave it blank before ajax call
    $('.modal-body').html('');
    // load ajax loader
    $('#modal-loader').show();
    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'html',
        data: { id:id},
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