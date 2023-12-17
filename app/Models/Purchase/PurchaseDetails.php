<?php

namespace App\Models\Purchase;

use App\Models\Products\Product;
use Illuminate\Database\Eloquent\Model;

class PurchaseDetails extends Model
{
    // Relation with Product
    public function product() {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
