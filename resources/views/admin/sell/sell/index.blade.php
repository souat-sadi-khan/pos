@extends('layouts.main', ['title' => ('Point of Sell'), 'modal' => 'xl',])

@push('admin.css')
<link rel="stylesheet" href="{{ asset('assets/css/pos.css') }}">
@endpush

@section('content')
    <div class="background pt-2">

        <div class="row">
                <div class="col-md-5">
                    <div id="right-panel" class="pos-content" style="">
                        <div class="invoice-area">
                            <div class="well well-sm">
                                
                                <!-- Customer Area Start-->
                                <div id="people-area">
                                    <input type="text" id="customer_name" name="customer_name" autocomplete="off" class="ng-pristine ng-valid ng-not-empty ng-touched" value="Walking Customer (01700000000)">
                                    <input type="hidden" name="customer_id" id="customer_id" value="1" autocomplete="off">
                                    <div class="customer-icon">
                                        <a ng-click="showCustomerList(true)" onclick="return false;" href="#">
                                        <span class="h4 text-muted"> <i class="fa fa-user-circle" aria-hidden="true"></i> </span> 
                                        </a>
                                    </div>
                                    <div class="edit-icon pointer">
                                        <span style="cursor: pointer;" class="fa edit_customer fa-edit" data-id="1" data-url="{{ route('admin.edit_customer_from_pos') }}"></span>
                                        <span style="cursor: pointer;" id="add-customer-mobile-number-handler" class="fa fa-mobile edit_customer_mobile" data-id="1" data-url="{{ route('admin.edit_customer_mobile_from_pos') }}" style="font-size:18px;margin-left:5px;"></span>
                                        <input id="customer-mobile-number" type="hidden" name="customer-mobile-number" autocomplete="off">
                                    </div>
                                    <div ng-click="createNewCustomer();" class="add-icon add_new_customer" id="content_managment" data-url="{{ route('admin.creaet_customer_from_pos') }}">
                                    <span class="svg-icon h3"> <i class="fa fa-plus mt-2" aria-hidden="true"></i> </span>     
                                    </div>
                                    <div class="previous-due">
                                        <div class="previous-due-inner">
                                            <h4>
                                                Due
                                                    <span id="dueAmount" class="ng-binding">
                                                        0.00
                                                    </span>
                                                
                                            </h4>
                                        </div>
                                    </div>
                                    <div ng-hide="hideCustomerDropdown" id="customer-dropdown" class="slidedown-menu ps ps--theme_default ng-hide" data-ps-id="c410e396-4824-97f6-52de-5e81ed1ac724">
                                        <div class="slidedown-header">
                                        </div>
                                        <div class="slidedown-body">
                                            <ul class="customer-list list-unstyled">
                                                <!-- ngRepeat: customers in customerArray -->
                                            </ul>
                                        </div>
                                    <div class="ps__scrollbar-x-rail" style="left: 0px; bottom: 0px;"><div class="ps__scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__scrollbar-y-rail" style="top: 0px; right: 0px;"><div class="ps__scrollbar-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
                                </div>
                                <div class="show_customer_list"></div>
                                <!-- Customer Area Start-->
    
                                <!-- Invoice Item Start-->
                                <div id="invoice-item">
                                    <!-- Selected Product List Title Start -->
                                    <div class="invoice-table"> 
                                    <table id="invoice-item-head" class="table table-striped table-bordered sell_table">
                                        <thead>
                                            <tr class="bg-gray">
                                                <th>
                                                    Product	
                                                </th> 
                                                <th>
                                                    Quantity												
                                                </th>
                                                <th>
                                                    Price												
                                                </th>
                                                <th>
                                                    Subtotal												
                                                </th>
                                                <th>&nbsp; </th>
                                            </tr>
                                        </thead>
                                        <tbody>
    
                                        </tbody>
                                    </table>
                                    </div>
                                    <!-- Selected Product List Title Start --> 
                                    
                                    <!-- Selected Product Calculation Section Start-->
                                    <div id="invoice-calculation" class="clearfix">
                                        <table class="table">
                                            <tbody>
                                                <tr class="bg-gray">
                                                    <td width="30%">
                                                        Total Item													
                                                    </td>
                                                    <td class="text-right total_item ng-binding" width="20%">
                                                        0 (<span id="total_qty">0</span> )
    
                                                        <input type="hidden" id="total_qty" value="0">
                                                        <input type="hidden" id="total_item" value="0">
                                                    </td>
                                                    <td width="30%">
                                                        Total													
                                                    </td>
                                                    <td class="text-right ng-binding" width="20%">
                                                        {{ get_option('currency_symbol') }} <span class="sub_total">0.00</span> 
                                                        <input type="hidden" name="subtotal" id="subtotal" value="0">
                                                    </td>
                                                </tr>
                                                <tr class="pay-top">
                                                    <td>
                                                        Discount													</td>
                                                    <td class="text-right">
                                                        <input id="discount" required name="discount" autocomplete="off" class="ng-pristine ng-untouched ng-valid ng-not-empty" value="0">
                                                    </td>
                                                    <td>
                                                        Tax Amount (%)
                                                    </td>
                                                    <td class="text-right">
                                                        <input type="text" name="order_tax" id="order_tax" autocomplete="off" class="ng-pristine ng-untouched ng-valid ng-not-empty" value="0">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Shipping Charge													</td>
                                                    <td class="text-right">
                                                        <input class="text-center shipping ng-pristine ng-untouched ng-valid ng-not-empty" id="shiping_charge" name="shiping_charge" autocomplete="off" value="0">
                                                    </td>
                                                    <td>
                                                        Other Charge													</td>
                                                    <td class="text-right">
                                                        <input class="text-center others-charge ng-pristine ng-untouched ng-valid ng-not-empty" id="other_charge" name="other_charge" autocomplete="off" value="0">
                                                    </td>
                                                </tr>
                                                <tr class="bg-gray">
                                                    <td colspan="3">
                                                        Total Payable													</td>
                                                    <td class="text-right total ng-binding">
                                                        0.00
                                                    </td>
                                                    <input type="hidden" name="total" id="total" value="0">
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- Selected Product Calculation Section End-->
                                </div>
                                <!-- Invoice Item End-->
    
                                <!-- Action Button Section Start-->
                                <div id="pay-button" class="text-center py-4">
                                    <div class="btn-group btn-group-justified">
                                        <div class="btn-group">
                                            <button type="button" data-url="{{ route('admin.send-pos-item') }}" id="pay_now" class="btn btn-success pay_now px-5" id="not_to_change" title="Payment">
                                                <span class="fa fa-fw fa-money"></span> 
                                                Pay Now											
                                            </button>
                                        </div>
                                        <div class="btn-group">
                                            <button class="btn btn-danger hold px-5" id="not_to_change_hold" title="Order Holdinbg">
                                                <span class="fa fa-fw fa-crosshairs"></span> 
                                                Hold											</button>
                                        </div>
                                    </div>
                                </div>
                                <!-- Action Button Section End-->
                                
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>

            {{-- Product Area --}}
            <div class="col-md-7">
                <div style="position: fixed;transform: translate(-50%, -50%);
                top: 50%;left: 70%;z-index:100; display:none;" id="pos_loader">
                    <i class="fa fa-spinner fa-spin fa-5x fa-fw"></i><h3>Loading...</h3>
                </div>
                {{-- Search Options --}}
                <div class="search-option">
                    <div class="row">
                        {{-- Search Option --}}
                        <div class="col-md-8">
                            {{-- Search Input Field --}}
                            <input type="text" id="search_product" class="form-control" placeholder="Enter Product Name">
                        </div>
                        <div class="col-md-4">
                            {{-- Search Select Box --}}
                            <select id="search_category_wise" data-url="{{ route('admin.get_product_by_category') }}" class="form-control select" data-placeholder="View All">
                                @php
                                    $all = 0;
                                    $no_category = 0;
                                    $products = App\Models\Products\Product::where('status', 1)->get();
                                    foreach($products as $product) {
                                        if($product->product_variations == 1) {
                                            $p_variation = App\ProductVariation::where('product_id', $product->id)->get();
                                            $number_of_product = count($p_variation);
                                            $all = $all + $number_of_product;
                                            $no_category = $no_category + $number_of_product;
                                        } else {
                                            $all ++;
                                            $no_category ++;
                                        }
                                    }
                                @endphp
                                <option value="all">View All ({{$all}})</option>
                                <option value="0">No Category ({{$no_category}})</option>
                                @php
                                    $categories = App\Models\Products\Category::where('status', 1)->get();
                                @endphp
                                @foreach ($categories as $item)
                                    @php
                                        $all = 0;
                                        $products = App\Models\Products\Product::where('status', 1)->where('category_id', $item->id)->get();
                                        foreach($products as $product) {
                                            if($product->product_variations == 1) {
                                                $p_variation = App\ProductVariation::where('product_id', $product->id)->get();
                                                $number_of_product = count($p_variation);
                                                $all = $all + $number_of_product;
                                            } else {
                                                $all ++;
                                            }
                                        }
                                    @endphp
                                    <option value="{{ $item->id }}">{{ $item->category_name }} ({{$all}})</option>
                                @endforeach
                            </select>
                        </div>
                        
                    </div>
                </div>

                {{-- Product Cart --}}
                <div class="product-cart-area my-3">
                    <div class="row pl-2">
                        @php
                            $products = App\Models\Products\Product::where('product_alert', '<', 'stock')->where('status', 1)->get();
                        @endphp
                        @if (count($products) > 0)
                            @foreach ($products as $product)
                                @include('admin.sell.product')
                            @endforeach
                        @else 
                            <h2>No Product Found</h2>
                        @endif
                    </div>
                </div>
                <div class="">
                    <div class="bg-warning">
                        <p class="text-center h1 font-weight-bold text-white"> {{ get_option('currency_symbol') }} <span class="total">0.00</span> </p>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" id="number" value="0">
    </div>
