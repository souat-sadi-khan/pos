<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.supplier.index');
    }

    public function datatable() {
        if (request()->ajax()) {
            $ips = Supplier::all();

			return DataTables::of($ips)
                ->addIndexColumn()
                ->editColumn('products', function($model){
                    return 0;
                })
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
					return view('admin.supplier.action', compact('model'));
				})
				->rawColumns(['products', 'date', 'status', 'action'])->make(true);
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
            'sup_name' => 'required',
            'code_name' => 'required',
            'sup_mobile' => 'required',
            'status' => 'required',
        ]);

        $model = new Supplier;
        $model->sup_name = $request->sup_name;
        $model->code_name = $request->code_name;
        $model->sup_mobile = $request->sup_mobile;
        $model->sup_email = $request->sup_email;
        $model->sup_address = $request->sup_address;
        $model->sup_city = $request->sup_city;
        $model->sup_state = $request->sup_state;
        $model->sup_country = $request->sup_country;
        $model->sup_details = $request->sup_details;
        $model->status = $request->status;
        $model->save();

        \SadikLog::addToLog('Created a Suppler - ' . $request->sup_name .'.');

        return response()->json(['status' => 'success', 'message' => 'New Supplier is stored successfully']);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = Supplier::findOrFail($id);
        return view('admin.supplier.show', compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = Supplier::findOrFail($id);
        return view('admin.supplier.edit', compact('model'));
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
            'sup_name' => 'required',
            'code_name' => 'required',
            'sup_mobile' => 'required',
            'status' => 'required',
        ]);

        $model = Supplier::findOrFail($id);
        $model->sup_name = $request->sup_name;
        $model->code_name = $request->code_name;
        $model->sup_mobile = $request->sup_mobile;
        $model->sup_email = $request->sup_email;
        $model->sup_address = $request->sup_address;
        $model->sup_city = $request->sup_city;
        $model->sup_state = $request->sup_state;
        $model->sup_country = $request->sup_country;
        $model->sup_details = $request->sup_details;
        $model->status = $request->status;
        $model->save();

        \SadikLog::addToLog('Created a Suppler - ' . $request->sup_name .'.');

        return response()->json(['status' => 'success', 'message' => 'New Supplier is stored successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Supplier::findOrFail($id);
        $model->delete();

        \SadikLog::addToLog('Deleted a Supplier', $model->name);

        return response()->json(['status' => 'success', 'message' => 'Supplier is deleted successfully']);
    }
}
