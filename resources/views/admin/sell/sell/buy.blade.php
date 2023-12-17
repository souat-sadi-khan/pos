<div class="col-md-6 mx-auto mb-3 text-center border bg-light border-info">
    <b>Pay to sell</b>
</div>

<form action="" method="POST" id="modal_form">
    <div class="row">
        {{-- Paymemnt Method Section --}}
        <div class="col-md-2" style="font-size: 12px;">
            <b>Select Payment Method</b>
            @php
                $methods = App\Models\PaymentMethod::where('status', 1)->get();
                $first_method = App\Models\PaymentMethod::where('id', 1)->first();
            @endphp
            <input type="hidden" id="method_name" value="{{ $first_method->method_name }}">
            <input type="hidden" name="payment_method_id" id="method_id" value="{{ $first_method->id }}">
            @foreach ($methods as $method)
                <a class="text-left list-group-item pmethod_item" id="pmethod_{{$method->id}}" data-id="{{ $method->id }}" data-name="{{ $method->method_name }}" href="javascript:void(0)"><span class="fa fa-fw fa-angle-double-right"></span>{{ $method->method_name }}</a>
            @endforeach
        </div>
    
        {{-- Payment Section --}}
        <div class="col-md-5">
            <div class="text-center">
                Payment Method Option : <span class="text-info" id="payment_method_option"></span>
                <div class="row">
                    <div class="col-md-6">
                        <button type="button" id="full_paid" data-url="{{ route('admin.full-paid-from-pos') }}" class="btn btn-large btn-block btn-success my-2"><i class="fa fa-plus fa-1x mr-2"></i>Full Paid</button>
                    </div>
                    <div class="col-md-6">
                        <button type="button" id="full_due" data-url="{{ route('admin.full-due-from-pos') }}" class="btn btn-large btn-block btn-danger my-2"><i class="fa fa-minus fa-1x mr-2"></i>Full Due</button>
                    </div>
                </div>
            </div>
    
            <div class="row">
                <div class="col-md-12">
                    <input type="number" required class="form-control" id="reference_no" name="reference_no" placeholder="Enter Reference Number" required> <br>
                </div>
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
                        $index = 1;
                        $subtotal = 0;
                    @endphp
                    @for ($i = 0; $i < count($product_ids); $i++)
                        @php
                            $product_id = $product_ids[$i];
                            $qty = $qtys[$i];
                            $product_variations_id = $product_variations_ids[$i];
                            $sell_price = $sell_prices[$i];
                            $total_price = $total_prices[$i];
                            $subtotal = $subtotal + $sell_price;
                        @endphp

                        <tr>
                            <td>{{ $index }}</td>
                            <td>
                                @php
                                    $product = App\Models\Products\Product::findOrFail($product_id);
                                @endphp
                                {{ $product->product_name }} ({{ $product->product_code }}) 
                            </td>
                            <td>
                                {{ $qty }}
                            </td>
                            <td class="text-right">
                                {{ get_option('currency_symbol') }} {{ number_format($total_price, 2) }}
                            </td>
                        </tr>

                        @php
                            $index ++;
                        @endphp
                    @endfor
                    
                    
                    <tfoot>
                        <tr class="table-secondary">
                            <td colspan="2" class="text-right">Subtotal</td>
                            <td class="text-right" colspan="2">{{ get_option('currency_symbol') }}{{ number_format($subtotal, 2) }}</td>
                        </tr>
                            
                        <tr class="table-secondary">
                            <td colspan="2" class="text-right">Order Tax (%)</td>
                            <td class="text-right" colspan="2">{{ number_format($order_tax, 2) }}%</td>
                        </tr>
                            
                        <tr class="table-secondary">
                            <td colspan="2" class="text-right">Shiping Charge</td>
                            <td class="text-right" colspan="2">{{ get_option('currency_symbol') }}{{ number_format($shiping_charge, 2) }}</td>
                        </tr>
                            
                        <tr class="table-secondary">
                            <td colspan="2" class="text-right">Other Charge</td>
                            <td class="text-right" colspan="2">{{ get_option('currency_symbol') }}{{ number_format($other_charge, 2) }}</td>
                        </tr>
                            
                        <tr class="table-secondary">
                            <td colspan="2" class="text-right">Discount</td>
                            <td class="text-right" colspan="2">{{ get_option('currency_symbol') }}{{ number_format($discount, 2) }}</td>
                        </tr>
                            
                        <tr class="table-info">
                            <td colspan="2" class="text-right">Payable Amount</td>
                            <td class="text-right" colspan="2">{{ get_option('currency_symbol') }}{{ number_format($total) }}</td>
                        </tr>
                            
                        <tr class="table-success">
                            <td colspan="2" class="text-right">Paid Amount</td>
                            <td class="text-right" colspan="2">{{ get_option('currency_symbol') }}
                                <span id="refresh_paid">0.00</span>
                            </td>
                        </tr>
                            
                        <tr class="table-danger">
                            <td colspan="2" class="text-right">Due Amount</td>
                            <td class="text-right" colspan="2">{{ get_option('currency_symbol') }}
                                <span id="refresh_due">0.00</span>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <button type="button" data-url="{{ route('admin.pay-now') }}" id="edit_submit" class="btn btn-primary float-right px-5"><i class="fa fa-floppy-o mr-3" aria-hidden="true"></i>Save</button>
    <button type="button" id="edit_submiting" class="btn btn-info float-right" id="submiting" style="display: none;"><i class="fa fa-spinner fa-spin fa-fw"></i>Loading...</button>
    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>

