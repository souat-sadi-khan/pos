@can('size.update')
    <button id="content_managment" data-url="{{ route('admin.product-initiazile.size.edit',$model->id) }}" title="Edit {{ $model->size_naem }}" class="btn btn-sm btn-info"><i class="fa fa-pencil-square-o"></i></button>
@endcan 

@can('size.delete')
    <button id="delete_item" data-id ="{{ $model->id }}" data-url="{{ route('admin.product-initiazile.size.destroy',$model->id) }}" title="Delete {{ $model->size_name }}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
@endcan
