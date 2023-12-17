@extends('layouts.main', ['title' => ('Expense Summary'), 'modal' => 'xl',])

@push('admin.css')

@endpush

@section('header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Expense Summary</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/home') }}"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                    <li class="breadcrumb-item active">Expense Summary</li>
                </ol>
            </div>
        </div>
    </div>
</section>
@endsection

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="row">
                {{-- today Summary --}}
                <div class="col-md-6">
                    <h4 class="text-center bg-light">
                        Summary Today
                    </h4>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" style="font-size: 15px;">
                            <thead>
                                <th>Category Name</th>
                                <th class="text-right">Amount</th>
                            </thead>
                            <tbody>
                                @php
                                    $today_total = 0;
                                    $total_category = App\Models\Expense\ExpenseCategory::all();
                                    $category_total = 0;

                                @endphp
                                @if (count($total_category) > 0)
                                    @foreach ($total_category as $item)
                                        @php
                                            $today_query_sum = App\Models\Expense\Expense::where('category_id', $item->id)->whereDate('created_at', Carbon\Carbon::today())->sum('amount');
                                            $today_total = $today_total + $today_query_sum;
                                        @endphp
                                        <tr>
                                            <td>{{ $item->name }}</td>
                                            <td class="text-right">{{ get_option('currency_symbol') }} {{ number_format($today_query_sum, 2) }}</td>
                                        </tr>
                                    @endforeach
                                @else 
                                    <p class="text-center">No Data Found</p>
                                @endif
                            </tbody>
                            <tfoot class="table-secondary">
                                <td class="text-right">Grand Total</td>
                                <td class="text-right">{{ get_option('currency_symbol') }} {{ number_format($today_total, 2) }}</td>
                            </tfoot>
                        </table>
                    </div>
                </div>
    
                {{-- Summary This Week --}}
                <div class="col-md-6">
                    <h4 class="text-center bg-light">
                        Summary This Week
                    </h4>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" style="font-size: 15px;">
                            <thead>
                                <th>Category Name</th>
                                <th class="text-right">Amount</th>
                            </thead>
                            <tbody>
                                @php
                                    $week_total = 0;
                                    $total_category = App\Models\Expense\ExpenseCategory::all();
                                    $category_total_for_week = 0;
                                @endphp
                                @if (count($total_category) > 0)
                                    @foreach ($total_category as $item)
                                        @php
                                            $week_query = App\Models\Expense\Expense::where('category_id', $item->id)->where('created_at', '>', Carbon\Carbon::now()->startOfWeek())->where('created_at', '<', Carbon\Carbon::now()->endOfWeek())->sum('amount');;
                                            $category_total_for_week = $category_total_for_week + $week_query;
                                        @endphp
                                        <tr>
                                            <td>{{ $item->name }}</td>
                                            <td class="text-right">{{ get_option('currency_symbol') }} {{ number_format($week_query, 2) }}</td>
                                        </tr>
                                    @endforeach
                                @else 
                                    <p class="text-center">No Data Found</p>
                                @endif
                            </tbody>
                            <tfoot class="table-secondary">
                                <td class="text-right">Grand Total</td>
                                <td class="text-right">{{ get_option('currency_symbol') }} {{ number_format($category_total_for_week, 2) }}</td>
                            </tfoot>
                        </table>
                    </div>
                </div>
    
                {{-- this month Summary --}}
                <div class="col-md-6">
                    <h4 class="text-center bg-light">
                        Summary This Month
                    </h4>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" style="font-size: 15px;">
                            <thead>
                                <th>Category Name</th>
                                <th class="text-right">Amount</th>
                            </thead>
                            <tbody>
                                @php
                                    $month_total = 0;
                                    $total_category = App\Models\Expense\ExpenseCategory::all();
                                    $category_total_for_month = 0;
                                @endphp
                                @if (count($total_category) > 0)
                                    @foreach ($total_category as $item)
                                        @php
                                            $month_query = App\Models\Expense\Expense::where('category_id', $item->id)->whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->sum('amount');;
                                            $category_total_for_month = $category_total_for_month + $month_query;
                                        @endphp
                                        <tr>
                                            <td>{{ $item->name }}</td>
                                            <td class="text-right">{{ get_option('currency_symbol') }} {{ number_format($month_query, 2) }}</td>
                                        </tr>
                                    @endforeach
                                @else 
                                    <p class="text-center">No Data Found</p>
                                @endif
                                
                            </tbody>
                            <tfoot class="table-secondary">
                                <td class="text-right">Grand Total</td>
                                <td class="text-right">{{ get_option('currency_symbol') }} {{ number_format($category_total_for_month, 2) }}</td>
                            </tfoot>
                        </table>
                    </div>
                </div>
    
                {{-- Summary This Year --}}
                <div class="col-md-6">
                    <h4 class="text-center bg-light">
                        Summary This Year
                    </h4>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" style="font-size: 15px;">
                            <thead>
                                <th>Category Name</th>
                                <th class="text-right">Amount</th>
                            </thead>
                            <tbody>
                                @php
                                    $year_total = 0;
                                    $total_category = App\Models\Expense\ExpenseCategory::all();
                                    $category_total_for_year = 0;
                                @endphp
                                @if (count($total_category) > 0)
                                    @foreach ($total_category as $item)
                                        @php
                                            $year_query = App\Models\Expense\Expense::where('category_id', $item->id)->whereYear('created_at', date('Y'))->sum('amount');
                                            $category_total_for_year = $category_total_for_year + $year_query;
                                        @endphp
                                        <tr>
                                            <td>{{ $item->name }}</td>
                                            <td class="text-right">{{ get_option('currency_symbol') }} {{ number_format($year_query, 2) }}</td>
                                        </tr>
                                    @endforeach
                                @else 
                                    <p class="text-center">No Data Found</p>
                                @endif
                            </tbody>
                            <tfoot class="table-secondary">
                                <td class="text-right">Grand Total</td>
                                <td class="text-right">{{ get_option('currency_symbol') }} {{ number_format($category_total_for_year, 2) }}</td>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>

@endsection

@push('admin.scripts')

@endpush
