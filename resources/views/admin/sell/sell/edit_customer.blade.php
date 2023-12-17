<div class="col-md-6 mx-auto text-center border bg-light border-info">
    <b>Update Customer Information</b>
</div>
<form data-xhr="edit_customer" action="{{ route('admin.update_customer_from_pos',$customer->id) }}" method="post" class="remote_form">
    @method('PATCH')
    @csrf
    <div class="row">
        {{-- Name --}}
        <div class="col-md-6 form-group">
            <label for="customer_name">Name <span class="text-danger">*</span></label>
            <input value="{{ $customer->customer_name }}" type="text" name="customer_name" id="customer_name" class="form-control" placeholder="Enter Customer Name" required>
        </div>

        {{-- Credit Balance --}}
        <div class="col-md-6 form-group">
            <label for="credit_balance">Credit Balance</label>
            <input type="number" name="credit_balance" id="credit_balance" class="form-control" placeholder="Enter Customer Credit Balance" value="{{ $customer->credit_balance }}">
        </div>

        {{-- Phone --}}
        <div class="col-md-6 form-group">
            <label for="customer_mobile">Phone <span class="text-danger">*</span></label>
            <input type="text" name="customer_mobile" id="customer_mobile" class="form-control" placeholder="Enter Customer Phone" value="{{ $customer->customer_mobile }}" required>
        </div>

        {{-- Date of Birth --}}
        <div class="col-md-6 form-group">
            <label for="date_of_birth">Date of Birth </label>
            <input type="text" name="date_of_birth" id="date_of_birth" class="form-control take_date" value="{{ $customer->date_of_birth }}" placeholder="Enter Customer Date of Birth">
        </div>

        {{-- Email --}}
        <div class="col-md-6 form-group">
            <label for="customer_email">Email</label>
            <input type="email" value="{{ $customer->customer_email }}" name="customer_email" id="customer_email" class="form-control" placeholder="Enter Customer Email">
        </div>

        {{-- Sex --}}
        <div class="col-md-6 form-group">
            <label for="customer_sex">Sex</label>
            <select name="customer_sex" id="customer_sex" class="form-control select" data-placeholder="Select Sex">
                <option value="">Select Sex</option>
                <option {{ $customer->customer_sex == 'Male' ? 'selected' : ''}} value="Male">Male</option>
                <option {{ $customer->customer_sex == 'Female' ? 'selected' : ''}} value="Female">Female</option>
                <option {{ $customer->customer_sex == 'Other' ? 'selected' : ''}} value="Other">Other</option>
            </select>
        </div>

        {{-- Age --}}
        <div class="col-md-6 form-group">
            <label for="customer_age">Age</label>
            <input type="text" name="customer_age" id="customer_age" class="form-control" value="{{ $customer->customer_age }}" placeholder="Enter Customer Age">
        </div>

        {{-- Gtin --}}
        <div class="col-md-6 form-group">
            <label for="gtin">Gtin</label>
            <input type="text" name="gtin" value="{{ $customer->gtin }}" id="gtin" class="form-control" placeholder="Enter Customer Gtin">
        </div>

        {{-- Address --}}
        <div class="col-md-12 form-group">
            <label for="customer_address">Address</label>
            <textarea name="customer_address" id="customer_address" value="{{ $customer->customer_address }}" class="form-control" placeholder="Ener Customer Address" cols="30" rows="2"></textarea>
        </div>

        {{-- City --}}
        <div class="col-md-6 form-group">
            <label for="customer_city">City</label>
            <input type="text" name="customer_city" value="{{ $customer->customer_city }}" id="customer_city" class="form-control" placeholder="Enter Customer City">
        </div>

        {{-- State --}}
        <div class="col-md-6 form-group">
            <label for="customer_state">State</label>
            <input type="text" value="{{ $customer->customer_state }}" name="customer_state" id="customer_state" class="form-control" placeholder="Enter Customer State">
        </div>

        {{-- Country --}}
        <div class="col-md-6 form-group">
            <label for="customer_country">Country</label>
            <input type="text" name="customer_country" value="{{ $customer->customer_country }}" id="customer_country" class="form-control" placeholder="Enter Customer Country" value="Bangladesh">
        </div>

        {{-- Status --}}
        <div class="col-md-6 form-group">
            <label for="status">Status <span class="text-danger">*</span></label>
            <select data-parsley-errors-container="#customer_status_save_error" required name="status" id="status" class="form-control select" data-placeholder="Select Customer Status">
                <option value="">Select  Customer Status</option>
                <option {{ $customer->status == 1 ? 'selected' : ''}} value="1">Active</option>
                <option {{ $customer->status == 0 ? 'selected' : ''}} value="0">Inactive</option>
            </select>
            <span id="customer_status_save_error"></span>
        </div>
    </div>

    @if ($customer->id != 1)
        <button type="submit" id="remote_submit_edit_customer" class="btn btn-primary float-right px-5"><i class="fa fa-floppy-o mr-3" aria-hidden="true"></i>Submit</button>
        <button type="button" id="remote_submiting_edit_customer" class="btn btn-sm btn-info float-right px-5" id="submiting" style="display: none;"><i class="fa fa-spinner fa-spin fa-fw"></i>Loading...</button>
    @endif

    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
</form>

<script>
    $('#parent_id').select2({width:'100%'});
</script>