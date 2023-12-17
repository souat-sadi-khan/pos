<div class="col-md-6 mx-auto text-center mb-3 border bg-light border-info">
    <b>Create New Product</b>
</div>
<form data-xhr="new_product" action="{{ route('admin.purchasse.add_product_from_purchase_post') }}" data-select="box_id" method="post" class="remote_form">
    @csrf
    <div class="row">
        {{-- Product Image --}}
        <div class="col-md-12 form-group">
            <label for="product_image">Product Image</label>
            <input type="file" name="product_image" id="product_image" class="form-control dropify"> <span class="text-danger">Product Image must be under 2000 KB and width & hieght can not be greater then 1900 pixel </span>
        </div>

        {{-- Status --}}
        <div class="col-md-6 form-group">
            <label for="status">Status <span class="text-danger">*</span></label>
            <select name="status" id="status" class="form-control select" required data-parsley-errors-container="#status_error">
                <option value="1" selected>Active</option>
                <option value="0">Inactive</option>
            </select>
            <span id="status_error"></span>
        </div>

        {{-- Product Type --}}
        <div class="col-md-6 form-group">
            <label for="product_type">Product Type <span class="text-danger">*</span></label>
            <select name="product_type" id="product_type" class="form-control select" required data-parsley-errors-container="#product_type_error">
                <option value="Standard" selected>Standard</option>
                <option value="Service">Service</option>
            </select>
            <span id="product_type_error"></span>
        </div>

        {{-- Product Name --}}
        <div class="col-md-6 form-group">
            <label for="product_name">Product Name <span class="text-danger">*</span></label>
            <input type="text" name="product_name" id="product_name" class="form-control" required placeholder="Enter Product Name">
        </div>

        {{-- Product Code --}}
        <div class="col-md-6 form-group">
            <label for="product_code">Product Code <span class="text-danger">*</span></label>
            <div class="input-group"  data-target-input="nearest">
                <input data-parsley-errors-container="#product_code_error" type="text" name="product_code" id="product_code" class="form-control" required placeholder="Enter Product Name">
                <div class="input-group-append generate_random_number" style="cursor: pointer;" data-target="#timepicker" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-repeat"></i></div>
                </div>
            </div>
            <span id="product_code_error"></span>
        </div>

        {{-- Product Variation --}}
        <div class="col-md-12 form-group">
            <label for="product_variations">Product Variations <span class="text-danger">*</span></label>
            <select data-url="{{ route('admin.products.add_variations') }}" name="product_variations" id="product_variations" class="form-control select" data-placeholder="Select Product Variation" data-parsley-errors-container="#product_variations_errors" required>
                <option value="">Select Product Variation</option>
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
            <span id="product_variations_errors"></span>
        </div>

        <div class="col-md-12" id="product_variations_data"></div>

        {{-- Product Cost --}}
        <div class="col-md-6 form-group mb-3" id="product_cost_area">
            <label for="product_cost">Product Cost Price<span class="text-danger">*</span></label>
            <input type="number" name="product_cost" id="product_cost" class="form-control" required placeholder="Enter Product Cost">
        </div>

        {{-- Product Price --}}
        <div class="col-md-6 form-group" id="product_price_area">
            <label for="product_price">Product Sell Price <span class="text-danger">*</span></label>
            <input type="number" name="product_price" id="product_price" class="form-control" required placeholder="Enter Product Price"><span class="text-danger" id="product_price_not_give"></span>
        </div>

        {{-- Product Category --}}
        <div class="col-md-6 form-group">
            <label for="product_category_id">Product Category</label>
            <select name="product_category_id" data-placeholder="Select Category" id="product_category_id" class="form-control select">
                <option value="">Select Category</option>
                <option selected value="0">No Category</option>
                @php
                    $category_query = App\Models\Products\Category::select('id', 'category_name')->where('status', 1)->get();
                @endphp
                @foreach ($category_query as $item)
                    <option value="{{ $item->id }}">{{ $item->category_name }}</option>
                @endforeach
            </select>
        </div>

        {{-- Product Supplier --}}
        <div class="col-md-6 form-group">
            <label for="supplier_id">Product Supplier</label>
            <input type="text" value="{{ $name }}" class="form-control" readonly required>
            <input type="hidden" name="supplier_id" value="{{ $id }}" class="form-control" readonly required>
        </div>

        {{-- Product Brand --}}
        <div class="col-md-6 form-group">
            <label for="brand_id">Product Brand</label>
            <select name="brand_id" data-placeholder="Select Brand" id="brand_id" class="form-control select">
                <option value="">Select Brand</option>
                <option selected value="0">No Brand</option>
                @php
                    $supplier_query = App\Models\Products\Brand::select('id', 'brand_name')->where('status', 1)->get();
                @endphp
                @foreach ($supplier_query as $item)
                    <option value="{{ $item->id }}">{{ $item->brand_name }}</option>
                @endforeach
            </select>
        </div>

        {{-- Barcode Symbiology --}}
        <div class="col-md-6 form-group">
            <label for="barcode_symbiology">Barcode Symbiology</label>
            <select name="barcode_symbiology" data-placeholder="Select Barcode Symbiology" id="barcode_symbiology" class="form-control select">
                <option value="">Select Barcode Symbiology</option>
                <option selected value="0">No Barcode Symbiology</option>
                <option value="code25">code25</option>
                <option value="code39">code39</option>
                <option value="code128">code128</option>
                <option value="ean5">ean5</option>
                <option value="ean13">ean13</option>
                <option value="upca">upca</option>
                <option value="upce">upce</option>
            </select>
        </div>

        {{-- Product Box --}}
        <div class="col-md-6 form-group">
            <label for="box_id">Product Box</label>
            <select name="box_id" data-placeholder="Select Box" id="box_id" class="form-control select">
                <option value="">Select Box</option>
                <option selected value="0">No Box</option>
                @php
                    $supplier_query = App\Models\Products\Box::select('id', 'box_name')->where('status', 1)->get();
                @endphp
                @foreach ($supplier_query as $item)
                    <option value="{{ $item->id }}">{{ $item->box_name }}</option>
                @endforeach
            </select>
        </div>

        {{-- Product Unit --}}
        <div class="col-md-6 form-group">
            <label for="unit_id">Product Unit</label>
            <div class="input-group"  data-target-input="nearest">
                <select name="unit_id" data-placeholder="Select Unit" id="unit_id" class="form-control select">
                    <option value="">Select Unit</option>
                    <option selected value="0">No Unit</option>
                    @php
                        $supplier_query = App\Models\Products\Unit::select('id', 'unit_name')->where('status', 1)->get();
                    @endphp
                    @foreach ($supplier_query as $item)
                        <option value="{{ $item->id }}">{{ $item->unit_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        {{-- Product Tax --}}
        <div class="col-md-6 form-group">
            <label for="tax_id">Product Tax</label>
            <select name="tax_id" data-placeholder="Select Tax" id="tax_id" class="form-control select">
                <option value="">Select Tax</option>
                <option selected value="0">No Tax</option>
                @php
                    $supplier_query = App\Models\Products\TaxRate::where('status', 1)->get();
                @endphp
                @foreach ($supplier_query as $item)
                    <option value="{{ $item->id }}">{{ $item->tax_name }} ({{ $item->tax_rules == 'mod' ? $item->tax_rate . ' %' : $item->tax_rate . '+'}})</option>
                @endforeach
            </select>
        </div>

        {{-- Tax Method --}}
        <div class="col-md-6 form-group">
            <label for="tax_method">Tax Method <span class="text-danger">*</span></label>
            <select name="tax_method" id="tax_method" class="form-control select" data-parsley-errors-container="#tax_method_error" data-placeholder="Select Tax Method" required >
                <option value="">Select Tax Method</option>
                <option value="Inclusive" selected>Inclusive</option>
                <option value="Exclusive">Exclusive</option>
            </select>
            <span id="tax_method_error"></span>
        </div>

        {{-- Stock Alert --}}
        <div class="col-md-6 form-group">
            <label for="product_alert">Stock Alert <span class="text-danger">*</span></label>
            <input type="number" name="product_alert" id="product_alert" class="form-control" required placeholder="Enter Product Stock Alert" value="10">
        </div>

        {{-- HSN Code --}}
        <div class="col-md-6 form-group">
            <label for="hsn_code">HSN Code</label>
            <input type="text" placeholder="Enter HSN Code" name="hsn_code" id="hsn_code" class="form-control">
        </div>

        {{-- Product Description --}}
        <div class="col-md-12 form-group">
            <label for="product_details">Product Description</label>
            <textarea name="product_details" id="product_details" class="form-control summernote" cols="30" rows="2"></textarea>
        </div>
    </div>
    <button type="submit" id="remote_submit_new_product" class="btn btn-primary float-right px-5"><i class="fa fa-floppy-o mr-3" aria-hidden="true"></i>Submit</button>
    <button type="button" id="remote_submiting_new_product" class="btn btn-sm btn-info float-right px-5" id="submiting" style="display: none;"><i class="fa fa-spinner fa-spin fa-fw"></i>Loading...</button>

    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
</form>

<script>
    _componentDropFile();
    _componentSelect2Normal();
    _remortClassFormValidation();
    
    // Enter Product Code in Product code input filed
    $('#product_code').val(Math.floor(Math.random() * 10000) + 1);

    // generate new product code
    $('.generate_random_number').click(function() {
        $('#product_code').val(Math.floor(Math.random() * 10000) + 1);
    });

    $('#product_variations').change(function() {
        var val = $(this).val();
        if(val == 1) {
            var url = $(this).data('url');
            $('#product_price').attr('disabled','1');
            $('#product_price').removeAttr('required');
            $('#product_cost').attr('disabled','1');
            $('#product_cost').removeAttr('required');
            $('#product_cost_area').fadeOut();
            $('#product_price_area').fadeOut();
            $.ajax({
                url: url,
                type: "GET",
                success: function(data){
                    $('#product_variations_data').fadeIn();
                    $("#product_variations_data").html(data);
                }
            });
        } else {
            $('#product_price').attr('required','1');
            $('#product_price').removeAttr('disabled');
            $('#product_cost').attr('required','1');
            $('#product_cost').removeAttr('disabled');
            $('#product_variations_data').fadeOut();
            $('#product_variations_data').html('');
            $('#product_cost_area').fadeIn();
            $('#product_price_area').fadeIn();
        }
    });
</script>