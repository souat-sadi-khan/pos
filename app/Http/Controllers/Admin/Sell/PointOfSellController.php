<?php

namespace App\Http\Controllers\Admin\Sell;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Products\Product;
use App\Models\Sells\Sell;
use App\Models\Sells\SellDetail;
use App\ProductVariation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PointOfSellController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.sell.sell.index');
    }

    // get_product_by_category
    public function get_product_by_category(Request $request) {
        $cat_id = $request->cat_id;

        if($cat_id == 'all') {
            $products = Product::where('status', 1)->get();
        } elseif( $cat_id == '0') {
            $cat_id = '';
            $products = Product::where('category_id', $cat_id)->where('status', 1)->get();
        } else {
            $products = Product::where('category_id', $cat_id)->where('status', 1)->get();
        }

        return view('admin.sell.sell.show_product_category_wise', compact('products'));
    }

    // creaet_customer_from_pos
    public function creaet_customer_from_pos() {
        return view('admin.sell.sell.customer');
    }

    // sote_customer_from_pos
    public function store_customer_from_pos(Request $request) {
        $request->validate([
            'customer_name' => 'required',
            'credit_balance' => 'required',
            'status' => 'required',
            'customer_mobile' => 'required',
        ]);

        $model = new Customer;
        $model->uuid = Str::uuid();
        $model->customer_name = $request->customer_name;
        $model->credit_balance = $request->credit_balance;
        $model->customer_mobile = $request->customer_mobile;
        $model->date_of_birth = $request->date_of_birth;
        $model->customer_email = $request->customer_email;
        $model->customer_sex = $request->customer_sex;
        $model->customer_age = $request->customer_age;
        $model->gtin = $request->gtin;
        $model->customer_address = $request->customer_address;
        $model->customer_city = $request->customer_city;
        $model->customer_state = $request->customer_state;
        $model->customer_country = $request->customer_country;
        $model->status = $request->status;
        $model->save();

        $name = $request->customer_name . '('.$request->customer_mobile.')';
        $id = $model->id;
        if($request->credit_balance < 0) {
            $due = $request->credit_balance;
        } else {
            $due = 0;
        }

        \SadikLog::addToLog('Created a Customer - ' . $request->customer_name .'.');

        return response()->json(['status' => 'success', 'pos_customer' =>true, 'name' =>$name,  'id' => $id, 'due' => $due,  'message' => 'New Customer is stored successfully']);
    }

    // show_customer_list_for_pos
    public function show_customer_list_for_pos() {
        $customers = Customer::where('status', 1)->where('id', '!=', 1)->get();
        return view('admin.sell.sell.show_customer_list', compact('customers'));
    }

    // set_customer_for_pos
    public function set_customer_for_pos(Request $request) {
        $id = $request->id;
        $customer = Customer::findOrFail($id);
        $name = $customer->customer_name . '('. $customer->customer_mobile .')';

        if($customer->credit_balance < 0) {
            $due = $customer->credit_balance;
        } else {
            $due = 0;
        }

        return response()->json(['status' => 'success', 'name' =>$name,  'id' => $id, 'due' => $due,  'message' => 'Customer is Selected']);
    }

    // add_sell_row
    public function add_sell_row(Request $request) {
        $row = $request->row;
        $id = $request->id;
        $product_id = $request->product_id;
        $product = Product::where('id', $product_id)->first();
        $model = ProductVariation::findOrFail($id);
        return view('admin.sell.sell.add_sell_row', compact('row', 'product', 'model'));
    }

    // get_product_from_pos
    public function get_product_from_pos(Request $request) {
        $val = $request->val;

        if($val == '') {
            $products = Product::where('status', '1')->get();
        } else {
            $products = Product::where('status', '1')->where('product_name', 'like', '%' .$val . '%')->get();
        }

        return view('admin.sell.sell.show_product_category_wise', compact('products'));
    }

    // edit_customer_from_pos
    public function edit_customer_from_pos(Request $request) {
        $id = $request->id;
        $customer = Customer::findOrFail($id);
        return view('admin.sell.sell.edit_customer', compact('customer'));
    }

    // update_customer_from_pos
    public function update_customer_from_pos(Request $request, $id) {

        $model = Customer::findOrFail($id);
        $model->customer_name = $request->customer_name;
        $model->credit_balance = $request->credit_balance;
        $model->customer_mobile = $request->customer_mobile;
        $model->date_of_birth = $request->date_of_birth;
        $model->customer_email = $request->customer_email;
        $model->customer_sex = $request->customer_sex;
        $model->customer_age = $request->customer_age;
        $model->gtin = $request->gtin;
        $model->customer_address = $request->customer_address;
        $model->customer_city = $request->customer_city;
        $model->customer_state = $request->customer_state;
        $model->customer_country = $request->customer_country;
        $model->status = $request->status;
        $model->save();

        \SadikLog::addToLog('Updated a Customer - ' . $request->customer_name .'.');

        $name = $model->customer_name . '('.$request->customer_mobile.')';
        $id = $model->id;
        if($request->credit_balance < 0) {
            $due = $request->credit_balance;
        } else {
            $due = 0;
        }

        return response()->json(['status' => 'success', 'pos_customer' =>true, 'name' =>$name,  'id' => $id, 'due' => $due,  'message' => 'Customer is updated successfully']);

    }

    // update_customer_mobile_from_pos
    public function update_customer_mobile_from_pos(Request $request, $id) {
        $model = Customer::findOrFail($id);
       
        $model->customer_mobile = $request->customer_mobile;
       
        $model->save();

        \SadikLog::addToLog('Updated a Customer - ' . $request->customer_name .'.');

        $name = $model->customer_name . '('.$request->customer_mobile.')';
        $id = $model->id;
        if($request->credit_balance < 0) {
            $due = $request->credit_balance;
        } else {
            $due = 0;
        }

        return response()->json(['status' => 'success', 'pos_customer' =>true, 'name' =>$name,  'id' => $id, 'due' => $due,  'message' => 'Customer Moblie Number is updated successfully']);

    }

    // edit_customer_mobile_from_pos
    public function edit_customer_mobile_from_pos(Request $request) {
        $id = $request->id;
        $customer = Customer::findOrFail($id);
        return view('admin.sell.sell.customer-mobile', compact('customer'));
    }

    // pay_now_from_pos
    public function pay_now_from_pos(Request $request) {
        dd($request->all());
    }

    // send_pos_item
    public function send_pos_item(Request $request) {
        $customer_id = $request->customer_id;
        $discount = $request->discount;
        $order_tax = $request->order_tax;
        $shiping_charge = $request->shiping_charge;
        $other_charge = $request->other_charge;
        $total = $request->total;
        $qtys = $request->qty;
        $total_prices = $request->total_price;
        $product_ids = $request->product_id;
        $sell_prices = $request->sell_price;
        $product_variations_ids = $request->product_variations_id;

        return view('admin.sell.sell.buy', compact('customer_id', 'discount', 'order_tax', 'shiping_charge', 'other_charge', 'total', 'qtys', 'total_prices', 'product_ids', 'sell_prices', 'product_variations_ids'));

    }

    // full_paid_from_pos
    public function full_paid_from_pos(Request $request) {
        $request->validate([
            'method_id' => 'required',
            'customer_id' => 'required',
            'reference_no' => 'required|unique:sells',
            'subtotal' => 'required',
            'discount' => 'required',
            'order_tax' => 'required',
            'shiping_charge' => 'required',
            'paid' => 'required',
            'due' => 'required',
            'payable' => 'required',
            'qtys' => 'required',
            'total_prices' => 'required',
            'product_ids' => 'required',
            'sell_prices' => 'required',
            'product_variations_ids' => 'required',
        ]);

        $model = new Sell;
        $model->invoice = $request->reference_no;
        $model->method_id = $request->method_id;
        $model->customer_id = $request->customer_id;
        $model->subtotal = $request->subtotal;
        $model->discount = $request->discount;
        $model->order_tax = $request->order_tax;
        $model->shiping_charge = $request->shiping_charge;
        $model->other_charge = $request->other_charge;
        $model->paid = $request->paid;
        $model->due = $request->due;
        $model->payable = $request->payable;
        $model->status = 1;
        $model->save();

        $qtys = explode(',', $request->qtys);
        $total_prices = explode(',', $request->total_prices);
        $product_ids = explode(',', $request->product_ids);
        $sell_prices = explode(',', $request->sell_prices);
        $product_variations_ids = explode(',', $request->product_variations_ids);
        
        for($i = 0; $i < count($product_ids) ; $i++) {
            $qty = $qtys[$i];
            $total_price = $total_prices[$i];
            $product_id = $product_ids[$i];
            $sell_price = $sell_prices[$i];
            $product_variation_id = $product_variations_ids[$i];

            $item = new SellDetail;
            $item->sell_id = $model->id;
            $item->product_id = $product_id;
            $item->product_variation_id = $product_variation_id;
            $item->quantity = $qty;
            $item->net_total = $total_price;
            $item->save();
        }

        \SadikLog::addToLog('Created a Sell - ' . $request->reference_no .'.');

        return response()->json(['status' => 'success', 'load' => true, 'message' => 'New Sell is stored successfully']);

    }

    
    // full_due_from_pos
    public function full_due_from_pos(Request $request) {
        $request->validate([
            'method_id' => 'required',
            'customer_id' => 'required',
            'reference_no' => 'required',
            'subtotal' => 'required',
            'discount' => 'required',
            'order_tax' => 'required',
            'shiping_charge' => 'required',
            'paid' => 'required',
            'due' => 'required',
            'payable' => 'required',
            'qtys' => 'required',
            'total_prices' => 'required',
            'product_ids' => 'required',
            'sell_prices' => 'required',
            'product_variations_ids' => 'required',
        ]);

        $query = Sell::where('invoice', $request->reference_no)->get();
        if(count($query)) {
            return response()->json(['status' => 'danger', 'message' => 'Reference Number is Already Taken!']);
        }

        $model = new Sell;
        $model->invoice = $request->reference_no;
        $model->method_id = $request->method_id;
        $model->customer_id = $request->customer_id;
        $model->subtotal = $request->subtotal;
        $model->discount = $request->discount;
        $model->order_tax = $request->order_tax;
        $model->shiping_charge = $request->shiping_charge;
        $model->other_charge = $request->other_charge;
        $model->paid = $request->paid;
        $model->due = $request->due;
        $model->payable = $request->payable;
        $model->status = 0;
        $model->save();

        $qtys = explode(',', $request->qtys);
        $total_prices = explode(',', $request->total_prices);
        $product_ids = explode(',', $request->product_ids);
        $sell_prices = explode(',', $request->sell_prices);
        $product_variations_ids = explode(',', $request->product_variations_ids);
        
        for($i = 0; $i < count($product_ids) ; $i++) {
            $qty = $qtys[$i];
            $total_price = $total_prices[$i];
            $product_id = $product_ids[$i];
            $sell_price = $sell_prices[$i];
            $product_variation_id = $product_variations_ids[$i];

            $item = new SellDetail;
            $item->sell_id = $model->id;
            $item->product_id = $product_id;
            $item->product_variation_id = $product_variation_id;
            $item->quantity = $qty;
            $item->net_total = $total_price;
            $item->save();
        }

        \SadikLog::addToLog('Created a Sell - ' . $request->reference_no .'.');

        return response()->json(['status' => 'success', 'load' => true, 'message' => 'New Sell is stored successfully']);
    }

    // pay_now
    public function pay_now(Request $request) {
        $request->validate([
            'method_id' => 'required',
            'customer_id' => 'required',
            'reference_no' => 'required',
            'subtotal' => 'required',
            'discount' => 'required',
            'order_tax' => 'required',
            'shiping_charge' => 'required',
            'paid' => 'required',
            'due' => 'required',
            'payable' => 'required',
            'qtys' => 'required',
            'total_prices' => 'required',
            'product_ids' => 'required',
            'sell_prices' => 'required',
            'product_variations_ids' => 'required',
        ]);

        $query = Sell::where('invoice', $request->reference_no)->get();
        if(count($query)) {
            return response()->json(['status' => 'danger', 'message' => 'Reference Number is Already Taken!']);
        }

        $model = new Sell;
        $model->invoice = $request->reference_no;
        $model->method_id = $request->method_id;
        $model->customer_id = $request->customer_id;
        $model->subtotal = $request->subtotal;
        $model->discount = $request->discount;
        $model->order_tax = $request->order_tax;
        $model->shiping_charge = $request->shiping_charge;
        $model->other_charge = $request->other_charge;
        $model->paid = $request->paid;
        $model->due = $request->due;
        $model->payable = $request->payable;
        $model->status = 0;
        $model->save();

        $qtys = explode(',', $request->qtys);
        $total_prices = explode(',', $request->total_prices);
        $product_ids = explode(',', $request->product_ids);
        $sell_prices = explode(',', $request->sell_prices);
        $product_variations_ids = explode(',', $request->product_variations_ids);
        
        for($i = 0; $i < count($product_ids) ; $i++) {
            $qty = $qtys[$i];
            $total_price = $total_prices[$i];
            $product_id = $product_ids[$i];
            $sell_price = $sell_prices[$i];
            $product_variation_id = $product_variations_ids[$i];

            $item = new SellDetail;
            $item->sell_id = $model->id;
            $item->product_id = $product_id;
            $item->product_variation_id = $product_variation_id;
            $item->quantity = $qty;
            $item->net_total = $total_price;
            $item->save();
        }

        \SadikLog::addToLog('Created a Sell - ' . $request->reference_no .'.');

        return response()->json(['status' => 'success', 'load' => true, 'message' => 'New Sell is stored successfully']);$request->validate([
            'method_id' => 'required',
            'customer_id' => 'required',
            'reference_no' => 'required',
            'subtotal' => 'required',
            'discount' => 'required',
            'order_tax' => 'required',
            'shiping_charge' => 'required',
            'paid' => 'required',
            'due' => 'required',
            'payable' => 'required',
            'qtys' => 'required',
            'total_prices' => 'required',
            'product_ids' => 'required',
            'sell_prices' => 'required',
            'product_variations_ids' => 'required',
        ]);

        $query = Sell::where('invoice', $request->reference_no)->get();
        if(count($query)) {
            return response()->json(['status' => 'danger', 'message' => 'Reference Number is Already Taken!']);
        }

        $model = new Sell;
        $model->invoice = $request->reference_no;
        $model->method_id = $request->method_id;
        $model->customer_id = $request->customer_id;
        $model->subtotal = $request->subtotal;
        $model->discount = $request->discount;
        $model->order_tax = $request->order_tax;
        $model->shiping_charge = $request->shiping_charge;
        $model->other_charge = $request->other_charge;
        $model->paid = $request->paid;
        $model->due = $request->due;
        $model->payable = $request->payable;
        $model->status = 0;
        $model->save();

        $qtys = explode(',', $request->qtys);
        $total_prices = explode(',', $request->total_prices);
        $product_ids = explode(',', $request->product_ids);
        $sell_prices = explode(',', $request->sell_prices);
        $product_variations_ids = explode(',', $request->product_variations_ids);
        
        for($i = 0; $i < count($product_ids) ; $i++) {
            $qty = $qtys[$i];
            $total_price = $total_prices[$i];
            $product_id = $product_ids[$i];
            $sell_price = $sell_prices[$i];
            $product_variation_id = $product_variations_ids[$i];

            $item = new SellDetail;
            $item->sell_id = $model->id;
            $item->product_id = $product_id;
            $item->product_variation_id = $product_variation_id;
            $item->quantity = $qty;
            $item->net_total = $total_price;
            $item->save();
        }

        \SadikLog::addToLog('Created a Sell - ' . $request->reference_no .'.');

        return response()->json(['status' => 'success', 'load' => true, 'message' => 'New Sell is stored successfully']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
