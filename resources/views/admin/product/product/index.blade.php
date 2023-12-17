@extends('layouts.main', ['title' => ('Product Manage'), 'modal' => 'xl',])

@push('admin.css')
    <link rel="stylesheet" href="{{ asset('assets/datatable/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/datatable/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/datatable/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/summernote-bs4.css') }}">
@endpush

@section('header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Product Manage</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/home') }}"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                    <li class="breadcrumb-item active">Products</li>
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
            <h3 class="card-title">Create Or Manage Product</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div id="accordion">
                <!-- we are adding the .class so bootstrap.js collapse plugin detects it -->
                @can('product.create')
                    <div class="card card-info">
                        <a class="bg-info" data-toggle="collapse" data-parent="#accordion" href="#create">
                            <div class="card-header">
                                <h4 class="card-title">
                                    Create New Product
                                </h4>
                            </div>
                        </a>
                        <div id="create" class="panel-collapse collapse in">
                            <div class="card-body">
                                <form action="{{ route('admin.products.products.store') }}" method="post" id="content_form">
                                    @csrf
                                    <div class="row">
                                        {{-- Product Image --}}
                                        <div class="col-md-12 form-group">
                                            <label for="product_image">Product Image</label>
                                            <input type="file" name="product_image" id="product_image" class="form-control dropify"> <span class="text-danger">Product Image must be under 2000 KB and width & hieght can not be greater then 1900 pixel </span>
                                        </div>

                                        {{-- Status --}}
                                        <div class="col-md-6 form-group">
                                            <label for="status">Status <span class="text-danger">*</span></label>
                                            <select name="status" id="status" class="form-control select" required data-parsley-errors-container="#status_error">
                                                <option value="1" selected>Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                            <span id="status_error"></span>
                                        </div>

                                        {{-- Product Type --}}
                                        <div class="col-md-6 form-group">
                                            <label for="product_type">Product Type <span class="text-danger">*</span></label>
                                            <select name="product_type" id="product_type" class="form-control select" required data-parsley-errors-container="#product_type_error">
                                                <option value="Standard" selected>Standard</option>
                                                <option value="Service">Service</option>
                                            </select>
                                            <span id="product_type_error"></span>
                                        </div>

                                        {{-- Product Name --}}
                                        <div class="col-md-6 form-group">
                                            <label for="product_name">Product Name <span class="text-danger">*</span></label>
                                            <input type="text" name="product_name" id="product_name" class="form-control" required placeholder="Enter Product Name">
                                        </div>

                                        {{-- Product Code --}}
                                        <div class="col-md-6 form-group">
                                            <label for="product_code">Product Code <span class="text-danger">*</span></label>
                                            <div class="input-group"  data-target-input="nearest">
                                                <input data-parsley-errors-container="#product_code_error" type="text" name="product_code" id="product_code" class="form-control" required placeholder="Enter Product Name">
                                                <div class="input-group-append generate_random_number" style="cursor: pointer;" data-target="#timepicker" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-repeat"></i></div>
                                                </div>
                                            </div>
                                            <span id="product_code_error"></span>
                                        </div>

                                        {{-- Product Variation --}}
                                        <div class="col-md-12 form-group">
                                            <label for="product_variations">Product Variations <span class="text-danger">*</span></label>
                                            <select data-url="{{ route('admin.products.add_variations') }}" name="product_variations" id="product_variations" class="form-control select" data-placeholder="Select Product Variation" data-parsley-errors-container="#product_variations_errors">
                                                <option value="">Select Product Variation</option>
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                            <span id="product_variations"></span>
                                        </div>

                                        <div class="col-md-12" id="product_variations_data"></div>

                                        {{-- Product Cost --}}
                                        <div class="col-md-6 form-group mb-3" id="product_cost_area">
                                            <label for="product_cost">Product Cost Price<span class="text-danger">*</span></label>
                                            <input type="number" name="product_cost" id="product_cost" class="form-control" required placeholder="Enter Product Cost">
                                        </div>

                                        {{-- Product Price --}}
                                        <div class="col-md-6 form-group" id="product_price_area">
                                            <label for="product_price">Product Sell Price <span class="text-danger">*</span></label>
                                            <input type="number" name="product_price" id="product_price" class="form-control" required placeholder="Enter Product Price"><span class="text-danger" id="product_price_not_give"></span>
                                        </div>

                                        {{-- Product Category --}}
                                        <div class="col-md-6 form-group">
                                            <label for="product_category_id">Product Category</label>
                                            <div class="input-group"  data-target-input="nearest">
                                                <select name="product_category_id" data-placeholder="Select Category" id="product_category_id" class="form-control" >
                                                    <option value="">Select Category</option>
                                                    <option selected value="0">No Category</option>
                                                    @php
                                                        $category_query = App\Models\Products\Category::select('id', 'category_name')->where('status', 1)->get();
                                                    @endphp
                                                    @foreach ($category_query as $item)
                                                        <option value="{{ $item->id }}">{{ $item->category_name }}</option>
                                                    @endforeach
                                                </select>
                                                <div data-url="{{ route('admin.products.products.add_category') }}" title="Add New Category" class="input-group-append content_manage" style="cursor: pointer;">
                                                    <div class="input-group-text"><i class="fa fa-plus"></i></div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Product Supplier --}}
                                        <div class="col-md-6 form-group">
                                            <label for="supplier_id">Product Supplier</label>
                                            <div class="input-group"  data-target-input="nearest">
                                                <select name="supplier_id" data-placeholder="Select Category" id="supplier_id" class="form-control">
                                                    <option value="">Select Supplier</option>
                                                    <option selected value="0">No Supplier</option>
                                                    @php
                                                        $supplier_query = App\Models\Supplier::select('id', 'sup_name')->where('status', 1)->get();
                                                    @endphp
                                                    @foreach ($supplier_query as $item)
                                                        <option value="{{ $item->id }}">{{ $item->sup_name }}</option>
                                                    @endforeach
                                                </select>
                                                <div data-url="{{ route('admin.products.products.add_supplier') }}" title="Add New Supplier" class="input-group-append content_manage" style="cursor: pointer;">
                                                    <div class="input-group-text"><i class="fa fa-plus"></i></div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Product Brand --}}
                                        <div class="col-md-6 form-group">
                                            <label for="brand_id">Product Brand</label>
                                            <div class="input-group"  data-target-input="nearest">
                                                <select name="brand_id" data-placeholder="Select Brand" id="brand_id" class="form-control">
                                                    <option value="">Select Brand</option>
                                                    <option selected value="0">No Brand</option>
                                                    @php
                                                        $supplier_query = App\Models\Products\Brand::select('id', 'brand_name')->where('status', 1)->get();
                                                    @endphp
                                                    @foreach ($supplier_query as $item)
                                                        <option value="{{ $item->id }}">{{ $item->brand_name }}</option>
                                                    @endforeach
                                                </select>
                                                <div data-url="{{ route('admin.products.products.add_brand') }}" title="Add New Brand" class="input-group-append content_manage" style="cursor: pointer;">
                                                    <div class="input-group-text"><i class="fa fa-plus"></i></div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Barcode Symbiology --}}
                                        <div class="col-md-6 form-group">
                                            <label for="barcode_symbiology">Barcode Symbiology</label>
                                            <select name="barcode_symbiology" data-placeholder="Select Barcode Symbiology" id="barcode_symbiology" class="form-control select">
                                                <option value="">Select Barcode Symbiology</option>
                                                <option selected value="0">No Barcode Symbiology</option>
                                                <option value="code25">code25</option>
                                                <option value="code39">code39</option>
                                                <option value="code128">code128</option>
                                                <option value="ean5">ean5</option>
                                                <option value="ean13">ean13</option>
                                                <option value="upca">upca</option>
                                                <option value="upce">upce</option>
                                            </select>
                                        </div>

                                        {{-- Product Box --}}
                                        <div class="col-md-6 form-group">
                                            <label for="box_id">Product Box</label>
                                            <div class="input-group"  data-target-input="nearest">
                                                <select name="box_id" data-placeholder="Select Box" id="box_id" class="form-control">
                                                    <option value="">Select Box</option>
                                                    <option selected value="0">No Box</option>
                                                    @php
                                                        $supplier_query = App\Models\Products\Box::select('id', 'box_name')->where('status', 1)->get();
                                                    @endphp
                                                    @foreach ($supplier_query as $item)
                                                        <option value="{{ $item->id }}">{{ $item->box_name }}</option>
                                                    @endforeach
                                                </select>
                                                <div data-url="{{ route('admin.products.products.add_box') }}" title="Add New Box" class="input-group-append content_manage" style="cursor: pointer;">
                                                    <div class="input-group-text"><i class="fa fa-plus"></i></div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Product Unit --}}
                                        <div class="col-md-6 form-group">
                                            <label for="unit_id">Product Unit</label>
                                            <div class="input-group"  data-target-input="nearest">
                                                <select name="unit_id" data-placeholder="Select Unit" id="unit_id" class="form-control">
                                                    <option value="">Select Unit</option>
                                                    <option selected value="0">No Unit</option>
                                                    @php
                                                        $supplier_query = App\Models\Products\Unit::select('id', 'unit_name')->where('status', 1)->get();
                                                    @endphp
                                                    @foreach ($supplier_query as $item)
                                                        <option value="{{ $item->id }}">{{ $item->unit_name }}</option>
                                                    @endforeach
                                                </select>
                                                <div data-url="{{ route('admin.products.products.add_unit') }}" title="Add New Box" class="input-group-append content_manage" style="cursor: pointer;">
                                                    <div class="input-group-text"><i class="fa fa-plus"></i></div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Product Tax --}}
                                        <div class="col-md-6 form-group">
                                            <label for="tax_id">Product Tax</label>
                                            <div class="input-group"  data-target-input="nearest">
                                                <select name="tax_id" data-placeholder="Select Tax" id="tax_id" class="form-control">
                                                    <option value="">Select Tax</option>
                                                    <option selected value="0">No Tax</option>
                                                    @php
                                                        $supplier_query = App\Models\Products\TaxRate::where('status', 1)->get();
                                                    @endphp
                                                    @foreach ($supplier_query as $item)
                                                        <option value="{{ $item->id }}">{{ $item->tax_name }} ({{ $item->tax_rules == 'mod' ? $item->tax_rate . ' %' : $item->tax_rate . '+'}})</option>
                                                    @endforeach
                                                </select>
                                                <div data-url="{{ route('admin.products.products.add_tax') }}" title="Add New Tax" class="input-group-append content_manage" style="cursor: pointer;">
                                                    <div class="input-group-text"><i class="fa fa-plus"></i></div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Tax Method --}}
                                        <div class="col-md-6 form-group">
                                            <label for="tax_method">Tax Method <span class="text-danger">*</span></label>
                                            <select name="tax_method" id="tax_method" class="form-control select" data-parsley-errors-container="#tax_method_error" data-placeholder="Select Tax Method" required >
                                                <option value="">Select Tax Method</option>
                                                <option value="Inclusive" selected>Inclusive</option>
                                                <option value="Exclusive">Exclusive</option>
                                            </select>
                                            <span id="tax_method_error"></span>
                                        </div>

                                        {{-- Stock Alert --}}
                                        <div class="col-md-6 form-group">
                                            <label for="product_alert">Stock Alert <span class="text-danger">*</span></label>
                                            <input type="number" name="product_alert" id="product_alert" class="form-control" required placeholder="Enter Product Stock Alert" value="10">
                                        </div>

                                        {{-- HSN Code --}}
                                        <div class="col-md-6 form-group">
                                            <label for="hsn_code">HSN Code</label>
                                            <input type="text" placeholder="Enter HSN Code" name="hsn_code" id="hsn_code" class="form-control">
                                        </div>

                                        {{-- Product Description --}}
                                        <div class="col-md-12 form-group">
                                            <label for="product_details">Product Description</label>
                                            <textarea name="product_details" id="product_details" class="form-control summernote" cols="30" rows="2"></textarea>
                                        </div>
                                    </div>

                                    <button type="submit" id="submit" class="px-5 btn btn-primary float-right"><i class="fa fa-floppy-o mr-3" aria-hidden="true"></i>Submit</button>
                                    <button type="button" id="submiting" class="px-5 btn btn-sm btn-info float-right" id="submiting" style="display: none;">
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
                                Product List
                            </h4>
                        </div>
                    </a>
                    <div id="list" class="panel-collapse collapse">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered content_managment_table" data-url="{{ route('admin.products.products.datatable') }}">
                                    <thead>
                                        <tr>
                                            <th width="5%">ID</th>
                                            <th width="15%">Image</th>
                                            <th width="10%">Code</th>
                                            <th width="20%">Name</th>
                                            <th width="15%">Supplier</th>
                                            <th width="10%">Status</th>
                                            <th width="20%">Action</th>
                                            <th width="5%"><i class="fa fa-trash text-danger" aria-hidden="true"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th width="5%">ID</th>
                                            <th width="15%">Image</th>
                                            <th width="10%">Code</th>
                                            <th width="20%">Name</th>
                                            <th width="15%">Supplier</th>
                                            <th width="10%">Status</th>
                                            <th width="20%">Action</th>
                                            <th width="5%"><i class="fa fa-trash text-danger" aria-hidden="true"></i></th>
                                        </tr>
                                    </tfoot>
                                </table>
                                <div class="col-md-4 mx-auto">
                                    <button data-url="{{ route('admin.products.delete_multiple_item') }}" id="del_item" disabled class="btn btn-sm btn-block btn-danger">Delete</button>
                                </div>
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
<script src="{{ asset('assets/js//summernote-bs4.min.js') }}"></script>
<script src="{{ asset('js/pages/product/product.js') }}"></script>

@if ($product_sidebar == 'list')
    <script>
        $('#list').collapse("show");
    </script>
@elseif ($product_sidebar == 'create')
    <script>
        $('#create').collapse("show");
    </script>
@endif
@endpush
