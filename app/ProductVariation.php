<?php

namespace App;

use App\Models\Products\Color;
use App\Models\Products\Size;
use Illuminate\Database\Eloquent\Model;

class ProductVariation extends Model
{
    // relation with size 
    public function size() {
        return $this->belongsTo(Size::class, 'size_id', 'id');
    }

    // relation with color
    public function color() {
        return $this->belongsTo(Color::class, 'color_id', 'id');
    }
}
