<tr id="table_row_{{$row}}">
    @php
        $tax_id = $product->tax_id;
        if($tax_id != null) {
            $tax = App\Models\Products\TaxRate::where('id', $tax_id)->first();
            $tax_rate = $tax->tax_rate;
            $tax_rules = $tax->tax_rules;
            if($product->product_variations == 1) {
                $item = App\ProductVariation::where('product_id', $product->id)->first();
            }
            if($tax_rules == 'mod') {
                $tax_amount = $tax_rate * ($product->product_variations == 1 ? $item->product_price : $product->product_price) / 100;
            } else {
                $tax_amount = $tax_rate ;
            }
        } else {
            $tax_amount = 0;
        }
    @endphp
    <td class="text-center">{{ substr($product->product_name, 0, 20) . ''. (strlen($product->product_name) > 20 ? '...' : '') }}({{ $product->product_code }} )
        <input type="hidden" name="product_id[]" value="{{ $product->id }}">
        @if ($access != 0)
            <input type="hidden" name="product_variations_id[]" value="{{ $model->id }}">
        @endif
    </td>
    <td class="text-center">{{ $product->stock }}</td>
    <td><input type="text" class="form-control qty update_qty_{{ $access != 0 ? $model->id : $product->id }}" data-id="{{$row}}" name="qty[]" id="qty_{{$row}}" placeholder="Etner Quantity" value="1"></td>
    <td><input type="number" class="form-control cost" name="cost[]" data-id="{{$row}}" id="cost_{{$row}}" placeholder="Etner Quantity" value="{{ $access != 0 ? $model->product_cost : $product->product_cost }}"></td>
    <td><input type="number" class="form-control sell_price" name="sell_price[]" data-id="{{$row}}" id="sell_price_{{$row}}" placeholder="Etner Quantity" value="{{ $access != 0 ? $model->product_price : $product->product_price }}"></td>
    <td>
        <span id="item_tax">
            @if ($product->tax_id == '') 
                No Tax
            @else
                {{ $product->tax->tax_name }} ({{$product->tax->tax_rate }} {{ $product->tax->tax_rules == 'mod' ? '%' : '+'}})
            @endif
            <input type="hidden" class="form-control product_tax input-sm" name="item_tax[]" id="item_tax_{{$row}}" value="{{ $tax_amount }}">
        </span>
    </td>
    <td>
        <span id="net_total">
            <input type="text" class="form-control input-sm net_total" name="net_total[]" id="net_total_{{$row}}">
        </span>
    </td>
    <td class="text-center">
        <i style="cursor: pointer;" class="fa fa-1x fa-times text-danger delete_row" data-id="{{$row}}" aria-hidden="true"></i>
    </td>
</tr>

<script>
    $(function() {
        var qty = 1;
        var price = '{{ $access != 0 ? $model->product_price_inc_tax : $product->product_price_inc_tax }}';
        var total = qty * parseInt(price);
        $('#net_total_{{$row}}').val(total);
    })
</script>