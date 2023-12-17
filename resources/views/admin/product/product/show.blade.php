@php
    if($model->products_variation == 0) {
        $product_main_price = $model->product_price;
        if($model->tax_id != '') {
            $tax_rules = $model->tax->tax_rules;
            $tax_price = $model->tax->tax_rate;
            if($tax_rules == 'plus') {
                $product_sell_price = $product_main_price + $tax_price;
            } else {
                $product_vat = ($product_main_price * $tax_price) / 100;
                $product_sell_price = $product_main_price + $product_vat;
            }
        } else {
            $product_sell_price = $product_main_price;
        }
    }
@endphp
@extends('layouts.main', ['title' => ('Product Manage'), 'modal' => 'xl',])

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
                <h1>Product Information : {{ $model->product_name }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/home') }}"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.products.products.index') }}">Product</a></li>
                    <li class="breadcrumb-item active">{{ $model->product_name }}</li>
                </ol>
            </div>
        </div>
    </div>
</section>
@endsection

@section('content')
<div class="col-md-12">
    <div class="card card-solid">
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-sm-6">
                    <h3 class="d-inline-block d-sm-none">{{ $model->product_name }}</h3>
                    <div class="col-12">
                        <img src="{{ $model->product_image != '' ? asset('storage/images/product/product'. '/'. $model->product_image) : asset('images/product.jpg')}}" class="product-image" alt="Product Image">
                    </div>
                    <div class="col-12 product-image-thumbs">
                        <div class="product-image-thumb active"><img src="{{ $model->product_image != '' ? asset('storage/images/product/product'. '/'. $model->product_image) : asset('images/product.jpg')}}" alt="Product Image"></div>
                        {{-- <div class="product-image-thumb"><img src="../../dist/img/prod-2.jpg" alt="Product Image"></div> --}}
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <h3 class="my-3">{{ $model->product_name }}</h3> <hr>
                    {{-- Stock : {{ $model->stock }} --}}
                            <a href="{{ route('admin.product_purchase', $model->id) }}">
                                <button class="btn btn-info btn-sm float-right" type="button"><i class="fa fa-shopping-bag fa-2 mr-1" aria-hidden="true"></i>Purchse</button>
                            </a>
                    {{-- <p></p> --}}
    
                    <hr>
                    {{-- <h4>Available Colors</h4> --}}
                    {{-- <div class="btn-group btn-group-toggle" data-toggle="buttons">
                        <label class="btn btn-default text-center active">
                            <input type="radio" name="color_option" id="color_option1" autocomplete="off" checked="">
                            Green
                            <br>
                            <i class="fas fa-circle fa-2x text-green"></i>
                        </label>
                        <label class="btn btn-default text-center">
                            <input type="radio" name="color_option" id="color_option2" autocomplete="off">
                            Blue
                            <br>
                            <i class="fas fa-circle fa-2x text-blue"></i>
                        </label>
                        <label class="btn btn-default text-center">
                            <input type="radio" name="color_option" id="color_option3" autocomplete="off">
                            Purple
                            <br>
                            <i class="fas fa-circle fa-2x text-purple"></i>
                        </label>
                        <label class="btn btn-default text-center">
                            <input type="radio" name="color_option" id="color_option4" autocomplete="off">
                            Red
                            <br>
                            <i class="fas fa-circle fa-2x text-red"></i>
                        </label>
                        <label class="btn btn-default text-center">
                            <input type="radio" name="color_option" id="color_option5" autocomplete="off">
                            Orange
                            <br>
                            <i class="fas fa-circle fa-2x text-orange"></i>
                        </label>
                    </div> --}}

    
                    @if ($model->product_variations == 0)
                        <div class="bg-gray py-2 px-3 mt-4">
                            <h2 class="mb-0">
                                {{get_option('currency_symbol'). ' '. number_format($model->product_price, 2)}}
                            </h2>
                            <h4 class="mt-0">
                                <small>Product Cost: {{get_option('currency_symbol'). ' '. number_format($model->product_cost, 2)}} </small> <br>
                                <small>Product Tax: {{ $model->tax_id != '' ? $model->tax->tax_name . '('.get_option('currency_symbol') . ' '. number_format($model->tax->tax_rate, 2) .')' . ($model->tax->tax_rules == 'plus' ? '(+ Add)' : '(% Percentages)') : 'No Tax'}} </small> <br>
                                <small>Product Sell Price: {{get_option('currency_symbol'). ' '. number_format($product_sell_price, 2)}} </small> <br>
                            </h4>
                        </div>
                    @else 
                        @php
                            $query = App\ProductVariation::where('product_id', $model->id)->get();
                        @endphp

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <tr class="table-info">
                                    <td colspan="4" class="text-center">
                                        <b>Variation wise Product Price</b>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Stock</th>
                                    <th>Color</th>
                                    <th>Size</th>
                                    <th>P. Cost</th>
                                    <th>P. Price (+TAX)</th>
                                </tr>
                                @foreach ($query as $item)
                                    <tr>
                                        <td>{{ $item->stock }}</td>
                                        <td>{{ $item->color_id != null ? $item->color->color_name : 'No Color' }}</td>
                                        <td>{{ $item->size_id != null ? $item->size->size_name : 'No Size' }}</td>
                                        <td><span class="text-primary">{{get_option('currency_symbol')}} {{ number_format($item->product_cost, 2) }}</span></td>
                                        <td>
                                            <div style="font-size:12px;" class="table-responsive">
                                                <table class="table table-bordered table-striped">
                                                    <tr>
                                                        <th width="50%" class="text-center">P. Price</th>
                                                        <td width="50%" class="text-center"><span class="text-info">{{ get_option('currency_symbol') }} {{ $item->product_price }}</span> </td>
                                                    </tr>
                                                    <tr>
                                                        <th width="50%" class="text-center">P. Tax</th>
                                                        <td width="50%" class="text-center">
                                                            @php
                                                                $tax = $model->tax_id;
                                                            @endphp
                                                            @if ($tax != 0)
                                                                {{$model->tax->tax_name}} ({{$model->tax->tax_rate}} {{$model->tax->tax_rules == 'mod' ? '%' : '+'}} )
                                                            @else 
                                                                No Tax
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th width="50%" class="text-center">P. Price(+Tax)</th>
                                                        <td width="50%" class="text-center"><span class="text-success">{{ get_option('currency_symbol') }} {{ $item->product_price_inc_tax }} </span></td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    @endif
    
                    <div class="mt-4 product-share">
                        <a href="javascript:void(0)" onclick="javascript:genericSocialShare('https://www.facebook.com/sharer/sharer.php?u={{ route('admin.products.products.show', $model->id)}}')" class="text-gray">
                            <i class="fa fa-facebook-square fa-2x"></i>
                        </a>
                        <a href="javascript:void(0)" onclick="javascript:genericSocialShare('https://twitter.com/share?text={{ route('admin.products.products.show', $model->id)}}')" class="text-gray">
                            <i class="fa fa-twitter-square fa-2x"></i>
                        </a>
                        <a href="javascript:void(0)" onclick="javascript:genericSocialShare('http://pinterest.com/pin/create/button/?url={{ route('admin.products.products.show', $model->id)}}]')" class="text-gray">
                            <i class="fa fa-pinterest-square fa-2x"></i>
                        </a>
                    </div>
    
                </div>
            </div>
            <div class="row mt-4">
                <nav class="w-100">
                    <div class="nav nav-tabs" id="product-tab" role="tablist">
                        <a class="nav-item nav-link active" id="product-desc-tab" data-toggle="tab" href="#product-desc"
                            role="tab" aria-controls="product-desc" aria-selected="true">Description</a>
                        <a class="nav-item nav-link" id="product-comments-tab" data-toggle="tab" href="#product-comments"
                            role="tab" aria-controls="product-comments" aria-selected="false">Stock Register</a>
                        <a class="nav-item nav-link" id="product-rating-tab" data-toggle="tab" href="#product-rating"
                            role="tab" aria-controls="product-rating" aria-selected="false">Chart</a>
                    </div>
                </nav>
                <div class="tab-content p-3" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="product-desc" role="tabpanel"
                        aria-labelledby="product-desc-tab"> 
                        <div class="col-md-12">
                            {!! htmlspecialchars_decode($model->product_details) !!} 
                        </div>
                    </div>
                    <div class="tab-pane col-md-12 fade" id="product-comments" role="tabpanel" aria-labelledby="product-comments-tab">
                        Vivamus rhoncus nisl sed venenatis luctus. Sed condimentum risus ut tortor feugiat laoreet.
                        Suspendisse potenti. Donec et finibus sem, ut commodo lectus. Cras eget neque dignissim, placerat
                        orci interdum, venenatis odio. Nulla turpis elit, consequat eu eros ac, consectetur fringilla urna.
                        Duis gravida ex pulvinar mauris ornare, eget porttitor enim vulputate. Mauris hendrerit, massa nec
                        aliquam cursus, ex elit euismod lorem, vehicula rhoncus nisl dui sit amet eros. Nulla turpis lorem,
                        dignissim a sapien eget, ultrices venenatis dolor. Curabitur vel turpis at magna elementum hendrerit
                        vel id dui. Curabitur a ex ullamcorper, ornare velit vel, tincidunt ipsum. </div>
                    <div class="tab-pane fade" id="product-rating" role="tabpanel" aria-labelledby="product-rating-tab">
                        Cras ut ipsum ornare, aliquam ipsum non, posuere elit. In hac habitasse platea dictumst. Aenean
                        elementum leo augue, id fermentum risus efficitur vel. Nulla iaculis malesuada scelerisque. Praesent
                        vel ipsum felis. Ut molestie, purus aliquam placerat sollicitudin, mi ligula euismod neque, non
                        bibendum nibh neque et erat. Etiam dignissim aliquam ligula, aliquet feugiat nibh rhoncus ut.
                        Aliquam efficitur lacinia lacinia. Morbi ac molestie lectus, vitae hendrerit nisl. Nullam metus
                        odio, malesuada in vehicula at, consectetur nec justo. Quisque suscipit odio velit, at accumsan urna
                        vestibulum a. Proin dictum, urna ut varius consectetur, sapien justo porta lectus, at mollis nisi
                        orci et nulla. Donec pellentesque tortor vel nisl commodo ullamcorper. Donec varius massa at semper
                        posuere. Integer finibus orci vitae vehicula placerat. </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
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
<script>
    function genericSocialShare(url){
        window.open(url,'sharer','toolbar=0,status=0,width=648,height=395');
        return true;
    }
</script>
@endpush


