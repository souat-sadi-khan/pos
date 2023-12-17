@extends('layouts.main', ['title' => ('Expense Manage'), 'modal' => 'xl',])

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
                <h1>Expense Manage</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/home') }}"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                    <li class="breadcrumb-item active">Expense</li>
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
            <h3 class="card-title">Create Or Manage Expense</h3>
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
                                    Create New Expense
                                </h4>
                            </div>
                        </a>
                        <div id="create" class="panel-collapse collapse in">
                            <div class="card-body">
                                <form action="{{ route('admin.expense.expense.store') }}" method="post" id="content_form">
                                    @csrf
                                    <div class="row">

                                        {{-- Reference No --}}
                                        <div class="col-md-6 form-group">
                                            <label for="ref_no">Reference No <span class="text-danger">*</span></label>
                                            <input type="text" autocomplete="off" name="ref_no" id="ref_no" class="form-control" required placeholder="Enter Expense CReference Numbere">
                                        </div>

                                        {{-- Category --}}
                                        <div class="col-md-6 form-group">
                                            <label for="category_id">Categoy <span class="text-danger">*</span></label>
                                            <select name="category_id" id="category_id" class="form-control select" data-parsley-errors-container="#expense_category_error" data-placeholder="Select Expense Category" required>
                                                <option value="">Select Expense Category </option>
                                                @php
                                                    $categories = App\Models\Expense\ExpenseCategory::where('status', 1)->get();
                                                @endphp
                                                @foreach ($categories as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        {{-- What for --}}
                                        <div class="col-md-6 form-group">
                                            <label for="what_for">What for? <span class="text-danger">*</span></label>
                                            <input type="text" autocomplete="off" name="what_for" id="what_for" class="form-control" required placeholder="Enter What purpose">
                                        </div>

                                        {{-- Amount --}}
                                        <div class="col-md-6 form-group">
                                            <label for="amount">Amount <span class="text-danger">*</span></label>
                                            <input type="number" id="amount" name="amount" class="form-control" placeholder="Enter Amount" required>
                                        </div>

                                        {{-- Returnable? --}}
                                        <div class="col-md-12 form-group">
                                            <label for="returnable">Returnable? <span class="text-danger">*</span></label>
                                            <select name="returnable" id="returnable" class="form-control select" required data-parsley-errors-container="#returnable_error">
                                                <option value="1" selected>Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                            <span id="returnable_error"></span>
                                        </div>

                                        {{-- Notes --}}
                                        <div class="col-md-12 form-group">
                                            <label for="notes">Note</label>
                                            <textarea name="notes" id="notes" class="form-control" cols="30" rows="2"></textarea>
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
                                Expense List
                            </h4>
                        </div>
                    </a>
                    <div id="list" class="panel-collapse collapse">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered content_managment_table" data-url="{{ route('admin.expense.expense.datatable') }}">
                                    <thead>
                                        <tr>
                                            <th width="5%">ID</th>
                                            <th width="25%">Title</th>
                                            <th width="20%">Cat. Name</th>
                                            <th width="15%">Amount</th>
                                            <th width="15%">Date</th>
                                            <th width="20%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th width="5%">ID</th>
                                            <th width="25%">Title</th>
                                            <th width="20%">Cat. Name</th>
                                            <th width="15%">Amount</th>
                                            <th width="15%">Date</th>
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
<script src="{{ asset('assets/js//summernote-bs4.min.js') }}"></script>
<script src="{{ asset('js/pages/expense/expense.js') }}"></script>

@if ($expense == 'list')
    <script>
        $('#list').collapse("show");
    </script>
@elseif ($expense == 'create')
    <script>
        $('#create').collapse("show");
    </script>
@endif
@endpush