@endsection

@push('admin.scripts')
<script src="{{ asset('js/pages/sell/sell.js') }}"></script>

{{-- Get Product By Category --}}
<script>

function hisab(data  = 'qty')
{
    
    var result = [];
    $('.sell_table tbody tr').each(function(i, element) {
        var html = $(this).html();
        if(html!='')
        {
            result.push($(this).find('.'+data).val());
            // var sell_price = $(this).find('.sell_price').val();
            // $(this).find('.net_total').val((qty*sell_price).toFixed(2));
            
            // calc_total();
        }
      
    });
    
        return result;
}

    $('#pay_now').click(function() {
        if(hisab('net_total') == '') {
            toastr.error('Please Select At Least One Product To Buy!');
        } else {
            var customer_name = $('#customer_name').val();
        var customer_id = $('#customer_id').val();
        var discount = $('#discount').val();
        var order_tax = $('#order_tax').val();
        var shiping_charge = $('#shiping_charge').val();
        var other_charge = $('#other_charge').val();
        var total = $('#total').val();
        
        var qty = hisab();
        var total_price = hisab('net_total');
        var product_id = hisab('product_id');
        var sell_price = hisab('sell_price');
        var product_variations_id = hisab('product_variations_id');


        $('#modal_remote').modal('toggle');
        // it will get action url
        
        var url = $(this).data('url');
            // leave it blank before ajax call
            $('.modal-body').html('');
            // load ajax loader
            $('#modal-loader').show();
            $.ajax({
                url: url,
                type: 'POST',
                dataType: 'html',
                data: { 
                    customer_name:customer_name,
                    customer_id:customer_id,
                    discount:discount,
                    order_tax:order_tax,
                    shiping_charge:shiping_charge,
                    other_charge:other_charge,
                    total:total,
                    qty:qty,
                    total_price:total_price,
                    product_id:product_id,
                    sell_price:sell_price,
                    product_variations_id:product_variations_id
                },
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

        }
        

        // alert(html);
    })
</script>
@endpush
