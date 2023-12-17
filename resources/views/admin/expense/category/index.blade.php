@extends('layouts.main', ['title' => ('Expense Category Manage'), 'modal' => 'xl',])

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
                <h1>Expense Category Manage</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/home') }}"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                    <li class="breadcrumb-item active">Expense Category</li>
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
            <h3 class="card-title">Create Or Manage Expense Category</h3>
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
                                    Create New Expense Category
                                </h4>
                            </div>
                        </a>
                        <div id="create" class="panel-collapse collapse in">
                            <div class="card-body">
                                <form action="{{ route('admin.expense.expense-category.store') }}" method="post" id="content_form">
                                    @csrf
                                    <div class="row">

                                        {{-- Expense Category Name --}}
                                        <div class="col-md-4 form-group">
                                            <label for="name">Expense Category Name <span class="text-danger">*</span></label>
                                            <input type="text" autocomplete="off" name="name" id="name" class="form-control" required placeholder="Enter Expense Category Name">
                                        </div>

                                        {{-- Expense Category Parent --}}
                                        <div class="col-md-4 form-group">
                                            <label for="parent">Expense Category Parent <span class="text-danger">*</span> </label>
                                            <select data-parsley-errors-container="expense_category_parent_error" name="parent" id="parent" class="form-control select" data-placeholder="Select Parent Category" required>
                                                <option value="">Select Parent Category</option>
                                                <option value="0" selected>As A Parent</option>
                                                @php
                                                    $categories = App\Models\Expense\ExpenseCategory::where('status', 1)->get();
                                                @endphp
                                                @foreach ($categories as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                            <span id="expense_category_parent_error"></span>
                                        </div>

                                        {{-- Status --}}
                                        <div class="col-md-4 form-group">
                                            <label for="status">Status <span class="text-danger">*</span></label>
                                            <select name="status" id="status" class="form-control select" required data-parsley-errors-container="#status_error">
                                                <option value="1" selected>Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                            <span id="status_error"></span>
                                        </div>

                                        {{-- Category Description --}}
                                        <div class="col-md-12 form-group">
                                            <label for="details">Expense Category Description</label>
                                            <textarea name="details" id="details" class="form-control" cols="30" rows="2"></textarea>
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
                                Expense Category List
                            </h4>
                        </div>
                    </a>
                    <div id="list" class="panel-collapse collapse">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered content_managment_table" data-url="{{ route('admin.expense.expense-cateogy.datatable') }}">
                                    <thead>
                                        <tr>
                                            <th width="5%">ID</th>
                                            <th width="10%">Parent</th>
                                            <th width="20%">Name</th>
                                            <th width="15%">Total</th>
                                            <th width="10%">Status</th>
                                            <th width="10%">Date</th>
                                            <th width="20%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th width="5%">ID</th>
                                            <th width="15%">Parent</th>
                                            <th width="25%">Name</th>
                                            <th width="15%">Total</th>
                                            <th width="10%">Status</th>
                                            <th width="10%">Date</th>
                                            <th width="10%">Action</th>
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
<script src="{{ asset('js/pages/expense/category.js') }}"></script>

@if ($expense_category == 'list')
    <script>
        $('#list').collapse("show");
    </script>
@elseif ($expense_category == 'create')
    <script>
        $('#create').collapse("show");
    </script>
@endif
@endpush
