@extends('layouts.main', ['title' => ('Supplier Manage'), 'modal' => 'xl',])

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
                <h1>Supplier Manage</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/home') }}"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                    <li class="breadcrumb-item active">Supplier</li>
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
            <h3 class="card-title">Create Or Manage Supplier's</h3>
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
                                    Create New Supplier
                                </h4>
                            </div>
                        </a>
                        <div id="create" class="panel-collapse collapse in">
                            <div class="card-body">
                                <form action="{{ route('admin.supplier.store') }}" method="post" id="content_form">
                                    @csrf
                                    <div class="row">
                                        {{-- Name --}}
                                        <div class="col-md-6 form-group">
                                            <label for="sup_name">Name <span class="text-danger">*</span></label>
                                            <input type="text" name="sup_name" id="sup_name" class="form-control" placeholder="Enter Supplier Name" required>
                                        </div>

                                        {{-- Code Name --}}
                                        <div class="col-md-6 form-group">
                                            <label for="code_name">Code Name <span class="text-danger">*</span></label>
                                            <input type="text" name="code_name" id="code_name" class="form-control" placeholder="Enter Supplier Code Name" required>
                                        </div>

                                        {{-- Phone --}}
                                        <div class="col-md-6 form-group">
                                            <label for="sup_mobile">Phone <span class="text-danger">*</span></label>
                                            <input type="text" name="sup_mobile" id="sup_mobile" class="form-control" placeholder="Enter Supplier Phone" required>
                                        </div>

                                        {{-- Email --}}
                                        <div class="col-md-6 form-group">
                                            <label for="sup_email">Email</label>
                                            <input type="email" name="sup_email" id="sup_email" class="form-control" placeholder="Enter Supplier Email">
                                        </div>

                                        {{-- Address --}}
                                        <div class="col-md-12 form-group">
                                            <label for="sup_address">Address</label>
                                            <textarea name="sup_address" id="sup_address" class="form-control" placeholder="Ener Supplier Address" cols="30" rows="2"></textarea>
                                        </div>

                                        {{-- City --}}
                                        <div class="col-md-6 form-group">
                                            <label for="sup_city">City</label>
                                            <input type="text" name="sup_city" id="sup_city" class="form-control" placeholder="Enter Supplier City">
                                        </div>

                                        {{-- State --}}
                                        <div class="col-md-6 form-group">
                                            <label for="sup_state">State</label>
                                            <input type="text" name="sup_state" id="sup_state" class="form-control" placeholder="Enter Supplier State">
                                        </div>

                                        {{-- Country --}}
                                        <div class="col-md-6 form-group">
                                            <label for="sup_country">Country</label>
                                            <input type="text" name="sup_country" id="sup_country" class="form-control" placeholder="Enter Supplier Country" value="Bangladesh">
                                        </div>

                                        {{-- Status --}}
                                        <div class="col-md-6 form-group">
                                            <label for="status">Status <span class="text-danger">*</span></label>
                                            <select data-parsley-errors-container="#status_error" required name="status" id="status" class="form-control select" data-placeholder="Select Customer Status">
                                                <option value="">Select Supplier Status</option>
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                            <span id="status_error"></span>
                                        </div>

                                        {{-- Details --}}
                                        <div class="col-md-12 form-group">
                                            <label for="sup_details">Details</label>
                                            <textarea name="sup_details" id="sup_details" cols="30" rows="2" class="form-control" placeholder="Enter Supplier Details Information"></textarea>
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
                                Supplier List 
                            </h4>
                        </div>
                    </a>
                    <div id="list" class="panel-collapse collapse">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered content_managment_table" data-url="{{ route('admin.supplier.datatable') }}">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Phone</th>
                                                <th>Product</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                    
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Phone</th>
                                                <th>Product</th>
                                                <th>Date</th>
                                                <th>Status</th>
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
<script src="{{ asset('js/pages/supplier.js') }}"></script>
@endpush
