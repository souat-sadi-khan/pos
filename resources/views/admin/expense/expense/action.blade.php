{{-- view --}}
<button title="View {{$model->what_for}} Information" id="content_managment" data-url="{{ route('admin.expense.expense.show',$model->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-eye"></i></button>

{{-- Edit --}}
@can('expense_category.update')
    <button id="content_managment" data-url="{{ route('admin.expense.expense.edit',$model->id) }}" title="Edit {{ $model->what_for }}" class="btn btn-sm btn-info"><i class="fa fa-pencil-square-o"></i></button>
@endcan 

{{-- Delete --}}
@can('expense_category.delete')
    <button id="delete_item" data-id ="{{ $model->id }}" data-url="{{ route('admin.expense.expense.destroy',$model->id) }}" title="Delete {{ $model->what_for }}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
@endcan
