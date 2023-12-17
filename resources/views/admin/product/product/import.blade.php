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
            <div class="col-md-12">
                <div class="p-3 bg-light">
                    The first line in downloaded .xls file should remain as it is. Please do not change the order of columns. Please make sure the (*.xls) file is UTF-8 encoded. The images should be uploaded in storage/products/ (or where you pointed) folder. The System will check that if a row exists then update, if not exist then insert.
                </div>

                <div class="m-2">
                    <p class="text-center">
                        Download Sample Format File <a href="{{ asset('files/demo.xlsx') }}" download> <i class="fa fa-download mx-2" aria-hidden="true"></i> 
                        Demo File</a>
                    </p>
                </div>

                <form action="{{ route('admin.products.products.upload_file') }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="import_file">Upload Your File</label>
                        <input type="file" name="import_file" id="import_file" class="form-control">
                    </div>
    
                    <button type="submit" id="submit" class="px-5 btn btn-primary"><i class="fa fa-floppy-o mr-3" aria-hidden="true"></i>Submit</button>
    
                </form>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>

@endsection

@push('admin.scripts')

@endpush
