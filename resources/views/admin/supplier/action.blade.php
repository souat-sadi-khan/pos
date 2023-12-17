@can('supplier.purchase')
    @if ($model->status == 1)
        <button title="Purchase From {{ $model->sup_name }}" type="button" class="btn btn-success btn-sm"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i></button>
    @else 
        <button type="button" class="btn btn-default btn-sm" disabled data-toggle="tooltip" data-placement="top" title="Supplier is InActive . Please Make Active"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i></button>
    @endif
@endcan

@can('supplier.view')
    <a title="View {{ $model->sup_name }} Information" href="{{ route('admin.supplier.show',$model->id) }}"><button class="btn btn-sm btn-warning"><i class="fa fa-eye"></i></button></a>
@endcan 

@can('supplier.update')
    <button id="content_managment" data-url="{{ route('admin.supplier.edit',$model->id) }}"  class="btn btn-sm btn-info" title="Edit {{ $model->sup_name }} Information" ><i class="fa fa-pencil-square-o"></i></button>
@endcan 

@can('supplier.delete')
    <button id="delete_item" data-id ="{{ $model->id }}" data-url="{{ route('admin.supplier.destroy',$model->id) }}" title="Delete {{ $model->sup_name }}"  class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
@endcan 