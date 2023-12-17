<?php

namespace App\Http\Controllers\Admin\Expense;

use App\Http\Controllers\Controller;
use App\Models\Expense\ExpenseCategory;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ExpenseCategoryController extends Controller
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
                $expense_category = 'list';
            } elseif($_GET['show'] == 'create') {
                $expense_category = 'create';
            } else {
                $expense_category = 'list';
            }
        } else {
            $expense_category = 'list';
        }
        return view('admin.expense.category.index', compact('expense_category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function datatable() {
        if (request()->ajax()) {
            $ips = ExpenseCategory::all();

			return DataTables::of($ips)
                ->addIndexColumn()
                ->editColumn('total', function($model){
                    return 0;
                })
                ->editColumn('date', function($model){
                    return formatDate($model->created_at);
                })
                ->editColumn('parent', function($model){
                    $parent_id = $model->parent;
                    if($parent_id == '0') {
                        return 'Parent';
                    } else {
                        $cat = ExpenseCategory::findOrFail($parent_id);
                        if($cat) {
                            return $cat->name;
                        }
                    }
                })
                ->editColumn('status', function($model){
                    if($model->status == 1) {
                        return '<span class="badge badge-primary">Active</span>';
                    } else {
                        return '<span class="badge badge-warning">Inactive</span>';
                    }
                })
                ->addColumn('action', function ($model) {
					return view('admin.expense.category.action', compact('model'));
                })
				->rawColumns(['parent', 'total', 'date', 'status', 'sction'])->make(true);
		}
    }

    public function slug($old_slug, $row = Null)
    {
        if(!$row){
            $slug = $old_slug;
            $row = 0;
        }else{
            $slug = $old_slug . '-'.$row;
        }

        $check_res = ExpenseCategory::where('slug', $slug)->first();
        if($check_res) {
            $slug = $this->slug($old_slug, $row+1);
        }

        return $slug;
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
            'name' => 'required',
            'parent' => 'required',
            'status' => 'required',
        ]);

        $slug = $this->slug(make_slug($request->name));

        $model = new ExpenseCategory;
        $model->name = $request->name;
        $model->slug = $slug;
        $model->parent = $request->parent;
        $model->status = $request->status;
        $model->details - $request->details;
        $model->save();

        \SadikLog::addToLog('Created a Expense Category - ' . $request->name .'.');

        return response()->json(['status' => 'success', 'load' => true, 'message' => 'New Expense Category is stored successfully']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = ExpenseCategory::findOrFail($id);
        return view('admin.expense.category.edit', compact('model'));
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
            'name' => 'required',
            'parent' => 'required',
            'status' => 'required',
        ]);

        $slug = $this->slug(make_slug($request->name));

        $model = ExpenseCategory::findOrFail($id);
        $model->name = $request->name;
        $model->slug = $slug;
        $model->parent = $request->parent;
        $model->status = $request->status;
        $model->details - $request->details;
        $model->save();

        \SadikLog::addToLog('Updated a Expense Category - ' . $request->name .'.');

        return response()->json(['status' => 'success', 'message' => 'Expense Category is updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = ExpenseCategory::findOrFail($id);
        $model->delete();
        \SadikLog::addToLog('Deleted a Expense Category - ' . $model->name .'.');

        return response()->json(['status' => 'success', 'message' => 'Expense Category is deleted successfully']);
    }
}
