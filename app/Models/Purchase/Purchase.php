<?php

namespace App\Models\Purchase;

use App\Models\PaymentMethod;
use App\Models\Supplier;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Purchase extends Model
{
    use SoftDeletes;

    // relation with supplier
    public function supplier() {
        return $this->belongsTo(Supplier::class, 'supplier_Id', 'id');
    }

    // relation with creator 
    public function creator() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // retlation with payment_method
    public function payment_method() {
        return $this->belongsTo(PaymentMethod::class, 'purchase_payment_method_id', 'id');
    }
}
