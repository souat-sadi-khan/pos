@extends('layouts.main', ['title' => ('Due Purchase Invoice'), 'modal' => 'xl',])

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
                <h1>Due Purchase Invoice</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/home') }}"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                    <li class="breadcrumb-item active">Due Purchase Invoice</li>
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
            <h3 class="card-title">Due Purchase Invoice List</h3>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered content_managment_table" data-url="{{ route('admin.purchase.due_invoice_datatable') }}">
                    <thead>
                        <tr>
                            <th width="15%">Date</th>
                            <th width="10%">Invoice</th>
                            <th width="10%">Supplier</th>
                            <th width="10%">Creator</th>
                            <th width="14%">Amount</th>
                            <th width="13%">Paid</th>
                            <th width="13%">Due</th>
                            <th width="10%">Status</th>
                            <th width="5%">Pay</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                    <tfoot>
                        <tr>
                            <th width="15%">Date</th>
                            <th width="10%">Invoice</th>
                            <th width="10%">Supplier</th>
                            <th width="10%">Creator</th>
                            <th width="14%">Amount</th>
                            <th width="13%">Paid</th>
                            <th width="13%">Due</th>
                            <th width="10%">Status</th>
                            <th width="5%">Pay</th>
                        </tr>
                    </tfoot>
                </table>
            </div> 
        </div>

    </div>

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
<script src="{{ asset('js/pages/purchase/due.js') }}"></script>
@endpush
