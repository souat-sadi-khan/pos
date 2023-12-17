<div class="row">
    <div class="col-md-6 mb-3 bg-light">
        <h4>Select Prodcuts</h4>
    </div>
    <div class="col-md-6 bg-light mb-3">
        <button type="button" id="content_managment" data-url="{{ route('admin.add_product_from_purchase') }}" data-id="{{ $supplier_Id }}" title="Add Product" class="btn btn-info btn-sm float-left float-sm-right"><i class="fa fa-plus-circle mr-3" aria-hidden="true"></i> Add New Product</button>
    </div>
    @if (count($products))
        @foreach ($products as $product)
            @php
                $product_variations = $product->product_variations;
            @endphp
            @if ($product_variations == 1)
                @php
                    $query = App\ProductVariation::where('product_id', $product->id)->get();
                @endphp
                @if (count($query))
                    @foreach ($query as $item)
                        <div class="col-md-2 text-center">
                            <div data-url="{{ route('admin.add_pruchase_row') }}" data-product_id="{{ $product->id }}" data-id="{{ $item->id }}" style="cursor: pointer;" class="card add-row">
                                <img class="card-img-top" src="{{ $product->product_image == '' ? asset('images/product.jpg') : asset('storage/images/product/product'. '/'. $product->product_image) }}" alt="Product image">
                                @if ($product->brand_id != '')
                                    <label class="cart-label card-label-ico text-center">{{ $product->brand->brand_name }}</label>
                                @endif
                                @if ($product->category_id != '')
                                    <label class="cart-label text-light">{{ $product->category->category_name }}</label>
                                @endif
                                <div class="card-body">
                                    <p class="card-text text-center ">
                                        <b>{{ substr($product->product_name, 0, 20) . ''. (strlen($product->product_name) > 20 ? '...' : '') }}({{ $product->product_code }})</b> <br>
                                        @if ($item->size_id != '')
                                            Size : {{$item->size->size_name}} <br>
                                        @endif
                                        @if ($item->color_id != '')
                                            Color : {{$item->color->color_name}}
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div> 
                    @endforeach
                @endif
            @else 
                <div class="col-md-2 text-center">
                    <div data-url="{{ route('admin.add_pruchase_row') }}" data-product_id="{{ $product->id }}" data-id="{{ $product->id }}" style="cursor: pointer;" class="card add-row">
                        <img class="card-img-top" src="{{ $product->product_image == '' ? asset('images/product.jpg') : asset('storage/images/product/product'. '/'. $product->product_image) }}" alt="Product image">
                        @if ($product->brand_id != '')
                            <label class="cart-label card-label-ico text-center">{{ $product->brand->brand_name }}</label>
                        @endif
                        @if ($product->category_id != '')
                            <label class="cart-label text-light">{{ $product->category->category_name }}</label>
                        @endif
                        <div class="card-body">
                            <p class="card-text text-center" style="min-height: 97px;">
                                <b>{{ substr($product->product_name, 0, 20) . ''. (strlen($product->product_name) > 20 ? '...' : '') }}({{ $product->product_code }})</b> <br>
                                Size: N/A   <br>
                                Color: N/A
                            </p>
                        </div>
                    </div>
                </div> 
            @endif
        @endforeach
    @else 
        <div class="col-md-12">
            <p class="text-center text-danger">Sorry. No Product Found For This Supplier</p>
        </div>
    @endif
</div>

<script>
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
                calc();
                toastr.success('Product is added into Cart Successfully');
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

</script>