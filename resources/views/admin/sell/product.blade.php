{{-- Find Product Variation for this Product --}}
@php
    $query = App\ProductVariation::where('product_id', $product->id)->get();
@endphp
@foreach ($query as $item)
    <!-- Product -->
    <div class="col-md-3 text-center">
        <!-- Product Card -->
        <div data-url="{{ route('admin.add_sell_row') }}" data-product_id="{{ $product->id }}" data-id="{{ $item->id }}" style="cursor: pointer;" class="card add-row">
            <!-- Product Image Start -->
            <img class="card-img-top" src="{{ $product->product_image == '' ? asset('images/product.jpg') : asset('storage/images/product/product'. '/'. $product->product_image) }}" height="100px;" alt="Product image">
            <!-- Product Image End -->

            <div class="card-body px-2">
                <p class="card-text text-center " style="min-height: 75px;line-height: 18px;">
                    <!-- Product Name -->
                    <b>{{ substr($product->product_name, 0, 15) . ''. (strlen($product->product_name) > 20 ? '...' : '') }}({{ $product->product_code }})</b> <br>
                    <!-- Product Name -->

                    <!-- Product Size Start -->
                    @if ($item->size_id != '')
                        Size : {{$item->size->size_name}} <br>
                    @else 
                        Size : N/A <br>
                    @endif
                    <!-- Product Size End -->

                    <!-- Product Color Start -->
                    @if ($item->color_id != '')
                        Color : {{$item->color->color_name}} <br>
                    @else 
                        Color : N/A  <br>
                    @endif
                    <!-- Product Color End -->
                    <br>

                    <!-- Product Product Price -->
                    <b>Price : {{ get_option('currency_symbol') }}{{ $item->product_price_inc_tax }} </b>

                </p>
            </div>
        </div>
    </div> 
@endforeach
