@can('expense_category.update')
    <button id="content_managment" data-url="{{ route('admin.expense.expense-category.edit',$model->id) }}" title="Edit {{ $model->name }}" class="btn btn-sm btn-info"><i class="fa fa-pencil-square-o"></i></button>
@endcan 

@can('expense_category.delete')
    <button id="delete_item" data-id ="{{ $model->id }}" data-url="{{ route('admin.expense.expense-category.destroy',$model->id) }}" title="Delete {{ $model->name }}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
@endcan
