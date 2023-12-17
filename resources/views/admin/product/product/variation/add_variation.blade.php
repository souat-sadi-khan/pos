<div class="col-md-12 border border-info">
    <div class="row">
        <div class="col-md-6 bg-light mx-auto my-2 text-center" style="border: 2px dotted black;">
            <b>Create Product Variation</b>
        </div>

        <div class="table-responsive col-md-12">
            <table id="myTable" class="table table-bordered table-striped order-list">
                <thead>
                    <tr class="table-info">
                        <th class="text-center" width="25%">Color</th>
                        <th class="text-center" width="25%">Size</th>
                        <th class="text-center" width="20%">Cost</th>
                        <th class="text-center" width="25%">Price</th>
                        <th width="5%"><i class="fa fa-trash" aria-hidden="true"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td width="25%">
                            @php
                                $color_query = App\Models\Products\Color::where('status', 1)->select('id', 'color_name')->get();
                            @endphp
                            
                            <select data-parsley-errors-container="#select_color_error" name="color[]" class="form-control select" data-placeholder="Select Color" required>
                                <option value="">Select Color</option>
                                <option value="0">No Color</option>
                                @foreach ($color_query as $item)
                                    <option value="{{ $item->id }}">{{ $item->color_name }}</option>
                                @endforeach
                            </select>
                            <span id="select_color_error"></span>
                        </td>
                        <td width="25%">
                            @php
                                $size_query = App\Models\Products\Size::where('status', 1)->select('id', 'size_name')->get();
                            @endphp
                            
                            <select data-parsley-errors-container="#select_size_error" name="size[]" class="form-control select" data-placeholder="Select Xize" required>
                                <option value="">Select Size</option>
                                <option value="0">No Size</option>
                                @foreach ($size_query as $item)
                                    <option value="{{ $item->id }}">{{ $item->size_name }}</option>
                                @endforeach
                            </select>
                            <span id="select_size_error"></span>
                        </td>
                        <td width="20%">
                            <input type="number" required name="product_cost[]"  class="form-control" placeholder="Enter Product Cost"/>
                        </td>
                        <td width="20%">
                            <input type="number" required name="product_price[]"  class="form-control" placeholder="Enter Product Price"/>
                        </td>
                        <td width="25%">

                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5" style="text-align: left;">
                            <input data-url="{{ route('admin.products.add_one_more_row') }}" type="button" class="btn btn-primary btn-sm addrow" value="Add Row" />
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
<input type="hidden" id="number" value="0">


<script>
    $('.select').select2({width:'100%'});

    $(".addrow").on('click', function(){
        var url = $(this).data('url');
        var type = $('#number').val();
        type = parseInt(type);
        row = type + 1;
        $('#number').val(row);
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'html',
            data: {
                row: row
            },
            success: function(data) {
                $("table.order-list").append(data);
                $('.select').select2({width:'100%'});
            }
        });
    });

    // delete the row
    $(document).on('click', '.delete_row', function() {
        var row_id = $(this).data('id');
        $("#table_row_" + row_id).fadeOut('slow').remove();
    });



    // $("table.order-list").on("click", ".ibtnDel", function (event) {
    //     $(this).closest("tr").remove();       
    //     counter -= 1
    // });
</script>