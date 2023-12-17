@extends('layouts.main')

@section('header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Settings</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/home') }}"><i class="fa fa-home"
                                aria-hidden="true"></i>
                        </a></li>
                    <li class="breadcrumb-item active">Dashboard Settings</li>
                </ol>
            </div>
        </div>
    </div>
</section>
@endsection

@section('content')
<div class="card card-primary card-outline">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa fa-edit"></i>
            Change Your Dashboard Information Here 
        </h3>
    </div>
    <div class="card-body">
        <form action="{{ route ('admin.settings') }}" method="POST" class="ajax_form" enctype="multipart/form-data">
        @csrf
            <div class="row">
                <div class="col-5 col-sm-3">
                    <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist"
                        aria-orientation="vertical">
                        <a class="nav-link active" id="vert-tabs-home-tab" data-toggle="pill" href="#vert-tabs-home"
                            role="tab" aria-controls="vert-tabs-home" aria-selected="true">Product Init.</a>
                        {{-- <a class="nav-link" id="vert-tabs-profile-tab" data-toggle="pill" href="#vert-tabs-profile"
                            role="tab" aria-controls="vert-tabs-profile" aria-selected="false">Images</a>
                        <a class="nav-link" id="vert-tabs-messages-tab" data-toggle="pill" href="#vert-tabs-messages"
                            role="tab" aria-controls="vert-tabs-messages" aria-selected="false">Basic</a> --}}
                    </div>
                </div>
                <div class="col-7 col-sm-9">
                    <div class="tab-content" id="vert-tabs-tabContent">
                            
                        <div class="tab-pane text-left fade show active" id="vert-tabs-home" role="tabpanel" aria-labelledby="vert-tabs-home-tab">
                            <div class="row">
                                {{-- Product Init --}}
                                <div class="col-md-12 form-group">
                                    <label for="product_init">Product Initialization</label>
                                    <select name="product_init" class="form-control select" data-placeholder="Select An Option" id="">
                                        <option value="">Select An Option</option>
                                        <option {{get_option('product_init') == 1 ? 'selected' : '' }} value="1">ON</option>
                                        <option {{get_option('product_init') == 0 ? 'selected' : '' }} value="0">OFF</option>
                                    </select>
                                </div>

                                @if (get_option('product_init') == 1)
                                    {{-- Category --}}
                                    <div class="col-md-6 form-group">
                                        <label for="product_init_category">Product Category</label>
                                        <select name="product_init_category" class="form-control select" data-placeholder="Select An Option" id="">
                                            <option value="">Select An Option</option>
                                            <option {{get_option('product_init_category') == 1 ? 'selected' : '' }} value="1">ON</option>
                                            <option {{get_option('product_init_category') == 0 ? 'selected' : '' }} value="0">OFF</option>
                                        </select>
                                    </div>

                                    {{-- Brand --}}
                                    <div class="col-md-6 form-group">
                                        <label for="product_init_brand">Product Brand</label>
                                        <select name="product_init_brand" class="form-control select" data-placeholder="Select An Option" id="">
                                            <option value="">Select An Option</option>
                                            <option {{get_option('product_init_brand') == 1 ? 'selected' : '' }} value="1">ON</option>
                                            <option {{get_option('product_init_brand') == 0 ? 'selected' : '' }} value="0">OFF</option>
                                        </select>
                                    </div>

                                    {{-- Unit --}}
                                    <div class="col-md-6 form-group">
                                        <label for="product_init_unit">Product Unit</label>
                                        <select name="product_init_unit" class="form-control select" data-placeholder="Select An Option" id="">
                                            <option value="">Select An Option</option>
                                            <option {{get_option('product_init_unit') == 1 ? 'selected' : '' }} value="1">ON</option>
                                            <option {{get_option('product_init_unit') == 0 ? 'selected' : '' }} value="0">OFF</option>
                                        </select>
                                    </div>

                                    {{-- Box --}}
                                    <div class="col-md-6 form-group">
                                        <label for="product_init_box">Product Box</label>
                                        <select name="product_init_box" class="form-control select" data-placeholder="Select An Option" id="">
                                            <option value="">Select An Option</option>
                                            <option {{get_option('product_init_box') == 1 ? 'selected' : '' }} value="1">ON</option>
                                            <option {{get_option('product_init_box') == 0 ? 'selected' : '' }} value="0">OFF</option>
                                        </select>
                                    </div>

                                    {{-- TaxRate --}}
                                    <div class="col-md-6 form-group">
                                        <label for="product_init_taxrate">Product TaxRate</label>
                                        <select name="product_init_taxrate" class="form-control select" data-placeholder="Select An Option" id="">
                                            <option value="">Select An Option</option>
                                            <option {{get_option('product_init_taxrate') == 1 ? 'selected' : '' }} value="1">ON</option>
                                            <option {{get_option('product_init_taxrate') == 0 ? 'selected' : '' }} value="0">OFF</option>
                                        </select>
                                    </div>

                                    {{-- Size --}}
                                    <div class="col-md-6 form-group">
                                        <label for="product_init_size">Product Size</label>
                                        <select name="product_init_size" class="form-control select" data-placeholder="Select An Option" id="">
                                            <option value="">Select An Option</option>
                                            <option {{get_option('product_init_size') == 1 ? 'selected' : '' }} value="1">ON</option>
                                            <option {{get_option('product_init_size') == 0 ? 'selected' : '' }} value="0">OFF</option>
                                        </select>
                                    </div>

                                    {{-- Color --}}
                                    <div class="col-md-6 form-group">
                                        <label for="product_init_color">Product Color</label>
                                        <select name="product_init_color" class="form-control select" data-placeholder="Select An Option" id="">
                                            <option value="">Select An Option</option>
                                            <option {{get_option('product_init_color') == 1 ? 'selected' : '' }} value="1">ON</option>
                                            <option {{get_option('product_init_color') == 0 ? 'selected' : '' }} value="0">OFF</option>
                                        </select>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button id="submit" type="submit" class="btn btn-primary">Update</button>
                                    <button style="display: none;" id="submiting" type="button" disabled class="btn btn-primary">Loading..</button>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="vert-tabs-profile" role="tabpanel" aria-labelledby="vert-tabs-profile-tab">
                            
                        </div>
                        <div class="tab-pane fade" id="vert-tabs-messages" role="tabpanel"aria-labelledby="vert-tabs-messages-tab">
                            
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('admin.scripts')
<script>
    _componentSelect2Normal();
    _componentDatePicker();
    _classformValidation();
    _componentDatePicker();
    _componentDropFile();
</script>
@endpush