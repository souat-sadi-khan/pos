<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\SadikLog;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.customer.index');
    }

    public function datatable() {
        if (request()->ajax()) {
            $ips = Customer::where('id', '!=', 1)->get();

			return Datatables::of($ips)
                ->addIndexColumn()
                ->editColumn('credit_balance', function($model){
                    return (get_option('currency_symbol') && get_option('currency_symbol') != '' ? get_option('currency_symbol') : '') . ' '. $model->credit_balance;
                })
                ->editColumn('action', function ($model) {
					return view('admin.customer.action', compact('model'));
                })
				->rawColumns(['action', 'credit_balance'])->make(true);
		}
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required',
            'credit_balance' => 'required',
            'status' => 'required',
            'customer_mobile' => 'required',
        ]);

        $model = new Customer;
        $model->uuid = Str::uuid();
        $model->customer_name = $request->customer_name;
        $model->credit_balance = $request->credit_balance;
        $model->customer_mobile = $request->customer_mobile;
        $model->date_of_birth = $request->date_of_birth;
        $model->customer_email = $request->customer_email;
        $model->customer_sex = $request->customer_sex;
        $model->customer_age = $request->customer_age;
        $model->gtin = $request->gtin;
        $model->customer_city = $request->customer_city;
        $model->customer_state = $request->customer_state;
        $model->customer_country = $request->customer_country;
        $model->status = $request->status;
        $model->save();

        \SadikLog::addToLog('Created a Customer - ' . $request->customer_name .'.');

        return response()->json(['status' => 'success', 'message' => 'New Customer is stored successfully']);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = Customer::findOrFail($id);
        return view('admin.customer.show', compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = Customer::findOrFail($id);
        return view('admin.customer.edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'customer_name' => 'required',
            'credit_balance' => 'required',
            'status' => 'required',
            'customer_mobile' => 'required',
        ]);

        $model = Customer::findOrFail($id);
        $model->customer_name = $request->customer_name;
        $model->credit_balance = $request->credit_balance;
        $model->customer_mobile = $request->customer_mobile;
        $model->date_of_birth = $request->date_of_birth;
        $model->customer_email = $request->customer_email;
        $model->customer_sex = $request->customer_sex;
        $model->customer_age = $request->customer_age;
        $model->gtin = $request->gtin;
        $model->customer_city = $request->customer_city;
        $model->customer_state = $request->customer_state;
        $model->customer_country = $request->customer_country;
        $model->status = $request->status;
        $model->save();

        \SadikLog::addToLog('Updated a Customer - ' . $request->customer_name .'.');

        return response()->json(['status' => 'success', 'message' => ' Customer is updated successfully']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Customer::findOrFail($id);
        $model->delete();

        \SadikLog::addToLog('Deleted a Customer - '. $model->customer_name);

        return response()->json(['status' => 'success', 'message' => 'Customer is deleted successfully']);
    }
}