</form>
@php
    $qtys = implode($qtys, ',');
    $total_prices = implode($total_prices, ',');
    $product_ids = implode($product_ids, ',');
    $sell_prices = implode($sell_prices, ',');
    $product_variations_ids = implode($product_variations_ids, ',');
@endphp
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

    $('#full_paid').click(function() {
        var reference_no = $('#reference_no').val();
        if(reference_no == '') {
            $(this).html('<i class="fa fa-plus fa-1x mr-2"></i>Full Paid');
            $(this).removeAttr('disabled');
            toastr.error('Please Enter Reference Number');
            $('#reference_no').focus();

            return false;
        }
        var method_id = $('#method_id').val();
        var customer_id = '{{$customer_id}}';
        var method_has_txr_id = $('#method_has_txr_id').val();
        var method_has_mob_no = $('#method_has_mob_no').val();
        var note = $('#note').val();
        var subtotal = '{{ $subtotal }}';
        var other_charge = '{{ $other_charge }}';
        var discount = '{{ $discount }}';
        var order_tax = '{{ $order_tax }}';
        var shiping_charge = '{{ $shiping_charge }}';
        var paid = '{{ $total }}';
        var due = 0;
        var payable = '{{ $total }}';
        qtys = '{{ $qtys }}';
        total_prices = '{{ $total_prices }}';
        product_ids = '{{ $product_ids }}';
        sell_prices = '{{ $sell_prices }}';
        product_variations_ids = '{{ $product_variations_ids }}';
        var url = $(this).data('url');
        $(this).attr('disabled', '1');
        $(this).html('Please Wait...');
        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',
            data: {
                method_id:method_id,
                customer_id:customer_id,
                method_has_txr_id:method_has_txr_id,
                method_has_mob_no:method_has_mob_no,
                note:note,
                subtotal:subtotal,
                discount:discount,
                order_tax:order_tax,
                shiping_charge:shiping_charge,
                paid:paid,
                other_charge:other_charge,
                due:due,
                payable:payable,
                qtys:qtys,
                total_prices:total_prices,
                product_ids:product_ids,
                sell_prices:sell_prices,
                product_variations_ids:product_variations_ids,
                reference_no:reference_no,
            },
            success: function (data) {
                if (data.status == 'danger') {
                    toastr.error(data.message);
                } else {
                    toastr.success(data.message);
                    $('#modal_remote').modal('toggle');

                    if (data.load) {
                        setTimeout(function () {

                            window.location.href = "";
                        }, 1000);
                    }
                }
                $('#full_paid').attr('disabled', '1');
                $('#full_paid').html('Please Wait...');
            },
            error: function (data) {
                var jsonValue = data.responseJSON;
                const errors = jsonValue.errors;
                if (errors) {
                    var i = 0;
                    $.each(errors, function (key, value) {
                        const first_item = Object.keys(errors)[i];
                        const message = errors[first_item][0];
                        if ($('#' + first_item).length > 0) {
                            $('#' + first_item).parsley().removeError('required', {
                                updateClass: true
                            });
                            $('#' + first_item).parsley().addError('required', {
                                message: value,
                                updateClass: true
                            });
                        }

                        // $('#' + first_item).after('<div class="ajax_error" style="color:red">' + value + '</div');
                        toastr.warning(value);
                        i++;
                    });
                } else {
                    toastr.error(jsonValue.message);
                }
                $('#full_paid').attr('disabled', '1');
                $('#full_paid').html('Please Wait...');
            }
        });
    });

    // Full Due Payment
    $('#full_due').click(function() {
        var reference_no = $('#reference_no').val();
        if(reference_no == '') {
            $(this).html('<i class="fa fa-minus fa-1x mr-2"></i>Full Due');
            $(this).removeAttr('disabled');
            toastr.error('Please Enter Reference Number');
            $('#reference_no').focus();

            return false;
        }
        var method_id = $('#method_id').val();
        var customer_id = '{{$customer_id}}';
        var method_has_txr_id = $('#method_has_txr_id').val();
        var method_has_mob_no = $('#method_has_mob_no').val();
        var note = $('#note').val();
        var subtotal = '{{ $subtotal }}';
        var discount = '{{ $discount }}';
        var order_tax = '{{ $order_tax }}';
        var other_charge = '{{ $other_charge }}';
        var shiping_charge = '{{ $shiping_charge }}';
        var paid = 0;
        var due = '{{ $total }}';
        var payable = '{{ $total }}';
        qtys = '{{ $qtys }}';
        total_prices = '{{ $total_prices }}';
        product_ids = '{{ $product_ids }}';
        sell_prices = '{{ $sell_prices }}';
        product_variations_ids = '{{ $product_variations_ids }}';
        var url = $(this).data('url');
        $(this).attr('disabled', '1');
        $(this).html('Please Wait...');
        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',
            data: {
                method_id:method_id,
                customer_id:customer_id,
                method_has_txr_id:method_has_txr_id,
                method_has_mob_no:method_has_mob_no,
                note:note,
                subtotal:subtotal,
                discount:discount,
                order_tax:order_tax,
                shiping_charge:shiping_charge,
                paid:paid,
                other_charge:other_charge,
                due:due,
                payable:payable,
                qtys:qtys,
                total_prices:total_prices,
                product_ids:product_ids,
                sell_prices:sell_prices,
                product_variations_ids:product_variations_ids,
                reference_no:reference_no,
            },
            success: function (data) {
                if (data.status == 'danger') {
                    toastr.error(data.message);
                } else {
                    toastr.success(data.message);
                    $('#modal_remote').modal('toggle');

                    if (data.load) {
                        setTimeout(function () {

                            window.location.href = "";
                        }, 1000);
                    }
                }
                $('#full_due').html('<i class="fa fa-minus fa-1x mr-2"></i>Full Due');
                $('#full_due').removeAttr('disabled');
            },
            error: function (data) {
                var jsonValue = data.responseJSON;
                const errors = jsonValue.errors;
                if (errors) {
                    var i = 0;
                    $.each(errors, function (key, value) {
                        const first_item = Object.keys(errors)[i];
                        const message = errors[first_item][0];
                        if ($('#' + first_item).length > 0) {
                            $('#' + first_item).parsley().removeError('required', {
                                updateClass: true
                            });
                            $('#' + first_item).parsley().addError('required', {
                                message: value,
                                updateClass: true
                            });
                        }

                        // $('#' + first_item).after('<div class="ajax_error" style="color:red">' + value + '</div');
                        toastr.warning(value);
                        i++;
                    });
                } else {
                    toastr.error(jsonValue.message);
                }
                $('#full_due').html('<i class="fa fa-minus fa-1x mr-2"></i>Full Due');
                $('#full_due').removeAttr('disabled');           
            }
        });
    });

    // paid_amount
    $('#paid_amount').keyup(function() {
        var amount = $(this).val();
        var payable = '{{ $total }}'
        var due = parseInt(payable) - parseInt(amount);
        $('#refresh_paid').html(amount);
        $('#refresh_due').html(due);
    });

    // edit_submit
    $('#edit_submit').click(function() {
        var reference_no = $('#reference_no').val();
        if(reference_no == '') {
            $(this).html('<i class="fa fa-minus fa-1x mr-2"></i>Full Due');
            $(this).removeAttr('disabled');
            toastr.error('Please Enter Reference Number');
            $('#reference_no').focus();

            return false;
        }

        var paid_amount= $('#paid_amount').val();
        if(paid_amount == '') {
            $(this).html('<i class="fa fa-minus fa-1x mr-2"></i>Full Due');
            $(this).removeAttr('disabled');
            toastr.error('Please Enter Paid Amount');
            $('#paid_amount').focus();

            return false;
        }
        var method_id = $('#method_id').val();
        var customer_id = '{{$customer_id}}';
        var method_has_txr_id = $('#method_has_txr_id').val();
        var method_has_mob_no = $('#method_has_mob_no').val();
        var note = $('#note').val();
        var subtotal = '{{ $subtotal }}';
        var discount = '{{ $discount }}';
        var order_tax = '{{ $order_tax }}';
        var other_charge = '{{ $other_charge }}';
        var shiping_charge = '{{ $shiping_charge }}';
        var paid = 0;
        var due = '{{ $total }}';
        var payable = '{{ $total }}';
        qtys = '{{ $qtys }}';
        total_prices = '{{ $total_prices }}';
        product_ids = '{{ $product_ids }}';
        sell_prices = '{{ $sell_prices }}';
        product_variations_ids = '{{ $product_variations_ids }}';
        var url = $(this).data('url');
        $(this).attr('disabled', '1');
        $(this).html('Please Wait...');
        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',
            data: {
                method_id:method_id,
                customer_id:customer_id,
                method_has_txr_id:method_has_txr_id,
                method_has_mob_no:method_has_mob_no,
                note:note,
                subtotal:subtotal,
                discount:discount,
                order_tax:order_tax,
                shiping_charge:shiping_charge,
                paid:paid,
                other_charge:other_charge,
                due:due,
                payable:payable,
                qtys:qtys,
                total_prices:total_prices,
                product_ids:product_ids,
                sell_prices:sell_prices,
                product_variations_ids:product_variations_ids,
                reference_no:reference_no,
            },
            success: function (data) {
                if (data.status == 'danger') {
                    toastr.error(data.message);
                } else {
                    toastr.success(data.message);
                    $('#modal_remote').modal('toggle');

                    if (data.load) {
                        setTimeout(function () {

                            window.location.href = "";
                        }, 1000);
                    }
                }
                $('#edit_submit').html('Submit');
                $('#edit_submit').removeAttr('disabled');
            },
            error: function (data) {
                var jsonValue = data.responseJSON;
                const errors = jsonValue.errors;
                if (errors) {
                    var i = 0;
                    $.each(errors, function (key, value) {
                        const first_item = Object.keys(errors)[i];
                        const message = errors[first_item][0];
                        if ($('#' + first_item).length > 0) {
                            $('#' + first_item).parsley().removeError('required', {
                                updateClass: true
                            });
                            $('#' + first_item).parsley().addError('required', {
                                message: value,
                                updateClass: true
                            });
                        }

                        // $('#' + first_item).after('<div class="ajax_error" style="color:red">' + value + '</div');
                        toastr.warning(value);
                        i++;
                    });
                } else {
                    toastr.error(jsonValue.message);
                }
                $('#edit_submit').removeAttr('disabled');
                $('#edit_submit').html('Submit');
            }
        });
    })
</script>