<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Models\Products\Color;
use App\ProductVariation;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.product.color.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function datatable() {
        if (request()->ajax()) {
            $ips = Color::all();

			return DataTables::of($ips)
                ->addIndexColumn()
                ->editColumn('products', function($model){
                    return $count = ProductVariation::where('color_id', $model->id)->count();
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
                    return view('admin.product.color.action', compact('model'));
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
            'color_name' => 'required|max:25',
            'status' => 'required',
        ]);

        $model = new Color;
        $model->color_name = $request->color_name;
        $model->status = $request->status;
        $model->color_details = $request->color_details;
        $model->save();

        \SadikLog::addToLog('Created a Color - ' . $request->color_name .'.');

        return response()->json(['status' => 'success', 'message' => 'New Color is stored successfully']);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = Color::findOrFail($id);
        return view('admin.product.color.edit', compact('model'));
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
            'color_name' => 'required|max:25',
            'status' => 'required',
        ]);

        $model = Color::findOrFail($id);
        $model->color_name = $request->color_name;
        $model->status = $request->status;
        $model->color_details = $request->color_details;
        $model->save();

        \SadikLog::addToLog('Updated a Color - ' . $request->color_name .'.');

        return response()->json(['status' => 'success', 'message' => 'Color is updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Color::findOrFail($id);
        $model->delete();

        \SadikLog::addToLog('Deleted a Color - ' . $model->color_name .'.');

        return response()->json(['status' => 'success', 'message' => 'Color is deleted successfully']);
    }
}
