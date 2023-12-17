@extends('layouts.main', ['title' => ('Supplier Manage'), 'modal' => 'xl',])

@section('header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Supplier Profile</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/home') }}"><i class="fa fa-home"
                                aria-hidden="true"></i></a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('admin.supplier.index') }}">Supplier</a></li>
                    <li class="breadcrumb-item active">{{ $model->sup_name }}</li>
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
            <h3 class="card-title">Supplier Full View Information :: {{ $model->sup_name }}</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                {{-- Profile --}}
                <div class="col-md-4 card card-widget widget-user">
                    <div class="widget-user-header bg-info">
                        <p class="widget-user-username">{{ $model->sup_name }}</p>
                        <h6 class="widget-user-desc">Since {{ formatDate($model->created_at) }}</h6>
                    </div>
                    <div class="widget-user-image">
                        <img style="height: 90px;" class="img-circle elevation-2" src="{{ asset('images/supp.png') }}" alt="Supplier Image">
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">0</h5>
                                    <span class="description-text">INVOICE</span>
                                </div>
                            </div>

                            <div class="col-sm-4 border-right">
                                <div class="description-block" style="font-size: 12px;">
                                    <a class="btn btn-block btn-sm btn-primary" href="product.php?sup_id=1" title="Supplier Products">
                                        <i class="fa fa-fw fa-list"></i>Product</a>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="description-block">
                                    <div class="description-block">
                                        <a role="button" id="content_managment" data-url="{{ route('admin.supplier.edit',$model->id) }}" class="btn btn-block btn-sm btn-warning" href="" title="Edit Supplier">
                                          <i class="fa fa-fw fa-edit"></i>
                                        </a>
                                      </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Information --}}
                <div class="col-md-4 card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Contact Information</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fa fa-plus"></i></button>
                        </div>
                    </div>
                    <div class="card-body px-0">
                        <div class="bg-light p-1">
                            @if ($model->sup_mobile != '')
                                <h4 class="text-center">Mobile : {{ $model->sup_mobile }} </h4>
                            @endif
                            @if ($model->sup_email != '')
                                <h6 class="text-center">Email : {{ $model->sup_email }} </h6>
                            @endif
                            @if ($model->sup_address != '')
                                <h6 class="text-center">Address : {{ $model->sup_address }} </h6>
                            @endif
                            @if ($model->sup_city != '')
                                <h6 class="text-center">City : {{ $model->sup_city }} </h6>
                            @endif
                            @if ($model->sup_state != '')
                                <h6 class="text-center">State : {{ $model->sup_state }} </h6>
                            @endif
                            @if ($model->sup_country != '')
                                <h6 class="text-center">Country : {{ $model->sup_country }} </h6>
                            @endif
                        </div>    
                    </div>
                </div>

                {{-- Balance --}}
                <div class="info-box col-md-4">
                    <span class="info-box-icon bg-info"><i class="fa fa-usd"></i></span>
      
                    <div class="info-box-content">
                        <h4 class="info-box-text text-center">CURRENT BALANCE</h4>
                        <h2 class="info-box-number text-center">
                            {{ get_option('currency_symbol') && get_option('currency_symbol') != '' ? get_option('currency_symbol') : '৳' }}    0
                        </h2>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-tabs">
                        <div class="card-header p-0 pt-1">
                            <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Purchase</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Sells</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-one-messages-tab" data-toggle="pill" href="#custom-tabs-one-messages" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false">Chart</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-one-tabContent">
                                <div class="tab-pane fade active show" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                                    <h6 class="text-center">Purchase Invoice List</h6>
                                </div>
                                <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                                    <h6 class="text-center">Selling Invoice List</h6>
                                </div>
                                <div class="tab-pane fade" id="custom-tabs-one-messages" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
                                   <h6 class="text-center">Sells v/s Purchase Chart</h6>
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
<script src="{{ asset('js/pages/edit_supplier.js') }}"></script>
@endpush
