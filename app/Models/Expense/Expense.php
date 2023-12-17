<?php

namespace App\Models\Expense;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    // Relation with Expense Category
    public function category() {
        return $this->belongsTo(ExpenseCategory::class, 'category_id', 'id');
    }
}
