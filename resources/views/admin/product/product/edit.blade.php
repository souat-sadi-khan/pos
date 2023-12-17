<form action="{{ route('admin.products.products.update', $model->id) }}" method="post" id="modal_form">
    @csrf
    @method('PATCH')
    <div class="row">
        {{-- Product Image --}}
        <div class="col-md-12 form-group">
            <label for="product_image">Product Image</label>
            <input type="file" name="product_image" id="edited_product_image" class="form-control dropify" data-default-file="{{ $model->product_image != '' ? asset('storage/images/product/product'. '/'. $model->product_image) : asset('images/product.jpg')}}"> <span class="text-danger">Product Image must be under 2000 KB and width & hieght can not be greater then 1900 pixel </span>
        </div>

        {{-- Status --}}
        <div class="col-md-6 form-group">
            <label for="status">Status <span class="text-danger">*</span></label>
            <select name="status" id="edit_status" class="form-control select" required data-parsley-errors-container="#status_error">
                <option {{$model->status == 1 ? 'selected' : ''}} value="1">Active</option>
                <option {{$model->status == 0 ? 'selected' : ''}} value="0">Inactive</option>
            </select>
            <span id="status_error"></span>
        </div>

        {{-- Product Type --}}
        <div class="col-md-6 form-group">
            <label for="product_type">Product Type <span class="text-danger">*</span></label>
            <select name="product_type" id="product_type" class="form-control select" required data-parsley-errors-container="#product_type_error">
                <option {{$model->product_type == 'Standard' ? 'selected' : ''}} value="Standard">Standard</option>
                <option {{$model->product_type == 'Service' ? 'selected' : ''}} value="Service">Service</option>
            </select>
            <span id="product_type_error"></span>
        </div>

        {{-- Product Name --}}
        <div class="col-md-6 form-group">
            <label for="product_name">Product Name <span class="text-danger">*</span></label>
            <input value="{{ $model->product_name }}" type="text" name="product_name" id="edited_product_name" class="form-control" required placeholder="Enter Product Name">
        </div>

        {{-- Product Code --}}
        <div class="col-md-6 form-group">
            <label for="product_code">Product Code <span class="text-danger">*</span></label>
            <input type="text" name="product_code" id="edited_product_code" class="form-control" required placeholder="Enter Product Code" value="{{ $model->product_code }}">
        </div>

        {{-- Product Cost --}}
        <div class="col-md-6 form-group">
            <label for="product_cost">Product Cost <span class="text-danger">*</span></label>
            <input value="{{ $model->product_cost }}" type="number" name="product_cost" id="edited_product_cost" class="form-control" required placeholder="Enter Product Cost">
        </div>

        {{-- Product Price --}}
        <div class="col-md-6 form-group">
            <label for="product_price">Product Price <span class="text-danger">*</span></label>
            <input value="{{ $model->product_price }}" type="number" name="product_price" id="edited_product_price" class="form-control" required placeholder="Enter Product Price">
        </div>

        {{-- Product Category --}}
        <div class="col-md-6 form-group">
            <label for="product_category_id">Product Category</label>
            <select name="product_category_id" data-placeholder="Select Category" id="edited_product_category_id" class="form-control select" >
                <option value="">Select Category</option>
                <option {{ $model->category_id == '' ? 'selected' : ''}} value="0">No Category</option>
                @php
                    $category_query = App\Models\Products\Category::select('id', 'category_name')->where('status', 1)->get();
                @endphp
                @foreach ($category_query as $item)
                    <option {{ $model->category_id == $item->id ? 'selected' : ''}} value="{{ $item->id }}">{{ $item->category_name }}</option>
                @endforeach
            </select>
        </div>

        {{-- Product Supplier --}}
        <div class="col-md-6 form-group">
            <label for="supplier_id">Product Supplier</label>
            <select name="supplier_id" data-placeholder="Select Category" id="edited_supplier_id" class="form-control select">
                <option value="">Select Supplier</option>
                <option {{ $model->supplier_id == '' ? 'selected' : ''}} value="0">No Supplier</option>
                @php
                    $supplier_query = App\Models\Supplier::select('id', 'sup_name')->where('status', 1)->get();
                @endphp
                @foreach ($supplier_query as $item)
                    <option {{ $model->supplier_id == $item->id ? 'selected' : ''}} value="{{ $item->id }}">{{ $item->sup_name }}</option>
                @endforeach
            </select>
        </div>

        {{-- Product Brand --}}
        <div class="col-md-6 form-group">
            <label for="brand_id">Product Brand</label>
            <select name="brand_id" data-placeholder="Select Brand" id="edited_brand_id" class="form-control select">
                <option value="">Select Brand</option>
                <option {{ $model->brand_id == '' ? 'selected' : ''}} value="0">No Brand</option>
                @php
                    $supplier_query = App\Models\Products\Brand::select('id', 'brand_name')->where('status', 1)->get();
                @endphp
                @foreach ($supplier_query as $item)
                    <option {{ $model->brand_id == $item->id ? 'selected' : ''}} value="{{ $item->id }}">{{ $item->brand_name }}</option>
                @endforeach
            </select>
        </div>

        {{-- Barcode Symbiology --}}
        <div class="col-md-6 form-group">
            <label for="barcode_symbiology">Barcode Symbiology</label>
            <select name="barcode_symbiology" data-placeholder="Select Barcode Symbiology" id="edited_barcode_symbiology" class="form-control select">
                <option value="">Select Barcode Symbiology</option>
                <option {{$model->barcode_symbiology == '0' ? 'selected' : ''}} value="0">No Barcode Symbiology</option>
                <option {{$model->barcode_symbiology == 'code25' ? 'selected' : ''}} value="code25">code25</option>
                <option {{$model->barcode_symbiology == 'code39' ? 'selected' : ''}} value="code39">code39</option>
                <option {{$model->barcode_symbiology == 'code128' ? 'selected' : ''}} value="code128">code128</option>
                <option {{$model->barcode_symbiology == 'ean5' ? 'selected' : ''}} value="ean5">ean5</option>
                <option {{$model->barcode_symbiology == 'ean13' ? 'selected' : ''}} value="ean13">ean13</option>
                <option {{$model->barcode_symbiology == 'upca' ? 'selected' : ''}} value="upca">upca</option>
                <option {{$model->barcode_symbiology == 'upce' ? 'selected' : ''}} value="upce">upce</option>
            </select>
        </div>

        {{-- Product Box --}}
        <div class="col-md-6 form-group">
            <label for="box_id">Product Box</label>
            <select name="box_id" data-placeholder="Select Box" id="edited_box_id" class="form-control select">
                <option value="">Select Box</option>
                <option {{ $model->box_id == '' ? 'selected' : ''}} value="0">No Box</option>
                @php
                    $supplier_query = App\Models\Products\Box::select('id', 'box_name')->where('status', 1)->get();
                @endphp
                @foreach ($supplier_query as $item)
                    <option {{ $model->box_id == $item->id ? 'selected' : ''}} value="{{ $item->id }}">{{ $item->box_name }}</option>
                @endforeach
            </select>
        </div>

        {{-- Product Unit --}}
        <div class="col-md-6 form-group">
            <label for="box_id">Product Unit</label>
            <select name="unit_id" data-placeholder="Select Unit" id="edited_unit_id" class="form-control select">
                <option value="">Select Unit</option>
                <option {{ $model->unit_id == '' ? 'selected' : ''}} value="0">No Unit</option>
                @php
                    $supplier_query = App\Models\Products\Unit::select('id', 'unit_name')->where('status', 1)->get();
                @endphp
                @foreach ($supplier_query as $item)
                    <option {{ $model->unit_id == $item->id ? 'selected' : ''}} value="{{ $item->id }}">{{ $item->unit_name }}</option>
                @endforeach
            </select>
        </div>

        {{-- Product Tax --}}
        <div class="col-md-6 form-group">
            <label for="box_id">Product Tax</label>
            <select name="tax_id" data-placeholder="Select Tax" id="edited_tax_id" class="form-control select">
                <option value="">Select Tax</option>
                <option {{ $model->tax_id == '' ? 'selected' : ''}} value="0">No Tax</option>
                @php
                    $supplier_query = App\Models\Products\TaxRate::select('id', 'tax_name')->where('status', 1)->get();
                @endphp
                @foreach ($supplier_query as $item)
                    <option {{ $model->tax_id == $item->id ? 'selected' : ''}} value="{{ $item->id }}">{{ $item->tax_name }}</option>
                @endforeach
            </select>
        </div>

        {{-- Tax Method --}}
        <div class="col-md-6 form-group">
            <label for="tax_method">Tax Method <span class="text-danger">*</span></label>
            <select name="tax_method" id="tax_method" class="form-control select" data-parsley-errors-container="#tax_method_error" data-placeholder="Select Tax Method" required >
                <option value="">Select Tax Method</option>
                <option {{ $model->tax_method == 'Inclusive' ? 'selected' : ''}} value="Inclusive" selected>Inclusive</option>
                <option {{ $model->tax_method == 'Exclusive' ? 'selected' : ''}} value="Exclusive">Exclusive</option>
            </select>
            <span id="tax_method_error"></span>
        </div>

        {{-- Stock Alert --}}
        <div class="col-md-6 form-group">
            <label for="product_alert">Stock Alert <span class="text-danger">*</span></label>
            <input type="number" name="product_alert" id="product_alert" class="form-control" required placeholder="Enter Product Stock Alert" value="{{ $model->product_alert }}">
        </div>

        {{-- HSN Code --}}
        <div class="col-md-6 form-group">
            <label for="hsn_code">HSN Code</label>
            <input value="{{ $model->hsn_code }}" type="text" placeholder="Enter HSN Code" name="hsn_code" id="hsn_code" class="form-control">
        </div>

        {{-- Product Description --}}
        <div class="col-md-12 form-group">
            <label for="product_details">Product Description</label>
            <textarea name="product_details" id="edited_product_details" class="form-control summernote" cols="30" rows="2">{!! $model->product_details !!} </textarea>
        </div>
    </div>
    <button type="submit" id="edit_submit" class="btn btn-primary float-right px-5"><i class="fa fa-floppy-o mr-3" aria-hidden="true"></i>Save</button>
    <button type="button" id="edit_submiting" class="btn btn-info float-right" id="submiting" style="display: none;"><i class="fa fa-spinner fa-spin fa-fw"></i>Loading...</button>
    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
</form>