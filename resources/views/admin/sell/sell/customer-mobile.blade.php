<div class="col-md-6 mx-auto text-center border bg-light border-info">
    <b>Update Customer Mobile Number</b>
</div>
<form data-xhr="edit_customer" action="{{ route('admin.update_customer_mobile_from_pos',$customer->id) }}" method="post" class="remote_form">
    @method('PATCH')
    @csrf
    <div class="row">
        {{-- Phone --}}
        <div class="col-md-12 form-group">
            <label for="customer_mobile">Phone <span class="text-danger">*</span></label>
            <input type="text" name="customer_mobile" id="customer_mobile" class="form-control" placeholder="Enter Customer Phone" value="{{ $customer->customer_mobile }}" required>
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