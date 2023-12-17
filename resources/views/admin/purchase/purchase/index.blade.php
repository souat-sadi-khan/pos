@extends('layouts.main', ['title' => ('Purchase Manage'), 'modal' => 'xl',])

@push('admin.css')
    <link rel="stylesheet" href="{{ asset('assets/datatable/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/datatable/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/datatable/css/buttons.bootstrap4.min.css') }}">
    <style>
        .custom-input-field .form-control{
            height: calc(1.2rem + 2px);
            font-size: 13px;
            text-align: right;
            user-select: none;
        }

        .cart-label{
            position: absolute;
            background-color: #7abaff;
            padding: 5px 10px;
            top: 150px;
        }

         .card-label-ico{
            font-size:13px;
            top:10px;
            border-radius: 50%;
            width:50px;
            right:10px;
        }
    </style>
@endpush

@section('header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Purchase Manage</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/home') }}"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                    <li class="breadcrumb-item active">Purchase</li>
                </ol>
            </div>
        </div>
    </div>
</section>
@endsection

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Create Or Manage Purchase's</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div id="accordion">
                <!-- we are adding the .class so bootstrap.js collapse plugin detects it -->
                @can('supplier.create')
                    <div class="card card-info">
                        <a class="bg-info" data-toggle="collapse" data-parent="#accordion" href="#create">
                            <div class="card-header">
                                <h4 class="card-title">
                                    Create New Purchase 
                                </h4>
                            </div>
                        </a>
                        <div id="create" class="panel-collapse collapse in">
                            <div class="card-body">
                                <form action="{{ route('admin.purchase.store') }}" method="post" id="content_form">
                                    <input type="hidden" name="purchase_number_of_product" id="number" value="0">
                                    @csrf
                                    <div class="row">
                                        {{-- Date --}}
                                        <div class="col-md-6 form-group">
                                            <label for="purchase_date">Date <span class="text-danger">*</span></label>
                                            <input type="text" name="purchase_date" id="purchase_date" class="form-control take_date" placeholder="Enter Purchase Date" required>
                                        </div>

                                        {{-- Ref. No --}}
                                        <div class="col-md-6 form-group">
                                            <label for="purchase_ref_no">Ref. No <span class="text-danger">*</span></label>
                                            <input type="text" name="purchase_ref_no" id="purchase_ref_no" class="form-control" required placeholder="Enter Reference Number">
                                        </div>

                                        {{-- Notes --}}
                                        <div class="col-md-12 form-group">
                                            <label for="purchase_note">Notes</label>
                                            <textarea name="purchase_note" id="purchase_note" class="form-control" placeholder="Enter Purchase NOte" cols="30" rows="2"></textarea>
                                        </div>

                                        {{-- Supplier --}}
                                        @if (isset($product))
                                            <div class="col-md-12 form-group">
                                                <label for="supplier_id">Supplier <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" value="{{$product->supplier_id != '' ? $product->supplier->sup_name : 'No Supplier'}}" readonly>
                                                <input type="hidden" name="supplier_id" value="{{ $product->supplier_id }}">
                                            </div>
                                        @else 
                                            <div class="col-md-12 form-group" id="main_supplier">
                                                <label for="supplier_id">Supplier <span class="text-danger">*</span></label>
                                                <select data-url="{{ route('admin.get_supplier_name_from_purchase_page') }}" name="supplier_id" id="supplier_id" class="form-control select" data-placeholder="Select Supplier First" required>
                                                    <option value="">Select Supplier First</option>
                                                    <option value="0">No Supplier</option>
                                                    @php
                                                        $supplier_query = App\Models\Supplier::select('id', 'sup_name')->where('status', 1)->get();
                                                    @endphp
                                                    @foreach ($supplier_query as $item)
                                                        <option value="{{ $item->id }}">{{ $item->sup_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div style="display: none;" class="col-md-12 form-group" id="supplier_id_input_field_area">
                                                <label for="supplier_id">Supplier <span class="text-danger">*</span></label>
                                                <input type="text" readonly id="supplier_id_input_field" class="form-control">
                                                <input type="hidden" readonly name="supplier_id" id="supplier_id_input_field_main" class="form-control">
                                            </div>

                                            <div class="col-md-12 p-2 mt-2 mb-4 shadow rounded" id="product_area" style="overflow-y:scroll; max-height:330px;display:none;">

                                            </div>
                                        @endif

                                        @if (isset($product) && $product->product_variations == 1)
                                            <div class="col-md-12 my-3">
                                            <div class="row p-2 mt-2 mx-2 shadow rounded" style="overflow-y:scroll; max-height:330px;">
                                                <div class="col-md-6 mb-3 bg-light">
                                                    <h4>Select Prodcuts</h4>
                                                </div>
                                                <div class="col-md-6 bg-light mb-3">
                                                    {{-- <select id="color_id" class="form-control float-left float-sm-right select_color" data-placeholder="Select Color">
                                                        <option value="">Select Color</option>
                                                        @php
                                                            $colors = App\Models\Products\Color::where('status', 1)->get();
                                                        @endphp
                                                        @foreach ($colors as $item)
                                                            <option value="{{ $item->id }}">{{ $item->color_name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <select id="size_id" class="form-control float-left float-sm-right select_color" data-placeholder="Select Color">
                                                        <option value="">Select Size</option>
                                                        @php
                                                            $colors = App\Models\Products\Size::where('status', 1)->get();
                                                        @endphp
                                                        @foreach ($colors as $item)
                                                            <option value="{{ $item->id }}">{{ $item->size_name }}</option>
                                                        @endforeach
                                                    </select> --}}
                                                    <button type="button" id="content_managment" data-url="{{ route('admin.add_product_from_purchase') }}" data-id="{{ $product->supplier_id }}" title="Add Product" class="btn btn-info btn-sm float-left float-sm-right">Add New Product</button>
                                                </div>
                                                @php
                                                    $products = App\Models\Products\Product::where('supplier_id', $product->supplier_id)->get();
                                                @endphp
                                                @if (count($products))
                                                    @foreach ($products as $product)
                                                        @php
                                                            $eachProduct = App\ProductVariation::where('product_id', $product->id)->get();
                                                        @endphp
                                                        @if ($eachProduct)
                                                            @foreach ($eachProduct as $item)
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

                                                        @if ($product->product_variations == 0)
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
                                                @endif
                                            </div>
                                        </div>
                                        @endif

                                        {{-- <button type="button" data-url="{{ route('admin.add_pruchase_row') }}" class="add-row">Add row</button> --}}
                                        <div style="font-size:12px;" class="table-responsive">
                                            <table id="tab_logic" class="table table-bordered table-striped purchase_table custom-input-field">
                                                <thead>
                                                    <tr class="table-info">
                                                        <th class="text-center" width="10%">Product</th>
                                                        <th class="text-center" width="5%">Available</th>
                                                        <th class="text-center" width="10%">Quantity</th>
                                                        <th class="text-center" width="10%">P. Cost Price</th>
                                                        <th class="text-center" width="10%">P. Sell Price</th>
                                                        <th class="text-center" width="10%">Item Tax</th>
                                                        <th class="text-right" width="43%">Net Total</th>
                                                        <th class="text-center" width="2%"><i class="fa fa-trash text-danger" aria-hidden="true"></i> </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if (isset($product) && $product->product_variations == '0')
                                                        @php
                                                            $tax_id = $product->tax_id;
                                                            if($tax_id != null) {
                                                                $tax = App\Models\Products\TaxRate::where('id', $tax_id)->first();
                                                                $tax_rate = $tax->tax_rate;
                                                                $tax_rules = $tax->tax_rules;
                                                                if($tax_rules == 'mod') {
                                                                    $tax_amount = $tax_rate * $product->product_price / 100;
                                                                } else {
                                                                    $tax_amount = $tax_rate + $product->product_price;
                                                                }
                                                            } else {
                                                                $tax_amount = 0;
                                                            }
                                                        @endphp
                                                        <tr>
                                                            <tr class="table-info">
                                                                <td class="text-center">{{$product->product_name}}
                                                                    <input type="hidden" name="product_id[]" value="{{ $product->id }}">
                                                                </td>
                                                                <td class="text-center">{{$product->stock}}</td>
                                                                <td><input type="text" class="form-control qty" data-id="" name="qty[]" id="qty" placeholder="Etner Quantity" value="1"></td>
                                                                <td><input type="number" class="form-control cost" name="cost[]" data-id="" id="cost" placeholder="Etner Quantity" value="{{ $product->product_cost }}"></td>
                                                                <td><input type="number" class="form-control sell_price" name="sell_price[]" data-id="" id="sell_price" placeholder="Etner Quantity" value="{{ $product->product_price }}"></td>
                                                                <td class="text-center">
                                                                    <span id="">
                                                                        @if ($product->tax_id == '') 
                                                                            No Tax
                                                                        @else
                                                                            {{ $product->tax->tax_name }} ({{$product->tax->tax_rate }} {{ $product->tax->tax_rules == 'mod' ? '%' : '+'}})
                                                                        @endif
                                                                        
                                                                        <input type="hidden" class="form-control product_tax input-sm" name="item_tax[]" id="item_tax" value="{{ $tax_amount }}">
                                                                    </span>
                                                                </td>
                                                                <td>
                                                                    <span id="net_total">
                                                                        <input type="text" class="form-control input-sm net_total" name="net_total[]" id="net_total" value="{{ $product->product_price_inc_tax }}">
                                                                    </span>
                                                                </td>
                                                                <td class="text-center">
                                                                    
                                                                </td>
                                                            </tr>
                                                        </tr>
                                                    @endif
                                                </tbody>
                                                <tfoot>
                                                    <tr class="table-secondary">
                                                        <td class="text-right" colspan="6"><b><label for="subtotal">Subtotal</label></b></td>
                                                        <td colspan="2" class="text-right"><input readonly placeholder="0.00" type="number" name="purchase_subtotal" id="subtotal" class="form-control" value="{{ (isset($product) && $product->product_variations == '0') ? $product->product_price_inc_tax : 0 }}"></td>
                                                    </tr>
                                                    <tr class="table-secondary">
                                                        <td class="text-right" colspan="6"><b><label for="order_tax">Order Tax (%)</label></b></td>
                                                        <td colspan="2" class="text-right"><input type="number" name="purchase_order_tax" id="order_tax" class="form-control" value="0"></td>
                                                    </tr>
                                                    <tr class="table-secondary">
                                                        <td class="text-right" colspan="6"><b><label for="shiping_charge">Shipping Charge (+)</label></b></td>
                                                        <td colspan="2" class="text-right"><input type="number" name="purchase_shiping_charge" id="shiping_charge" class="form-control"></td>
                                                    </tr>
                                                    <tr class="table-secondary">
                                                        <td class="text-right" colspan="6"><b><label for="other_charge">Other Charge (+)</label></b></td>
                                                        <td colspan="2" class="text-right"><input type="number" name="purchase_other_charge" id="other_charge" class="form-control"></td>
                                                    </tr>
                                                    <tr class="table-secondary">
                                                        <td class="text-right" colspan="6"><b><label for="discount">Discount (-)</label></b></td>
                                                        <td colspan="2" class="text-right"><input type="number" name="purchase_discount" id="discount" class="form-control"></td>
                                                    </tr>
                                                    <tr class="table-primary">
                                                        <td class="text-right" colspan="6"><b><label for="total">Payable Amount</label></b></td>
                                                        <td colspan="2" class="text-right"><input type="number" name="purchase_payable_amount" id="total" class="form-control" readonly placeholder="0.00" value="{{ (isset($product) && $product->product_variations == '0') ? $product->product_price_inc_tax : 0 }}" ></td>
                                                    </tr>
                                                    <tr class="table-warning">
                                                        <td class="text-right" colspan="6"><b><label for="payment_method">Payment Method</label></b></td>
                                                        <td colspan="2">
                                                            <select name="purchase_payment_method_id" class="form-control select" id="payment_method" required data-parsley-errors-container="#payment_method_error" data-placeholder="Select Payment Method">
                                                                <option value="">Select Payment Method</option>
                                                                @php
                                                                    $p_query = App\Models\PaymentMethod::where('status', 1)->get();
                                                                @endphp
                                                                @foreach ($p_query as $item)
                                                                    <option value="{{ $item->id }}">{{ $item->method_name }}</option>
                                                                @endforeach
                                                            </select>
                                                            <span id="payment_method_error"></span>
                                                            <div id="payment_method_info"></div>
                                                        </td>
                                                    </tr>
                                                    <tr class="table-success">
                                                        <td class="text-right" colspan="6"><b><label for="paid">Paid Amount</label></b></td>
                                                        <td colspan="2" class="text-right" style="font-size: 15px;"><input type="number" class="form-control" name="purchase_paid_amount" id="paid" required value="{{ (isset($product) && $product->product_variations == '0') ? $product->product_price_inc_tax : 0 }}"></td>
                                                    </tr>
                                                    <tr class="table-danger">
                                                        <td class="text-right" colspan="6"><b><label for="due">Due Amount</label></b></td>
                                                        <td colspan="2" class="text-right"><input type="number" class="form-control" name="purchase_due_amount" id="due" readonly value="0"></td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>

                                    <button type="submit" id="submit" class="btn btn-primary float-right px-5"><i class="fa fa-floppy-o mr-3" aria-hidden="true"></i>Submit</button>
                                    <button type="button" id="submiting" class="btn btn-sm btn-info float-right px-5" id="submiting" style="display: none;">
                                        <i class="fa fa-spinner fa-spin fa-fw"></i>Loading...</button>
                                
                                    <button type="button" class="btn btn-sm btn-danger" id="close">Close</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endcan

                <div class="card card-primary">
                    <a class="bg-primary" data-toggle="collapse" data-parent="#accordion" href="#list">
                        <div class="card-header">
                            <h4 class="card-title">
                                Purchse List 
                            </h4>
                        </div>
                    </a>
                    <div id="list" class="panel-collapse collapse">
                        <div class="card-body">
                            <div class="table-responsive">
                                    <table class="table table-hover table-bordered content_managment_table" data-url="{{ route('admin.purchase_product.datatable') }}">
                                        <thead>
                                            <tr>
                                                <th width="10%">Date</th>
                                                <th width="10%">Invoice</th>
                                                <th width="10%">Supplier</th>
                                                <th width="10%">Creator</th>
                                                <th width="10%">Amount</th>
                                                <th width="10%">Paid</th>
                                                <th width="10%">Due</th>
                                                <th width="10%">Status</th>
                                                <th width="20%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                    
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th width="10%">Date</th>
                                                <th width="10%">Invoice</th>
                                                <th width="10%">Supplier</th>
                                                <th width="10%">Creator</th>
                                                <th width="10%">Amount</th>
                                                <th width="10%">Paid</th>
                                                <th width="10%">Due</th>
                                                <th width="10%">Status</th>
                                                <th width="20%">Action</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
@endsection

@push('admin.scripts')
<script src="{{ asset('assets/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/datatable/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/datatable/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/datatable/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/datatable/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/datatable/js/buttons.flash.min.js') }}"></script>
<script src="{{ asset('assets/datatable/js/jszip.min.js') }}"></script>
<script src="{{ asset('assets/datatable/js/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/datatable/js/vfs_fonts.js') }}"></script>
<script src="{{ asset('assets/datatable/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/datatable/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('js/pages/purchase/purchase.js') }}"></script>
@if ($purchase_sidebar == 'list')
    <script>
        $('#list').collapse("show");
    </script>
@elseif ($purchase_sidebar == 'create')
    <script>
        $('#create').collapse("show");
    </script>
@endif
@endpush
