@can('customer.show')
    <button title="View {{ $model->account_name }} Information" id="content_managment" data-url="{{ route('admin.account.bank-account.show',$model->id) }}"  class="btn btn-sm btn-warning"><i class="fa fa-eye"></i></button>
@endcan

@can('customer.update')
    <button title="Update {{ $model->account_name }} Information" id="content_managment" data-url="{{ route('admin.account.bank-account.edit',$model->id) }}"  class="btn btn-sm btn-info"><i class="fa fa-pencil-square-o"></i></button>
@endcan 

@can('customer.delete')
    <button title="Delete {{ $model->account_name }}" id="delete_item" data-id ="{{ $model->id }}" data-url="{{ route('admin.account.bank-account.destroy',$model->id) }}"  class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
@endcan