@can('color.update')
    <button id="content_managment" data-url="{{ route('admin.product-initiazile.color.edit',$model->id) }}" title="Edit {{ $model->color_name }}" class="btn btn-sm btn-info"><i class="fa fa-pencil-square-o"></i></button>
@endcan 

@can('color.delete')
    <button id="delete_item" data-id ="{{ $model->id }}" data-url="{{ route('admin.product-initiazile.color.destroy',$model->id) }}" title="Delete {{ $model->color_name }}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
@endcan
