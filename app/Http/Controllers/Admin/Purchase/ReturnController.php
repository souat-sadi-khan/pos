<?php

namespace App\Http\Controllers\Admin\Purchase;

use App\Http\Controllers\Controller;
use App\Models\Products\Product;
use App\Models\Purchase\Purchase;
use App\Models\Purchase\PurchaseDetails;
use App\Models\Purchase\PurchaseReturn;
use App\Models\Purchase\PurchaseReturnDetail;
use App\ProductVariation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReturnController extends Controller
{
    // show_purchse_return_form
    public function show_purchse_return_form($id) {
        $model = Purchase::findOrFail($id);

        $items = PurchaseDetails::where('purchase_id', $id)->get();

        return view('admin.purchase.return.index', compact('model', 'items'));
    }

    // make_purchase_return
    public function make_purchase_return(Request $request) {

        // dd($request->all());
        $item_array = $request->item;
        if($item_array == null) {
            return response()->json(['status' => 'danger', 'message' => 'Please Check A Product First']);
        }

        $back = 0;

        for($i = 0; $i < count($item_array); $i++) {
            $product_id =  $request->item[$i];
            $qty = $request->qty[$i];

            $purchase_details = PurchaseDetails::findOrFail($product_id);
            $main_product = Product::findOrFail($purchase_details->product_id);
            
            // if product has variation
            if($purchase_details->product_variation_id != null) {
                $product = ProductVariation::findOrFail($purchase_details->product_variation_id);

                // product quantity back 
                $new_quantity = $product->stock - $qty;
                $product_cost = $product->product_cost;

                $back = $product_cost * $qty;

                $product->stock = $new_quantity;
                $product->save();

            } else {
                $product = Product::findOrFail($purchase_details->product_id);

                // product quantity back 
                $new_quantity = $product->stock - $qty;
                $product_cost = $product->product_cost;

                $back = $product_cost * $qty;

                $product->stock = $new_quantity;
                $product->save();
            }            
        }

        // dd($purchase_details);

        // Create Purchase Return
        $model = new PurchaseReturn;
        $model->purchase_id = $request->purchase_id;
        $model->date = $request->date;
        $model->user_id = Auth::user()->id;
        $model->amount = $back;
        $model->save(); 

        // Create Purchase Return Details
        for($i = 0; $i < count($item_array); $i++) {

            $purchase_details = PurchaseDetails::findOrFail($product_id);


            $item = new PurchaseReturnDetail;
            $item->purchase_return_id = $model->save();
            $item->product_id = $product->id;
            if($purchase_details->product_variation_id != null) {
                $item->product_variation_id = $purchase_details->product_variation_id;
            }
            $item->quantity = $request->qty[$i];
            $item->save();
        }
        
    }
}
