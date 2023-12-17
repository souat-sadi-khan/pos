<tr style="font-size: 12px;" id="table_row_{{$row}}">
    {{-- Name --}}
    <td width="30%" class="text-center">
        {{ substr($product->product_name, 0, 15) . ''. (strlen($product->product_name) > 15 ? '...' : '') }}({{ $product->product_code }} )
        
        <input type="hidden" name="product_id[]" class="product_id" value="{{ $product->id }}">
        <input type="hidden" name="product_variations_id[]" class="product_variations_id" value="{{ $model->id }}">
    
    </td>

    {{-- Quantity --}}
    <td width="20%">
        <input type="text" class="form-control qty update_qty_{{ $model->id }}" data-id="{{$row}}" name="qty[]" id="qty_{{$row}}" placeholder="Etner Quantity" value="1">
    </td>

    {{-- Sell Price --}}
    <td width="20%" class="text-right">
        <input type="text" class="sell_price form-control" value="{{ $model->product_price_inc_tax }}">
    </td>

    <td width="30%" class="text-right">
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
        var price = '{{ $model->product_price_inc_tax }}';
        var total = qty * parseInt(price);
        $('#net_total_{{$row}}').val(total);
    })
</script>