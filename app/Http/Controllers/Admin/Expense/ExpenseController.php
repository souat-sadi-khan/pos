<?php

namespace App\Http\Controllers\Admin\Expense;

use App\Http\Controllers\Controller;
use App\Models\Expense\Expense;
use App\Models\Expense\ExpenseCategory;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ExpenseController extends Controller
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
                $expense = 'list';
            } elseif($_GET['show'] == 'create') {
                $expense = 'create';
            } else {
                $expense = 'list';
            }
        } else {
            $expense = 'list';
        }
        return view('admin.expense.expense.index', compact('expense'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function datatable() {
        if (request()->ajax()) {
            $ips = Expense::all();

			return DataTables::of($ips)
                ->addIndexColumn()
                ->editColumn('amount', function($model){
                    return get_option('currency_symbol'). ' '. $model->amount;
                })
                ->editColumn('date', function($model){
                    return formatDate($model->created_at);
                })
                ->editColumn('cat_id', function($model){
                    return $model->category->name;
                })
                ->addColumn('action', function ($model) {
					return view('admin.expense.expense.action', compact('model'));
                })
				->rawColumns(['amount', 'cat_id', 'date', 'action'])->make(true);
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
            'ref_no' => 'required|unique:expenses',
            'category_id' => 'required',
            'amount' => 'required|numeric',
            'returnable' => 'required',
        ]);

        $model = new Expense;
        $model->ref_no = $request->ref_no;
        $model->category_id = $request->category_id;
        $model->what_for = $request->what_for;
        $model->amount = $request->amount;
        $model->returnable = $request->returnable;
        $model->note = $request->note;
        $model->save();

        \SadikLog::addToLog('Created a Expense - ' . $request->what_for .'.');

        return response()->json(['status' => 'success', 'message' => 'New Expense is stored successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = Expense::findOrFail($id);
        return view('admin.expense.expense.show', compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = Expense::findOrFail($id);
        return view('admin.expense.expense.edit', compact('model'));
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
            'ref_no' => 'required',
            'category_id' => 'required',
            'amount' => 'required|numeric',
            'returnable' => 'required',
        ]);

        $model = Expense::findOrFail($id);
        $model->ref_no = $request->ref_no;
        $model->category_id = $request->category_id;
        $model->what_for = $request->what_for;
        $model->amount = $request->amount;
        $model->returnable = $request->returnable;
        $model->note = $request->note;
        $model->save();

        \SadikLog::addToLog('Updated a Expense - ' . $request->what_for .'.');

        return response()->json(['status' => 'success', 'message' => 'Expense is updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Expense::findOrFail($id);
        $model->delete();

        \SadikLog::addToLog('Deleted a Expense - ' . $model->what_for .'.');

        return response()->json(['status' => 'success', 'message' => 'Expense is Deleted successfully']);
    }
}
