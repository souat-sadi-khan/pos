<div class="col-md-6 mx-auto text-center border bg-light border-info">
    <b>Full View Expense Information for : {{ $model->ref_no }}</b>
</div>

<div class="table-responsive">
    <table class="table table-bordered table-condensed">
        <tbody>
            <tr>
                <td class="w-30">
                    Ref. No.						
                </td>
                <td class="w-70">
                   {{ $model->ref_no }}				
                </td>
            </tr>
            <tr>
                <td class="w-30">
                    Created At						
                </td>
                <td class="w-70">
                    {{ formatDate($model->created_at) }}				
                </td>
            </tr>
            <tr>
                <td class="w-30">
                    What For						
                </td>
                <td class="w-70">
                    {{ $model->what_for }}
                </td>
            </tr>
            <tr>
                <td class="w-30">
                    Notes						
                </td>
                <td class="w-70">
                    {{ $model->notes }}                            
                </td>
            </tr>
            <tr>
                <td class="w-30">
                    Amount						
                </td>
                <td class="w-70">
                    {{ get_option('currency_symbol') }}	{{ number_format($model->amount, 2)}}				
                </td>
            </tr>
            {{-- <tr>
                <td class="w-30">
                    Attachment						</td>
                <td class="w-70">
                                            </td>
            </tr> --}}
        </tbody>
    </table>
    </div>