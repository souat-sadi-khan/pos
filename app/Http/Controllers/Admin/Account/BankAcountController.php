<?php

namespace App\Http\Controllers\Admin\Account;

use App\Http\Controllers\Controller;
use App\Models\Account\BankAccount;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class BankAcountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(isset($_GET['show'])) {
            if($_GET['show'] == 'list') {
                $bank_account_sidebar = 'list';
            } elseif($_GET['show'] == 'create') {
                $bank_account_sidebar = 'create';
            } else {
                $bank_account_sidebar = 'list';
            }
        } else {
            $bank_account_sidebar = 'list';
        }

        return view('admin.account.bank-account.index', compact('bank_account_sidebar'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function datatable() {
        if (request()->ajax()) {
            $ips = BankAccount::all();

			return DataTables::of($ips)
                ->addIndexColumn()
                ->editColumn('status', function($model){
                    if($model->status == 1) {
                        return '<span class="badge badge-primary">Active</span>';
                    } else {
                        return '<span class="badge badge-warning">Inactive</span>';
                    }
                })
                ->addColumn('action', function ($model) {
					return view('admin.account.bank-account.action', compact('model'));
                })
				->rawColumns(['parent', 'products', 'date', 'status', 'image', 'view', 'sction'])->make(true);
		}
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
            'account_name'  => 'required',
            'account_no'  => 'required',
            'contact_person'  => 'required',
            'phone'  => 'required|numeric',
            'status'  => 'required',
        ]);


        $model = new BankAccount;
        $model->account_name = $request->account_name;
        $model->account_details = $request->account_details;
        $model->account_no = $request->account_no;
        $model->contact_person = $request->contact_person;
        $model->phone = $request->phone;
        $model->account_url = $request->account_url;
        $model->status = $request->status;
        $model->save();

        \SadikLog::addToLog('Created a Bank Account - ' . $request->account_name .'.');

        return response()->json(['status' => 'success', 'message' => 'New Bank Account is stored successfully']);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = BankAccount::findORFail($id);
        return view('admin.account.bank-account.show', compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = BankAccount::findORFail($id);
        return view('admin.account.bank-account.edit', compact('model'));
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
            'account_name'  => 'required',
            'account_no'  => 'required',
            'contact_person'  => 'required',
            'phone'  => 'required|numeric',
            'status'  => 'required',
        ]);

        $model = BankAccount::findOrFail($id);
        $model->account_name = $request->account_name;
        $model->account_details = $request->account_details;
        $model->account_no = $request->account_no;
        $model->contact_person = $request->contact_person;
        $model->phone = $request->phone;
        $model->account_url = $request->account_url;
        $model->status = $request->status;
        $model->save();

        \SadikLog::addToLog('Updated a Bank Account - ' . $request->account_name .'.');

        return response()->json(['status' => 'success', 'message' => 'New Bank Account is updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = BankAccount::findOrFail($id);
        $model->delete();

        \SadikLog::addToLog('Deleted a Bank Account - ' . $model->account_name .'.');

        return response()->json(['status' => 'success', 'message' => 'New Bank Account is deleted successfully']);
    }
}
