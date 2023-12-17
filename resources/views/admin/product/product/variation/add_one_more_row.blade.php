<tr id="table_row_{{$row}}">
    <td width="25%">
        @php
            $color_query = App\Models\Products\Color::where('status', 1)->select('id', 'color_name')->get();
        @endphp
        
        <select data-parsley-errors-container="#select_color_error_{{$row}}" name="color[]" class="form-control select" data-placeholder="Select Color" required>
            <option value="">Select Color</option>
            <option value="0">No Color</option>
            @foreach ($color_query as $item)
                <option value="{{ $item->id }}">{{ $item->color_name }}</option>
            @endforeach
        </select>
        <span id="select_color_error_{{$row}}"></span>
    </td>
    <td width="25%">
        @php
            $size_query = App\Models\Products\Size::where('status', 1)->select('id', 'size_name')->get();
        @endphp
        
        <select data-parsley-errors-container="#select_size_error_{{$row}}" name="size[]" class="form-control select" data-placeholder="Select Size" required>
            <option value="">Select Size</option>
            <option value="0">No Size</option>
            @foreach ($size_query as $item)
                <option value="{{ $item->id }}">{{ $item->size_name }}</option>
            @endforeach
        </select>
        <span id="select_size_error_{{$row}}"></span>
    </td>
    <td width="20%">
        <input required type="number" name="product_cost[]"  class="form-control" placeholder="Enter Product Cost"/>
    </td>
    <td width="20%">
        <input required type="number" name="product_price[]"  class="form-control" placeholder="Enter Product Price"/>
    </td>
    <td width="25%">
        <i style="cursor: pointer;" class="fa fa-1x fa-times text-danger delete_row" data-id="{{$row}}" aria-hidden="true"></i>
    </td>
</tr>