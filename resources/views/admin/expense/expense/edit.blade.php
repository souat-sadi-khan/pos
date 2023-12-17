<div class="col-md-6 mx-auto text-center border mb-3 bg-light border-info">
    <b>Edit Expense Information for : {{ $model->ref_no }}</b>
</div>

<form action="{{ route('admin.expense.expense.update', $model->id) }}" method="post" id="modal_form">
    @csrf
    @method('PATCH')
 
    <div class="row">

        {{-- Reference No --}}
        <div class="col-md-6 form-group">
            <label for="ref_no">Reference No <span class="text-danger">*</span></label>
            <input readonly value="{{ $model->ref_no }}" type="text" autocomplete="off" name="ref_no" id="edit_ref_no" class="form-control" required placeholder="Enter Expense CReference Numbere">
        </div>

        {{-- Category --}}
        <div class="col-md-6 form-group">
            <label for="category_id">Categoy <span class="text-danger">*</span></label>
            <select name="category_id" id="edit_category_id" class="form-control select" data-parsley-errors-container="#expense_category_error" data-placeholder="Select Expense Category" required>
                <option value="">Select Expense Category </option>
                @php
                    $categories = App\Models\Expense\ExpenseCategory::where('status', 1)->get();
                @endphp
                @foreach ($categories as $item)
                    <option {{ $model->category_id == $item->id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>

        {{-- What for --}}
        <div class="col-md-6 form-group">
            <label for="what_for">What for? <span class="text-danger">*</span></label>
            <input value="{{ $model->what_for }}" type="text" autocomplete="off" name="what_for" id="edit_what_for" class="form-control" required placeholder="Enter What purpose">
        </div>

        {{-- Amount --}}
        <div class="col-md-6 form-group">
            <label for="amount">Amount <span class="text-danger">*</span></label>
            <input value="{{ $model->amount }}" type="number" id="edit_amount" name="amount" class="form-control" placeholder="Enter Amount" required>
        </div>

        {{-- Returnable? --}}
        <div class="col-md-12 form-group">
            <label for="returnable">Returnable? <span class="text-danger">*</span></label>
            <select name="returnable" id="edit_returnable" class="form-control select" required data-parsley-errors-container="#returnable_error">
                <option value="1" {{ $model->returnable == 1 ? 'selected' : ''}} >Yes</option>
                <option value="0" {{ $model->returnable == 0 ? 'selected' : ''}} >No</option>
            </select>
            <span id="returnable_error"></span>
        </div>

        {{-- Notes --}}
        <div class="col-md-12 form-group">
            <label for="notes">Note</label>
            <textarea name="notes" id="edit_notes" class="form-control" cols="30" rows="2">{{ $model->notes }}</textarea>
        </div>
    </div>
    <button type="submit" id="edit_submit" class="btn btn-primary float-right px-5"><i class="fa fa-floppy-o mr-3" aria-hidden="true"></i>Save</button>
    <button type="button" id="edit_submiting" class="btn btn-info float-right" id="submiting" style="display: none;"><i class="fa fa-spinner fa-spin fa-fw"></i>Loading...</button>
    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
</form>
