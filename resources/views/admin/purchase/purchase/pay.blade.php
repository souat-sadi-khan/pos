<div class="col-md-6 mx-auto mb-3 text-center border bg-light border-info">
    <b>Make Payment for : <span class="text-info">{{ $model->invoice }}</span></b>
</div>

<form action="{{ route('admin.purchase.pay_due_bill') }}" method="POST" id="modal_form">
    <div class="row">
        {{-- Paymemnt Method Section --}}
        <div class="col-md-2" style="font-size: 12px;">
            <b>Select Payment Method</b>
            @php
                $methods = App\Models\PaymentMethod::where('status', 1)->get();
                $first_method = App\Models\PaymentMethod::where('id', 1)->first();
            @endphp
            <input type="hidden" name="purchase_id" value="{{ $model->id }}">
            <input type="hidden" id="method_name" value="{{ $first_method->method_name }}">
            <input type="hidden" name="purchase_payment_method_id" id="method_id" value="{{ $first_method->id }}">
            @foreach ($methods as $method)
                <a class="text-left list-group-item pmethod_item" id="pmethod_{{$method->id}}" data-id="{{ $method->id }}" data-name="{{ $method->method_name }}" href="javascript:void(0)"><span class="fa fa-fw fa-angle-double-right"></span>{{ $method->method_name }}</a>
            @endforeach
        </div>
    
        {{-- Payment Section --}}
        <div class="col-md-5">
            <div class="text-center">
                Payment Method Option : <span class="text-info" id="payment_method_option"></span>
                <button class="btn btn-large btn-block btn-success my-2">Full Payment</button>
            </div>
    
            <div class="row">
                <div class="col-md-12">
                    <input type="number" required class="form-control" id="paid_amount" name="payment_amount" placeholder="Enter Payment Amount"> <br>
                </div>
                <div class="col-md-12">
                    <textarea name="note" id="note" cols="30" rows="2" class="form-control" placeholder="Enter Note"></textarea>
                </div>
            </div>
    
            <div id="payment_area"></div>
    
        </div>
    
        {{-- Payment Invoice Section --}}
        <div class="col-md-5">
            <div class="bg-light">
                Invoice ID : <span class="float-right">{{ $model->invoice }}</span>
            </div>
    
            <div class="text-center mt-3">
                Billing Details
            </div>
    
            <div class="table-responsive">
                <table class="table table-bordered table-striped" style="font-size: 14px;">
                    <thead>
                        <tr class="table-info">
                            <th>ID</th>
                            <th>P. Name</th>
                            <th>Quantity</th>
                            <th>Net Total</th>
                        </tr>
                    </thead>
                    @php
                        $purchase_details = App\Models\Purchase\PurchaseDetails::where('purchase_id', $model->id)->get();
                    @endphp
                    @foreach ($purchase_details as $item)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $item->product->product_name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ $item->net_total }}</td>
                        </tr>
                    @endforeach
                    <tfoot>
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
                            
                        @if ($model->purchase_paid_amount != 0)
                            <tr class="table-success">
                                <td colspan="2" class="text-right">Paid Amount</td>
                                <td class="text-right" colspan="2">{{ get_option('currency_symbol') }}
                                    <span id="refresh_paid">{{ $model->purchase_paid_amount }}</span>
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
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <button type="submit" id="edit_submit" class="btn btn-primary float-right px-5"><i class="fa fa-floppy-o mr-3" aria-hidden="true"></i>Save</button>
    <button type="button" id="edit_submiting" class="btn btn-info float-right" id="submiting" style="display: none;"><i class="fa fa-spinner fa-spin fa-fw"></i>Loading...</button>
    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>

</form>

<script>
    $(function(){
        var val = $('#method_id').val();
        var name = $('#method_name').val();
        $('#pmethod_'+val).addClass('active');
        $('#payment_method_option').html(name);
        $.ajax({
            url: '/admin/check-payment-method',
            type: 'GET',
            dataType: 'html',
            data: {
                val:val
            },
            success: function(data) {
                $('#payment_area').html(data);
            }
        });
    });
    $(document).on('click', '.pmethod_item', function() {
        var val = $(this).data('id');
        var name = $(this).data('name');
        $('.pmethod_item').removeClass('active');
        $('#pmethod_'+val).addClass('active');
        $('#payment_method_option').html(name);
        $.ajax({
            url: '/admin/check-payment-method',
            type: 'GET',
            dataType: 'html',
            data: {
                val:val
            },
            success: function(data) {
                $('#payment_area').html(data);
            }
        });
    });

    var total_amount = '{{ $model->purchase_payable_amount }}';
    var old_pay = '{{ $model->purchase_paid_amount}}'
    $('#paid_amount').keyup(function() {
        var paid = $('#paid_amount').val();
        var total_paid = parseInt(paid) + parseInt(old_pay);
        var due = parseInt(total_amount) - parseInt(total_paid);
        $('#refresh_paid').html(total_paid);
        $('#refresh_due').html(due);
    });
</script>