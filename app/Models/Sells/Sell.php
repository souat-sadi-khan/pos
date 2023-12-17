<?php

namespace App\Models\Sells;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Model;

class Sell extends Model
{
    // Relation with Customer
    public function customer() {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
}
