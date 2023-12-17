@extends('layouts.main', ['title' => ('Payment Method Manage'), 'modal' => 'xl',])

@push('admin.css')
    <link rel="stylesheet" href="{{ asset('assets/datatable/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/datatable/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/datatable/css/buttons.bootstrap4.min.css') }}">
@endpush

@section('header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Payment Method Manage</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/home') }}"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                    <li class="breadcrumb-item active">Payment Method</li>
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
            <h3 class="card-title">Create Or Manage Payment Method</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div id="accordion">
                <!-- we are adding the .class so bootstrap.js collapse plugin detects it -->
                @can('brand.create')
                    <div class="card card-info">
                        <a class="bg-info" data-toggle="collapse" data-parent="#accordion" href="#create">
                            <div class="card-header">
                                <h4 class="card-title">
                                    Create New Payment Method
                                </h4>
                            </div>
                        </a>
                        <div id="create" class="panel-collapse collapse in">
                            <div class="card-body">
                                <form action="{{ route('admin.product-initiazile.payment-method.store') }}" method="post" id="content_form">
                                    @csrf
                                    <div class="row">

                                        {{-- Payment Method Name --}}
                                        <div class="col-md-4 form-group">
                                            <label for="method_name">Payment Method Name <span class="text-danger">*</span></label>
                                            <input type="text" name="method_name" id="method_name" class="form-control" placeholder="Enter Payment Method Name" required>
                                        </div>

                                        {{-- Payment Method Code --}}
                                        <div class="col-md-4 form-group">
                                            <label for="method_code_name">Payment Method Code Name <span class="text-danger">*</span></label>
                                            <input type="text" name="method_code_name" id="method_code_name" class="form-control" placeholder="Enter Payment Method Code Name" required>
                                        </div>

                                        {{-- Status --}}
                                        <div class="col-md-4 form-group">
                                            <label for="status">Status <span class="text-danger">*</span></label>
                                            <select data-parsley-errors-container="#status_error" required name="status" id="status" class="form-control select" data-placeholder="Select Status">
                                                <option value="">Select Status</option>
                                                <option selected value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                            <span id="status_error"></span>
                                        </div>

                                        {{-- Method Has Transection ID --}}
                                        <div class="col-md-6 form-group">
                                            <label for="method_has_txr_id">Method Has Transection ID <span class="text-danger">*</span></label>
                                            <select name="method_has_txr_id" id="method_has_txr_id" class="form-control select" data-placeholder="Select Option" data-parsley-errors-container="#method_has_txr_id_error" required>
                                                <option value="">Select Option</option>
                                                <option value="1">Yes</option>
                                                <option selected value="0">No</option>
                                            </select>
                                            <span id="method_has_txr_id_error"></span>
                                        </div>

                                        {{-- Method Has Mobile Number --}}
                                        <div class="col-md-6 form-group">
                                            <label for="method_has_mob_no">Method Has Mobile Number <span class="text-danger">*</span></label>
                                            <select name="method_has_mob_no" id="method_has_mob_no" class="form-control select" data-placeholder="Select Option" data-parsley-errors-container="#method_has_mob_no_error" required>
                                                <option value="">Select Option</option>
                                                <option value="1">Yes</option>
                                                <option selected value="0">No</option>
                                            </select>
                                            <span id="method_has_mob_no_error"></span>
                                        </div>

                                        {{-- Payment Method Details --}}
                                        <div class="col-md-12 form-group">
                                            <label for="method_details">Payment Method Details</label>
                                            <textarea name="method_details" id="method_details" class="form-control" cols="30" rows="2" placeholder="Enter Payment Method Description"></textarea>
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
                                Payment Method List 
                            </h4>
                        </div>
                    </a>
                    <div id="list" class="panel-collapse collapse">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered content_managment_table" data-url="{{ route('admin.product-initiazile.payment-method.datatable') }}">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Code Name</th>
                                            <th>Status</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Code Name</th>
                                            <th>Status</th>
                                            <th>Created At</th>
                                            <th>Action</th>
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
<script src="{{ asset('js/pages/payment-method.js') }}"></script>
@endpush
