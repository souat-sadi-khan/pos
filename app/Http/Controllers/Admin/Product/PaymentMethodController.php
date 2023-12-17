<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.payment-method.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function datatable() {
        if (request()->ajax()) {
            $ips = PaymentMethod::all();

			return DataTables::of($ips)
                ->addIndexColumn()
                ->editColumn('date', function($model){
                    return formatDate($model->created_at);
                })
                ->editColumn('status', function($model){
                    if($model->status == 1) {
                        return '<span class="badge badge-primary">Active</span>';
                    } else {
                        return '<span class="badge badge-warning">Inactive</span>';
                    }
                })
                ->addColumn('action', function ($model) {
                    return view('admin.payment-method.action', compact('model'));
                })
				->rawColumns(['date', 'status', 'action'])->make(true);
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
            'method_name' => 'required|max:25',
            'method_code_name' => 'required|max:25',
            'status' => 'required',
            'method_has_txr_id'  => 'required',
            'method_has_mob_no'  => 'required',
        ]);

        $model = new PaymentMethod;
        $model->method_name = $request->method_name;
        $model->method_code_name = $request->method_code_name;
        $model->method_details = $request->method_details;
        $model->status = $request->status;
        $model->method_has_txr_id = $request->method_has_txr_id;
        $model->method_has_mob_no = $request->method_has_mob_no;
        $model->save();

        \SadikLog::addToLog('Created a Payment Method - ' . $request->method_name .'.');

        return response()->json(['status' => 'success', 'message' => 'New Payment Method is stored successfully']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = PaymentMethod::findOrFail($id);
        return view('admin.payment-method.edit', compact('model'));
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
            'method_name' => 'required|max:25',
            'method_code_name' => 'required|max:25',
            'status' => 'required',
            'method_has_txr_id'  => 'required',
            'method_has_mob_no'  => 'required',
        ]);

        $model = PaymentMethod::findOrFail($id);
        $model->method_name = $request->method_name;
        $model->method_code_name = $request->method_code_name;
        $model->method_details = $request->method_details;
        $model->status = $request->status;
        $model->method_has_txr_id = $request->method_has_txr_id;
        $model->method_has_mob_no = $request->method_has_mob_no;
        $model->save();

        \SadikLog::addToLog('Updated a Payment Method - ' . $request->method_name .'.');

        return response()->json(['status' => 'success', 'message' => 'Payment Method is updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = PaymentMethod::findOrFail($id);
        $model->delete();

        \SadikLog::addToLog('Deleted a Payment Method - ' . $model->method_name .'.');

        return response()->json(['status' => 'success', 'message' => 'Payment Method is deleted successfully']);
    }

    // check_payment_method
    public function check_payment_method(Request $request) {
        $id = $request->val;
        $model = PaymentMethod::findOrFail($id);
        $html ='';
        if($model->method_has_txr_id == 1 ) {
            $html .= '<tr class="table-secondary">
                <td class="text-right" width="30%"><b><label for="method_has_txr_id">'.$model->method_name.' Txr ID</label></b></td>
                <td width="70%"><input type="text" name="method_has_txr_id" id="method_has_txr_id" class="form-control" placeholder="Enter Transection ID" required></td>
            </tr>';
        } 
        if($model->method_has_mob_no == 1 ) {
            $html .= '<tr class="table-secondary">
                <td class="text-right" width="30%"><b><label for="method_has_mob_no">'.$model->method_name.' Mobile No</label></b></td>
                <td width="70%"><input type="text" name="method_has_mob_no" id="method_has_mob_no" class="form-control" placeholder="Enter Mobile Number" required></td>
            </tr>';
        } 

        return $html;
    }
}
