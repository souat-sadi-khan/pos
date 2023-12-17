@extends('layouts.main', ['title' => ('Bank Account Manage'), 'modal' => 'xl',])

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
                <h1>Bank Account Manage</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/home') }}"><i class="fa fa-home"
                                aria-hidden="true"></i></a></li>
                    <li class="breadcrumb-item active">Bank Account</li>
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
            <h3 class="card-title">Create Or Manage Bank Account</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div id="accordion">
                <!-- we are adding the .class so bootstrap.js collapse plugin detects it -->
                {{-- @can('customer.create') --}}
                    <div class="card card-info">
                        <a class="bg-info" data-toggle="collapse" data-parent="#accordion" href="#create">
                            <div class="card-header">
                                <h4 class="card-title">
                                    Create New Bank Account
                                </h4>
                            </div>
                        </a>
                        <div id="create" class="panel-collapse collapse in">
                            <div class="card-body">
                                <form action="{{ route('admin.account.bank-account.store') }}" method="post" id="content_form">
                                    @csrf

                                    <div class="row">

                                        {{-- Account Name --}}
                                        <div class="col-md-6 form-group">
                                            <label for="account_name">Account Name <span class="text-danger">*</span></label>
                                            <input autocomplete="off" type="text" name="account_name" id="account_name" class="form-control" placeholder="Enter Account Name" required>
                                        </div>

                                        {{-- Account Number --}}
                                        <div class="col-md-6 form-group">
                                            <label for="account_no">Account Number <span class="text-danger">*</span></label>
                                            <input autocomplete="off" type="text" name="account_no" id="account_no" class="form-control" placeholder="Enter Account Number" required>
                                        </div>

                                        {{-- Phone --}}
                                        <div class="col-md-6 form-group">
                                            <label for="phone">Phone <span class="text-danger">*</span></label>
                                            <input autocomplete="off" type="text" name="phone" id="phone" class="form-control" placeholder="Enter Phone Number" required>
                                        </div>

                                        {{-- Contact Person --}}
                                        <div class="col-md-6 form-group">
                                            <label for="contact_person">Contact Person <span class="text-danger">*</span></label>
                                            <input autocomplete="off" type="text" name="contact_person" id="contaact_person" class="form-control" placeholder="Enter Contact Person Name" required>
                                        </div>

                                        {{-- Internet Banking URL --}}
                                        <div class="col-md-6 form-group">
                                            <label for="account_url">Internet Banking URL</label>
                                            <input autocomplete="off" type="text" name="account_url" id="account_url" class="form-control" placeholder="Enter Internet Banking URL">
                                        </div>

                                        {{-- Status --}}
                                        <div class="col-md-6 form-group">
                                            <label for="status">Status <span class="text-danger">*</span></label>
                                            <select required name="status" id="status" class="form-control select" data-placeholder="Select Status" data-parsley-errors-container="#status_error">
                                                <option value="">Select Status</option>
                                                <option value="1" selected>Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>

                                        {{-- Account Details --}}
                                        <div class="col-md-12 form-group">
                                            <label for="account_details">Account Details</label>
                                            <textarea name="account_details" id="account_details" cols="30" rows="2" class="form-control" placeholder="Enter Account Details"></textarea>
                                        </div>

                                    </div>
                                    

                                    <button type="submit" id="submit" class="btn btn-primary float-right px-5">Submit</button>
                                    <button type="button" id="submiting" class="btn btn-sm btn-info float-right px-5" id="submiting" style="display: none;">
                                        <i class="fa fa-spinner fa-spin fa-fw"></i>Loading...</button>
                                
                                    <button type="button" class="btn btn-sm btn-danger" id="close">Close</button>
                                </form>
                            </div>
                        </div>
                    </div>
                {{-- @endcan --}}

                <div class="card card-primary">
                    <a class="bg-primary" data-toggle="collapse" data-parent="#accordion" href="#list">
                        <div class="card-header">
                            <h4 class="card-title">
                                All Bank Account List 
                            </h4>
                        </div>
                    </a>
                    <div id="list" class="panel-collapse collapse">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered content_managment_table" data-url="{{ route('admin.account.bank-account.datatable') }}">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>status</th>
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
<script src="{{ asset('js/pages/account/bank_account.js') }}"></script>
@if ($bank_account_sidebar == 'list')
    <script>
        $('#list').collapse("show");
    </script>
@elseif ($bank_account_sidebar == 'create')
    <script>
        $('#create').collapse("show");
    </script>
@endif
@endpush
