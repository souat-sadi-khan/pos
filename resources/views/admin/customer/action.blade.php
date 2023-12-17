@can('customer.sell')
    <button title="Sell on {{ $model->customer_name }}" class="btn btn-success btn-sm" type="button" disabled><i class="fa fa-cart-plus" aria-hidden="true"></i></button>
@endcan 

@can('customer.show')
    <a title="View {{ $model->customer_name }} Information" href="{{ route('admin.customer.show',$model->id) }}"><button class="btn btn-sm btn-warning"><i class="fa fa-eye"></i></button></a>
@endcan

@can('customer.update')
    <button title="Update {{ $model->customer_name }} Information" id="content_managment" data-url="{{ route('admin.customer.edit',$model->id) }}"  class="btn btn-sm btn-info"><i class="fa fa-pencil-square-o"></i></button>
@endcan 

@can('customer.delete')
    <button title="Delete {{ $model->customer_name }}" id="delete_item" data-id ="{{ $model->id }}" data-url="{{ route('admin.customer.destroy',$model->id) }}"  class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
@endcan