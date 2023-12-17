@if ($model->id != 1 && $model->id != 2 && $model->id != 3)
    @can('payment_method.update')
        <button id="content_managment" data-url="{{ route('admin.product-initiazile.payment-method.edit',$model->id) }}" title="Edit {{ $model->method_name }}" class="btn btn-sm btn-info"><i class="fa fa-pencil-square-o"></i></button>
    @endcan 

    @can('payment_method.delete')
        <button id="delete_item" data-id ="{{ $model->id }}" data-url="{{ route('admin.product-initiazile.payment-method.destroy',$model->id) }}" title="Delete {{ $model->method_name }}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
    @endcan

@endif