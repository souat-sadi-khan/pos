<?php

namespace App\Models\Products;

use App\Models\Supplier;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    // Relation with Supplier
    public function supplier() {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }

    // Relation with tax
    public function tax() {
        return $this->belongsTo(TaxRate::class, 'tax_id', 'id');
    }

    // Relation with category
    public function category() {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    // Relation with brand
    public function brand() {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }
}
