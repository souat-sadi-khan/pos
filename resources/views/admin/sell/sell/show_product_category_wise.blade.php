<div class="row">
    @if (count($products) > 0)
        @foreach ($products as $product)
            @include('admin.sell.product')
        @endforeach
    @else 
        <h2>No Product Found</h2>
    @endif
</div>