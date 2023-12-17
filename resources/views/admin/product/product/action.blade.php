{{-- View --}}
@can('product.view')
    <a href="{{ route('admin.products.products.show', $model->id) }}"><button title="View {{ $model->product_name }} Information" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></button></a>
@endcan 

{{-- Edit --}}
{{-- @can('product.update')
    <button id="content_managment" data-url="{{ route('admin.products.products.edit',$model->id) }}" title="Edit {{ $model->product_name }} Information" class="btn btn-sm btn-primary"><i class="fa fa-pencil-square-o"></i></button>
@endcan  --}}

{{-- Purchase --}}
@can('product.purchase')
    <a href="{{ route('admin.product_purchase', $model->id) }}"><button title="Purchase {{ $model->product_name }}" class="btn btn-sm btn-success"><i class="fa fa-shopping-cart"></i></button></a>
@endcan 

{{-- Barcode Print --}}
{{-- @can('product.print_barcode')
    <a href="{{ route('admin.products.products.print_barcode', $model->id) }}"><button title="Print Barcode of {{ $model->product_name }}" class="btn btn-sm btn-info"><i class="fa fa-barcode"></i></button></a>
@endcan  --}}

{{-- Delete --}}
@can('product.delete')
    <button id="delete_item" data-id ="{{ $model->id }}" data-url="{{ route('admin.products.products.destroy',$model->id) }}" title="Delete {{ $model->product_name }}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
@endcan