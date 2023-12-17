<form action="{{ route('admin.product-initiazile.payment-method.update', $model->id) }}" method="post" id="modal_form">
    @csrf
    @method('PATCH')
    <div class="row">

        {{-- Payment Method Name --}}
        <div class="col-md-4 form-group">
            <label for="method_name">Payment Method Name <span class="text-danger">*</span></label>
            <input type="text" name="method_name" value="{{ $model->method_name }}" id="edited_method_naem" class="form-control" placeholder="Enter Payment Method Name" required>
        </div>

        {{-- Payment Method Code --}}
        <div class="col-md-4 form-group">
            <label for="method_code_name">Payment Method Code Name <span class="text-danger">*</span></label>
            <input type="text" value="{{ $model->method_code_name }}" name="method_code_name" id="edited_method_code_name" class="form-control" placeholder="Enter Payment Method Code Name" required>
        </div>

        {{-- Status --}}
        <div class="col-md-4 form-group">
            <label for="status">Status <span class="text-danger">*</span></label>
            <select data-parsley-errors-container="#edited_status_error" required name="status" id="edited_status" class="form-control select" data-placeholder="Select Status">
                <option value="">Select Status</option>
                <option {{ $model->status == '1' ? 'selected' : ''}} value="1">Active</option>
                <option {{ $model->status == '0' ? 'selected' : ''}} value="0">Inactive</option>
            </select>
            <span id="edited_status_error"></span>
        </div>

        {{-- Method Has Transection ID --}}
        <div class="col-md-6 form-group">
            <label for="method_has_txr_id">Method Has Transection ID <span class="text-danger">*</span></label>
            <select name="method_has_txr_id" id="edited_method_has_txr_id" class="form-control select" data-placeholder="Select Option" data-parsley-errors-container="#edited_method_has_txr_id_error" required>
                <option value="">Select Option</option>
                <option {{ $model->method_has_txr_id == '1' ? 'selected' : '' }} value="1">Yes</option>
                <option {{ $model->method_has_txr_id == '0' ? 'selected' : '' }} value="0">No</option>
            </select>
            <span id="edited_method_has_txr_id_error"></span>
        </div>

        {{-- Method Has Mobile Number --}}
        <div class="col-md-6 form-group">
            <label for="method_has_mob_no">Method Has Mobile Number <span class="text-danger">*</span></label>
            <select name="method_has_mob_no" id="edited_method_has_mob_no" class="form-control select" data-placeholder="Select Option" data-parsley-errors-container="#edited_method_has_mob_no_error" required>
                <option value="">Select Option</option>
                <option {{ $model->method_has_mob_no == '1' ? 'selected' : '' }} value="1">Yes</option>
                <option {{ $model->method_has_mob_no == '0' ? 'selected' : '' }} value="0">No</option>
            </select>
            <span id="edited_method_has_mob_no_error"></span>
        </div>

        {{-- Payment Method Details --}}
        <div class="col-md-12 form-group">
            <label for="method_details">Payment Method Details</label>
            <textarea name="method_details" id="edited_method_details" class="form-control" cols="30" rows="2" placeholder="Enter Payment Method Description">{{ $model->method_details }}</textarea>
        </div>
    </div>
    <button type="submit" id="edit_submit" class="btn btn-primary float-right px-5"><i class="fa fa-floppy-o mr-3" aria-hidden="true"></i>Save</button>
    <button type="button" id="edit_submiting" class="btn btn-info float-right" id="submiting" style="display: none;"><i class="fa fa-spinner fa-spin fa-fw"></i>Loading...</button>
    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
</form>
