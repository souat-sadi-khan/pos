<div class="col-md-6 mx-auto text-center border mb-3 bg-light border-info">
    <b>Full View Bank Account Information for : {{ $model->account_name }}</b>
</div>

<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <tr>
            <th class="text-center">Account Name</th>
            <th class="text-center">{{ $model->account_name }}</th>
        </tr>
        <tr>
            <th class="text-center">Account Details</th>
            <th class="text-center">{{ $model->account_details }}</th>
        </tr>
        <tr>
            <th class="text-center">Account Number</th>
            <th class="text-center">{{ $model->account_no }}</th>
        </tr>
        <tr>
            <th class="text-center">Contact Person</th>
            <th class="text-center">{{ $model->contact_person }}</th>
        </tr>
        <tr>
            <th class="text-center">Phone</th>
            <th class="text-center">{{ $model->phone }}</th>
        </tr>
        <tr>
            <th class="text-center">Internet Banking URL</th>
            <th class="text-center">{{ $model->account_url }}</th>
        </tr>
        <tr>
            <th class="text-center">Status</th>
            <th class="text-center">
                @if ($model->status == 1)
                    <span class="badge badge-primary">Active</span>
                @else 
                    <span class="badge badge-warning">Inactive</span>
                @endif    
            </th>
        </tr>
    </table>
</div>
