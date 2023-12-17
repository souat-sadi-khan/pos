@extends('layouts.main', ['title' => 'Homepage'])

@push('admin.css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.18.0/css/mdb.min.css" rel="stylesheet">
<style>

.icon i.fa{
    position: absolute;
    right: 15px;
    top: 10px;
}
</style>
@endpush

@section('header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>DashBoard</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>
        </div>
    </div>
</section>
@endsection

@section('content')
<div class="col-md-12">

    @if (get_option('product_init') != '0')
        
        <div class="row">
            <div class="col-md-12">
                <!--Grid row-->
                <div class="row">

                    @if (get_option('product_init_category') != 0)
                        {{-- Category --}}
                        <div class="col-md-3 mb-4">
                            <div class="card gradient-card">
                                <div class="card-image" style="background-image: url(https://mdbootstrap.com/img/Photos/Horizontal/Work/4-col/img%20%2814%29.jpg)">
                                    <a href="{{ route('admin.product-initiazile.category.index')}} ">
                                        <div class="text-white d-flex h-100 mask purple-gradient">
                                            <div class="first-content align-self-center p-3">
                                                <h3 class="card-title">Total Category</h3> <br>
                                                @php
                                                    echo $count = App\Models\Products\Category::count();
                                                @endphp
                                                <div class="icon float-right fa-3x">
                                                    <i class="fa fa-cart-plus"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if (get_option('product_init_brand') != 0) 
                        {{-- Brand --}}
                        <div class="col-md-3 mb-4">
                            <div class="card gradient-card">
                                <div class="card-image" style="background-image: url(https://mdbootstrap.com/img/Photos/Horizontal/Work/4-col/img%20%2814%29.jpg)">
                                    <a href="{{ route('admin.product-initiazile.brand.index')}} ">
                                        <div class="text-white d-flex h-100 mask blue-gradient">
                                            <div class="first-content align-self-center p-3">
                                                <h3 class="card-title">Total Brand</h3> <br>
                                                @php
                                                    echo $count = App\Models\Products\Brand::count();
                                                @endphp
                                                <div class="icon float-right fa-3x">
                                                    <i class="fa fa-bold"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if (get_option('product_init_unit') != 0)
                        {{-- Unit --}}
                        <div class="col-md-3 mb-4">
                            <div class="card gradient-card">
                                <div class="card-image" style="background-image: url(https://mdbootstrap.com/img/Photos/Horizontal/Work/4-col/img%20%2814%29.jpg)">
                                    <a href="{{ route('admin.product-initiazile.unit.index')}} ">
                                        <div class="text-white d-flex h-100 mask aqua-gradient">
                                            <div class="first-content align-self-center p-3">
                                                <h3 class="card-title">Total Unit</h3> <br>
                                                @php
                                                    echo $count = App\Models\Products\Unit::count();
                                                @endphp
                                                <div class="icon float-right fa-3x">
                                                    <i class="fa fa-underline"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if (get_option('product_init_box') != 0)
                        {{-- Box --}}
                        <div class="col-md-3 mb-4">
                            <div class="card gradient-card">
                                <div class="card-image" style="background-image: url(https://mdbootstrap.com/img/Photos/Horizontal/Work/4-col/img%20%2814%29.jpg)">
                                    <a href="{{ route('admin.product-initiazile.unit.index')}} ">
                                        <div class="text-white d-flex h-100 mask peach-gradient">
                                            <div class="first-content align-self-center p-3">
                                                <h3 class="card-title">Total Box</h3> <br>
                                                @php
                                                    echo $count = App\Models\Products\Box::count();
                                                @endphp
                                                <div class="icon float-right fa-3x">
                                                    <i class="fa fa-archive"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if (get_option('product_init_taxrate') != 0)
                        {{-- TaxRate --}}
                        <div class="col-md-4 mb-4">
                            <div class="card gradient-card">
                                <div class="card-image" style="background-image: url(https://mdbootstrap.com/img/Photos/Horizontal/Work/4-col/img%20%2814%29.jpg)">
                                    <a href="{{ route('admin.product-initiazile.unit.index')}} ">
                                        <div class="text-white d-flex h-100 mask dusty-grass-gradient">
                                            <div class="first-content align-self-center p-3">
                                                <h3 class="card-title">Total TaxRate</h3> <br>
                                                @php
                                                    echo $count = App\Models\Products\TaxRate::count();
                                                @endphp
                                                <div class="icon float-right fa-3x">
                                                    <i class="fa fa-usd"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if (get_option('product_init_size') != 0)
                        {{-- Size --}}
                        <div class="col-md-4 mb-4">
                            <div class="card gradient-card">
                                <div class="card-image" style="background-image: url(https://mdbootstrap.com/img/Photos/Horizontal/Work/4-col/img%20%2814%29.jpg)">
                                    <a href="{{ route('admin.product-initiazile.unit.index')}} ">
                                        <div class="text-white d-flex h-100 mask morpheus-den-gradient">
                                            <div class="first-content align-self-center p-3">
                                                <h3 class="card-title">Total Size</h3> <br>
                                                @php
                                                    echo $count = App\Models\Products\Size::count();
                                                @endphp
                                                <div class="icon float-right fa-3x">
                                                    <i class="fa fa-scribd"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if (get_option('product_init_color') != 0) 
                         {{-- Color --}}
                        <div class="col-md-4 mb-4">
                            <div class="card gradient-card">
                                <div class="card-image" style="background-image: url(https://mdbootstrap.com/img/Photos/Horizontal/Work/4-col/img%20%2814%29.jpg)">
                                    <a href="{{ route('admin.product-initiazile.unit.index')}} ">
                                        <div class="text-white d-flex h-100 mask tempting-azure-gradient">
                                            <div class="first-content align-self-center p-3">
                                                <h3 class="card-title">Total Color</h3> <br>
                                                @php
                                                    echo $count = App\Models\Products\Color::count();
                                                @endphp
                                                <div class="icon float-right fa-3x">
                                                    <i class="fa fa-creative-commons"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>

    @endif

    <div class="row">
        {{-- Customer --}}
        <div class="col-md-3">
            @php
                $query = App\Models\Customer::all();
                $all_sup = count($query);
                $today_sup = App\Models\Customer::whereDate('created_at', Carbon\Carbon::today())->count();
            @endphp
            <div class="small-box bg-warning text-center">
                <div class="inner">
                    <div>Total Customer<br>{{ $all_sup }}</div>
                    <div>Today's Customer<br>{{ $today_sup }}</div>
                </div>
                <div class="icon">
                    <i class="fa fa-user-times"></i>
                </div>
                <a href="{{ route('admin.customer.index') }}" class="small-box-footer">
                    More info <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    
        {{-- Supplier --}}
        <div class="col-md-3">
            @php
                $query = App\Models\Supplier::all();
                $all_sup = count($query);
                $today_sup = App\Models\Supplier::whereDate('created_at', Carbon\Carbon::today())->count();
            @endphp
            <div class="small-box bg-info text-center">
                <div class="inner">
                    <div>Total Supplier<br>{{ $all_sup }}</div>
                    <div>Today's Supplier<br>{{ $today_sup }}</div>
                </div>
                <div class="icon">
                    <i class="fa fa-shopping-cart"></i>
                </div>
                <a href="{{ route('admin.supplier.index') }}" class="small-box-footer">
                    More info <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        {{-- Products --}}
        <div class="col-md-3">
            @php
                $number = 0;
                $query = App\Models\Products\Product::all();
                foreach ($query as $product) {
                    $variations = $product->product_variations;
                    if($variations == 1) {
                        $pro = App\ProductVariation::where('product_id', $product->id)->count();
                        $number = $number + $pro;
                    } else {
                        $number++;
                    }
                }

                $today_number = 0;
                $query = App\Models\Products\Product::whereDate('created_at', Carbon\Carbon::today())->get();
                foreach ($query as $product) {
                    $variations = $product->product_variations;
                    if($variations == 1) {
                        $pro = App\ProductVariation::where('product_id', $product->id)->count();
                        $today_number = $today_number + $pro;
                    } else {
                        $today_number++;
                    }
                }
            @endphp
            <div class="small-box bg-danger  text-center">
                <div class="inner">
                    <div>Total Products<br>{{ $number }}</div>
                    <div>Today's Products<br>{{ $today_number }}</div>
                </div>
                <div class="icon">
                    <i class="fa fa-star"></i>
                </div>
                <a href="{{ route('admin.products.products.index', 'show=list') }}" class="small-box-footer">
                    More info <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>
</div>
    
<div class="col-md-12">
    <div class="card card-primary card-tabs">
        <div class="card-header p-0 pt-1">
            <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                <li class="pt-2 px-3"><h3 class="card-title">Recent Activities</h3></li>
                
                <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-two-home-tab" data-toggle="pill" href="#sells_report" role="tab" aria-controls="custom-tabs-two-home" aria-selected="true">Sells</a>
                </li>
              
                <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-two-profile-tab" data-toggle="pill" href="#purchases_report" role="tab" aria-controls="custom-tabs-two-profile" aria-selected="false">Purchase</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-two-settings-tab" data-toggle="pill" href="#customers_report" role="tab" aria-controls="custom-tabs-two-settings" aria-selected="false">Customers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-two-supplier-tab" data-toggle="pill" href="#suppliers_report" role="tab" aria-controls="custom-tabs-two-supplier" aria-selected="false">Suppliers</a>
                </li>
            </ul>
        </div>
        
        <div class="card-body">
            <div class="tab-content" id="custom-tabs-two-tabContent">
                <div class="tab-pane fade active show" id="sells_report" role="tabpanel" aria-labelledby="custom-tabs-two-home-tab">
                    @php
                        $sell_query = App\Models\Sells\Sell::orderby('id', 'desc')->limit(5)->get();
                    @endphp
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="table-info">
                                <tr>
                                    <th>Invoice ID</th>
                                    <th>Created At</th>
                                    <th>Customer Name</th>
                                    <th>Amount</th>
                                    <th>Payment Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sell_query as $item)
                                    <tr>
                                        <td>INV-{{ $item->invoice }}</td>
                                        <td>{{ formatDate($item->created_at) }}</td>
                                        <td>{{ $item->customer->customer_name }}</td>
                                        <td>{{ get_option('currency_symbol') }}{{ number_format($item->payable, 2) }}</td>
                                        <td class="text-center">
                                            @if ($item->status == 1)
                                                <span class="badge badge-success">Paid</span>
                                            @else 
                                                <span class="badge badge-danger">Due</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <a href="{{ route('admin.point-of-sell') }}" class="btn btn-xs btn-info btn-flat"><span class="fa fa-fw fa-plus"></span> Add Sell</a>
                        <a href="#" class="btn btn-xs btn-success btn-flat"><span class="fa fa-fw fa-list"></span> Sell List</a>
                    </div>
                </div>
              
                <div class="tab-pane fade" id="purchases_report" role="tabpanel" aria-labelledby="custom-tabs-two-profile-tab">
                    @php
                        $purchase_query = App\Models\Purchase\Purchase::orderby('id', 'desc')->limit(5)->get();
                    @endphp
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="table-info">
                                <tr>
                                    <th>Invoice ID</th>
                                    <th>Created At</th>
                                    <th>Supplier Name</th>
                                    <th>Amount</th>
                                    <th>Payment Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($purchase_query as $item)
                                    <tr>
                                        <td>INV-{{ $item->invoice }}</td>
                                        <td>{{ formatDate($item->created_at) }}</td>
                                        <td>{{ $item->supplier != null ? $item->supplier->sup_name : 'No Supplier' }}</td>
                                        <td>{{ get_option('currency_symbol') }}{{ number_format($item->purchase_payable_amount, 2) }}</td>
                                        <td class="text-center">
                                            @if ($item->status == 'Paid')
                                                <span class="badge badge-success">Paid</span>
                                            @else 
                                                <span class="badge badge-danger">Due</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <a href="{{ route('admin.purchase.index', 'show=create') }}" class="btn btn-xs btn-info btn-flat"><span class="fa fa-fw fa-plus"></span> Add Purchase</a>
                        <a href="{{ route('admin.purchase.index', 'show=list') }}" class="btn btn-xs btn-success btn-flat"><span class="fa fa-fw fa-list"></span> Purchase List</a>
                    </div>
                </div>
              
                <div class="tab-pane fade" id="customers_report" role="tabpanel" aria-labelledby="custom-tabs-two-settings-tab">
                    <div class="border border-primary p-2 bg-light">
                        @php
                            $query = App\Models\Customer::limit(5)->latest()->get();
                        @endphp
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr class="thead-light">
                                        <th>Customer Name</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Created At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($query) > 0)
                                        @foreach ($query as $item)
                                            <tr>
                                                <td>{{ $item->customer_name }}</td>
                                                <td>{{ $item->customer_mobile }}</td>
                                                <td>{{ $item->customer_email }}</td>
                                                <td>{{ $item->customer_address }}</td>
                                                <td>{{ formatDate($item->created_at) }}</td>
                                            </tr>
                                        @endforeach
                                    @else 
                                        <tr>
                                            <td class="text-center" colspan="5">No Data Avaliable</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>

                        <div class="text-center">
                            <a href="{{ route('admin.customer.index') }}"><button type="button" class="btn btn-info btn-sm" ><i class="fa fa-plus mr-2" aria-hidden="true"></i>Full View Information<i class="fa fa-list-ul ml-2" aria-hidden="true"></i></button></a>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="suppliers_report" role="tabpanel" aria-labelledby="custom-tabs-two-supplier-tab">
                    <div class="border border-primary p-2 bg-light">
                        @php
                            $query = App\Models\Supplier::limit(5)->latest()->get();
                        @endphp
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr class="thead-light">
                                        <th>Supplier Name</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Created At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($query) > 0)
                                        @foreach ($query as $item)
                                            <tr>
                                                <td>{{ $item->sup_name }}</td>
                                                <td>{{ $item->sup_mobile }}</td>
                                                <td>{{ $item->sup_email }}</td>
                                                <td>{{ $item->sup_address }}</td>
                                                <td>{{ formatDate($item->created_at) }}</td>
                                            </tr>
                                        @endforeach
                                    @else 
                                        <tr>
                                            <td class="text-center" colspan="5">No Data Avaliable</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>

                        <div class="text-center">
                            <a href="{{ route('admin.supplier.index') }}"><button type="button" class="btn btn-info btn-sm" ><i class="fa fa-plus mr-2" aria-hidden="true"></i>Full View Information<i class="fa fa-list-ul ml-2" aria-hidden="true"></i></button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('admin.scripts')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.18.0/js/mdb.min.js"></script>

@endpush