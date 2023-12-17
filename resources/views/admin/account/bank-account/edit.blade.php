<div class="col-md-6 mx-auto text-center border mb-3 bg-light border-info">
    <b>Edit Bank Account Information for : {{ $model->account_name }}</b>
</div>

<form action="{{ route('admin.account.bank-account.update', $model->id) }}" method="post" id="modal_form">
    @csrf
    @method('PATCH')
 
    <div class="row">

        {{-- Account Name --}}
        <div class="col-md-6 form-group">
            <label for="account_name">Account Name <span class="text-danger">*</span></label>
            <input value="{{ $model->account_name }}" type="text" name="account_name" id="edit_account_name" class="form-control" placeholder="Enter Account Name" required>
        </div>

        {{-- Account Number --}}
        <div class="col-md-6 form-group">
            <label for="account_no">Account Number <span class="text-danger">*</span></label>
            <input value="{{ $model->account_no }}" type="text" name="account_no" id="edit_account_no" class="form-control" placeholder="Enter Account Number" required>
        </div>

        {{-- Phone --}}
        <div class="col-md-6 form-group">
            <label for="phone">Phone <span class="text-danger">*</span></label>
            <input value="{{ $model->phone }}" type="text" name="phone" id="edit_phone" class="form-control" placeholder="Enter Phone Number" required>
        </div>

        {{-- Contact Person --}}
        <div class="col-md-6 form-group">
            <label for="contact_person">Contact Person <span class="text-danger">*</span></label>
            <input value="{{ $model->contact_person }}" type="text" name="contact_person" id="edit_contaact_person" class="form-control" placeholder="Enter Contact Person Name" required>
        </div>

        {{-- Internet Banking URL --}}
        <div class="col-md-6 form-group">
            <label for="account_url">Internet Banking URL</label>
            <input value="{{ $model->account_url }}" type="text" name="account_url" id="edit_account_url" class="form-control" placeholder="Enter Internet Banking URL">
        </div>

        {{-- Status --}}
        <div class="col-md-6 form-group">
            <label for="status">Status <span class="text-danger">*</span></label>
            <select required name="status" id="edit_status" class="form-control select" data-placeholder="Select Status" data-parsley-errors-container="#edit_status_error">
                <option value="">Select Status</option>
                <option {{ $model->status == 1 ? 'selected' : ''}} value="1">Active</option>
                <option {{ $model->status == 1 ? 'selected' : ''}} value="0">Inactive</option>
            </select>
            <span id="edit_status_error"></span>
        </div>

        {{-- Account Details --}}
        <div class="col-md-12 form-group">
            <label for="account_details">Account Details</label>
            <textarea name="account_details" id="edit_account_details" cols="30" rows="2" class="form-control" placeholder="Enter Account Details">{{ $model->account_details }}</textarea>
        </div>

    </div>

    <button type="submit" id="edit_submit" class="btn btn-primary float-right px-5"><i class="fa fa-floppy-o mr-3" aria-hidden="true"></i>Save</button>
    <button type="button" id="edit_submiting" class="btn btn-info float-right" id="submiting" style="display: none;"><i class="fa fa-spinner fa-spin fa-fw"></i>Loading...</button>
    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
</form>
