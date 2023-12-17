<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Models\Products\Size;
use App\ProductVariation;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.product.size.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function datatable() {
        if (request()->ajax()) {
            $ips = Size::all();

			return DataTables::of($ips)
                ->addIndexColumn()
                ->editColumn('products', function($model){
                    return $count = ProductVariation::where('size_id', $model->id)->count();
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
                    return view('admin.product.size.action', compact('model'));
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
            'size_name' => 'required|max:25',
            'status' => 'required',
        ]);

        $model = new Size;
        $model->size_name = $request->size_name;
        $model->status = $request->status;
        $model->size_details = $request->size_details;
        $model->save();

        \SadikLog::addToLog('Created a Size - ' . $request->size_name .'.');

        return response()->json(['status' => 'success', 'message' => 'New Size is stored successfully']);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = Size::findOrFail($id);
        return view('admin.product.size.edit', compact('model'));
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
            'size_name' => 'required|max:25',
            'status' => 'required',
        ]);

        $model = Size::findOrFail($id);
        $model->size_name = $request->size_name;
        $model->status = $request->status;
        $model->size_details = $request->size_details;
        $model->save();

        \SadikLog::addToLog('Updated a Size - ' . $request->size_name .'.');

        return response()->json(['status' => 'success', 'message' => 'Size is updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Size::findOrFail($id);
        $model->delete();

        \SadikLog::addToLog('Deleted a Size - ' . $model->size_name .'.');

        return response()->json(['status' => 'success', 'message' => 'Size is deleted successfully']);
    }
}
