<div class="col-md-6 mx-auto mb-3 text-center border bg-light border-info">
    <b>Make Return for : <span class="text-info">{{ $model->invoice }}</span></b>
</div>

<form action="{{ route('admin.purchse.make_return') }}" method="POST" id="modal_form">
    @csrf
    <input type="hidden" name="purchase_id" value="{{ $model->id }}">
    <div class="row">
        {{-- Invoice Info --}}
        <div class="col-md-7">
            <div class="table-responsive mt-3">
				<table class="table table-bordered table-striped">
					<tbody>
						<tr>
							<td class="w-50 text-center">Invoice Id</td>
							<td class="w-50 bg-gray text-center ng-binding">{{ $model->invoice }}</td>
						</tr>
					</tbody>
                </table>
                
                <div class="text-center">
                    <h6>Invoice Summary</h6>
                </div>

                <table class="table table-bordered table-striped">
                    <tr class="table-info">
                        <th>ID</th>
                        <th>P. Name</th>
                        <th>Quantity</th>
                        <th>N. Total</th>
                    </tr>

                    @foreach ($items as $item)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $item->product->product_name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ $item->net_total }}</td>
                        </tr>
                    @endforeach

                    @if ($model->purchase_subtotal != 0)
                        <tr class="table-secondary">
                            <td colspan="2" class="text-right">Subtotal</td>
                            <td class="text-right" colspan="2">{{ get_option('currency_symbol') }}{{ $model->purchase_subtotal }}</td>
                        </tr>
                    @endif
                        
                    @if ($model->purchase_order_tax != 0)
                        <tr class="table-secondary">
                            <td colspan="2" class="text-right">Order Tax (%)</td>
                            <td class="text-right" colspan="2">{{ get_option('currency_symbol') }}{{ $model->purchase_order_tax }}</td>
                        </tr>
                    @endif
                        
                    @if ($model->purchase_shiping_charge != 0)
                        <tr class="table-secondary">
                            <td colspan="2" class="text-right">Shiping Charge</td>
                            <td class="text-right" colspan="2">{{ get_option('currency_symbol') }}{{ $model->purchase_shiping_charge }}</td>
                        </tr>
                    @endif
                        
                    @if ($model->purchase_other_charge != 0)
                        <tr class="table-secondary">
                            <td colspan="2" class="text-right">Other Charge</td>
                            <td class="text-right" colspan="2">{{ get_option('currency_symbol') }}{{ $model->purchase_other_charge }}</td>
                        </tr>
                    @endif
                        
                    @if ($model->purchase_discount != 0)
                        <tr class="table-secondary">
                            <td colspan="2" class="text-right">Discount</td>
                            <td class="text-right" colspan="2">{{ get_option('currency_symbol') }}{{ $model->purchase_discount }}</td>
                        </tr>
                    @endif
                        
                    @if ($model->purchase_payable_amount != 0)
                        <tr class="table-info">
                            <td colspan="2" class="text-right">Payable Amount</td>
                            <td class="text-right" colspan="2">{{ get_option('currency_symbol') }}{{ $model->purchase_payable_amount }}</td>
                        </tr>
                    @endif
                        
                    @php
                        $purchase_payments = App\Models\Purchase\PurchasePayment::where('purchase_id', $model->id)->get();
                    @endphp

                    @if (count($purchase_payments) > 0)

                        @foreach ($purchase_payments as $payment)
                            <tr class="table-success">
                                <td colspan="2" class="text-right" style="font-size:15px;">Paid by {{$model->payment_method->method_name}} on {{ formatDate($model->date) }} by {{ $model->creator->name }}	</td>
                                <td class="text-right" colspan="2">{{ get_option('currency_symbol') }}
                                    <span id="refresh_due">{{ $payment->payment_amount }}</span>
                                </td>
                            </tr>
                        @endforeach
                        
                    @else 
                        <tr class="table-danger">
                            <td colspan="2" class="text-right">Paid Amount</td>
                            <td class="text-right" colspan="2">{{ get_option('currency_symbol') }}
                                <span id="refresh_due">{{ $model->purchase_paid_amount }}</span>
                            </td>
                        </tr>
                    @endif
                        
                    @if ($model->purchase_due_amount != 0)
                        <tr class="table-danger">
                            <td colspan="2" class="text-right">Due Amount</td>
                            <td class="text-right" colspan="2">{{ get_option('currency_symbol') }}
                                <span id="refresh_due">{{ $model->purchase_due_amount }}</span>
                            </td>
                        </tr>
                    @endif
                </table>
			</div>
        </div>
        <div class="col-md-5">
            <div class="text-center">
                <h6>Return Item</h6>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr class="table-info">
                            <th class="text-center">Check</th>
                            <th class="">P. Name</th>
                            <th class="text-center">Return Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                            @php
                            $total_qty = 0;
                                if($item->product_variation_id != null) {
                                    $query = App\Models\Purchase\PurchaseReturnDetail::where('purchase_return_id', $model->id)->where('product_variation_id', $item->id)->orderBy('id', 'desc')->first();
                                    if($query) {
                                        $sell_qty = $item->quantity;
                                        $return_qty = $query->quantity;
                                        $total_qty = $sell_qty - $return_qty;
                                    } else {
                                        $total_qty = $item->quantity;
                                    }
                                } else {
                                    $query = App\Models\Purchase\PurchaseReturnDetail::where('purchase_return_id', $model->id)->orderBy('id', 'desc')->first();
                                    $total_qty = 0;
                                }
                                
                            @endphp
                            <tr>
                                <td class="text-center table-secondary">
                                    <input type="checkbox" name="item[]" value="{{ $item->id }}" style="width:20px;height:20px;">
                                </td>
                                <td class="w-70">{{ $item->product->product_name }}</td>
                                <td class="text-center">
                                    <input class="text-center" type="number" autocomplete="off" required name="qty[]" value="{{ $total_qty }}">
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="3">
                                <input required type="text" name="date" class="form-control take_date" placeholder="Enter A Date">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <textarea class="form-control no-resize" name="note" placeholder="Type Note"></textarea>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <button type="submit" id="edit_submit" class="btn btn-primary float-right px-5"><i class="fa fa-floppy-o mr-3" aria-hidden="true"></i>Save</button>
    <button type="button" id="edit_submiting" class="btn btn-info float-right" id="submiting" style="display: none;"><i class="fa fa-spinner fa-spin fa-fw"></i>Loading...</button>
    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>

</form>