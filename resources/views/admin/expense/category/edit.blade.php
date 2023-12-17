<form action="{{ route('admin.expense.expense-category.update', $model->id) }}" method="post" id="modal_form">
    @csrf
    @method('PATCH')
 
    <div class="row">

        {{-- Expense Category Name --}}
        <div class="col-md-4 form-group">
            <label for="name">Expense Category Name <span class="text-danger">*</span></label>
            <input value="{{ $model->name }}" type="text" autocomplete="off" name="name" id="edit_name" class="form-control" required placeholder="Enter Expense Category Name">
        </div>

        {{-- Expense Category Parent --}}
        <div class="col-md-4 form-group">
            <label for="parent">Expense Category Parent <span class="text-danger">*</span> </label>
            <select data-parsley-errors-container="expense_category_parent_error" name="parent" id="edit_parent" class="form-control select" data-placeholder="Select Parent Category" required>
                <option value="">Select Parent Category</option>
                <option value="0" {{ $model->parent == 0 ? 'selected' : ''}}>As A Parent</option>
                @php
                    $categories = App\Models\Expense\ExpenseCategory::where('status', 1)->get();
                @endphp
                @foreach ($categories as $item)
                    <option {{ $model->parent == $item->id ? 'selected' : ''}} value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
            <span id="expense_category_parent_error"></span>
        </div>

        {{-- Status --}}
        <div class="col-md-4 form-group">
            <label for="status">Status <span class="text-danger">*</span></label>
            <select name="status" id="edit_status" class="form-control select" required data-parsley-errors-container="#status_error">
                <option {{ $model->status == 1 ? 'selected' : ''}} value="1">Active</option>
                <option {{ $model->status == 0 ? 'selected' : ''}} value="0">Inactive</option>
            </select>
            <span id="status_error"></span>
        </div>

        {{-- Category Description --}}
        <div class="col-md-12 form-group">
            <label for="details">Expense Category Description</label>
            <textarea name="details" id="edit_details" class="form-control" cols="30" rows="2">{{ $model->details }}</textarea>
        </div>
    </div>
    <button type="submit" id="edit_submit" class="btn btn-primary float-right px-5"><i class="fa fa-floppy-o mr-3" aria-hidden="true"></i>Save</button>
    <button type="button" id="edit_submiting" class="btn btn-info float-right" id="submiting" style="display: none;"><i class="fa fa-spinner fa-spin fa-fw"></i>Loading...</button>
    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
</form>
