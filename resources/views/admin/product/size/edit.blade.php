<form action="{{ route('admin.product-initiazile.size.update', $model->id) }}" method="post" id="modal_form">
    @csrf
    @method('PATCH')
    <div class="row">

        {{-- Product Size Name --}}
        <div class="col-md-6 form-group">
            <label for="size_name">Product Size Name <span class="text-danger">*</span></label>
            <input style="text-transform: uppercase;" type="text" value="{{ $model->size_name }}" name="size_name" id="size_name" class="form-control" placeholder="Enter Product Size Name" required>
        </div>

        {{-- Status --}}
        <div class="col-md-6 form-group">
            <label for="status">Status <span class="text-danger">*</span></label>
            <select data-parsley-errors-container="#status_error" required name="status" id="status" class="form-control select" data-placeholder="Select Status">
                <option value="">Select Status</option>
                <option {{ $model->status == '1' ? 'selected' : ''}} value="1">Active</option>
                <option {{ $model->status == '0' ? 'selected' : ''}} value="0">Inactive</option>
            </select>
            <span id="status_error"></span>
        </div>

        {{-- Size Details --}}
        <div class="col-md-12 form-group">
            <label for="size_details">Size Details</label>
            <textarea name="size_details" id="size_details" class="form-control" cols="30" rows="2" placeholder="Enter Size Description">{{ $model->size_details }}</textarea>
        </div>
    </div>
    <button type="submit" id="edit_submit" class="btn btn-primary float-right px-5"><i class="fa fa-floppy-o mr-3" aria-hidden="true"></i>Save</button>
    <button type="button" id="edit_submiting" class="btn btn-info float-right" id="submiting" style="display: none;"><i class="fa fa-spinner fa-spin fa-fw"></i>Loading...</button>
    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
</form>
