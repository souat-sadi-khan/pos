<?php

namespace App\Http\Controllers\Admin\Expense;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExpenseSummeryController extends Controller
{
    public function index() {
        return view('admin.expense.summery.index');
    }
}
