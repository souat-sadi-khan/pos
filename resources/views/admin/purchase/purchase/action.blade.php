{{-- Pay --}}
@if ($model->purchase_due_amount != 0)
    <button title="Pay {{$model->invoice}}" id="content_managment" data-url="{{ route('admin.purchase.pay',$model->id) }}" class="btn btn-success btn-sm"><i class="fa fa-money"></i></button>
@endif 

{{-- Return --}}
@can('purchase.return')
    <button title="Return {{$model->invoice}}" id="content_managment" data-url="{{ route('admin.purchase.return',$model->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-minus-circle"></i></button>
@endcan
{{-- Delete --}}
@can('product.delete')
    <button id="delete_item" data-id ="{{ $model->id }}" data-url="{{ route('admin.purchase.destroy',$model->id) }}" title="Delete {{ $model->invoice }}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
@endcan