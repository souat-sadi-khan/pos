<?php

namespace App\Http\Controllers\Admin\Purchase;

use App\Http\Controllers\Controller;
use App\Models\Products\Product;
use App\Models\Products\TaxRate;
use App\Models\Purchase\Purchase;
use App\Models\Purchase\PurchaseDetails;
use App\Models\Purchase\PurchasePayment;
use App\Models\Supplier;
use App\ProductVariation;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PurchaseController extends Controller
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
                $purchase_sidebar = 'list';
            } elseif($_GET['show'] == 'create') {
                $purchase_sidebar = 'create';
            } else {
                $purchase_sidebar = 'list';
            }
        } else {
            $purchase_sidebar = 'list';
        }
        return view('admin.purchase.purchase.index', compact('purchase_sidebar'));
    }

    public function add_pruchase_row(Request $request) {
        $row = $request->row;
        $id = $request->id;
        $product_id = $request->product_id;
        $product = Product::where('id', $product_id)->first();
        
        if($product->product_variations == 1) {
            $model = ProductVariation::findOrFail($id);
            $access = 1;
        } else {
            $access = 0;
            $model = 0;
        }
        return view('admin.purchase.purchase.add_purchase_row', compact('row', 'model', 'product', 'access'));
    }

    // product_purchase
    public function product_purchase($id) {
        $purchase_sidebar = 'create';
        $product = Product::findOrFail($id);
        return view('admin.purchase.purchase.index', compact('product', 'purchase_sidebar'));
    }

    // add_product_from_purchase
    public function add_product_from_purchase(Request $request) {
        $id = $request->supplier_id;
        if($id == '') {
            $name = 'No Supplier';
        } else {
            $supplier = Supplier::where('id', $id)->first();
            $name = $supplier->sup_name;
        }

        return view('admin.purchase.purchase.add_product', compact('name', 'id'));
    }

    // show_product_for_purchase
    public function show_product_for_purchase(Request $request) {
        $supplier_Id = $request->id;
        if($supplier_Id == 0) {
            $supplier_Id = NULL;
        }
        $products = Product::where('supplier_id', $supplier_Id)->where('status', 1)->get();
        return view('admin.purchase.purchase.show_product_for_purchase', compact('products', 'supplier_Id'));
    }

    // get_supplier_name_from_purchase_page
    public function get_supplier_name_from_purchase_page(Request $request) {
        $id = $request->id;
        if($id == 0) {
            return response()->json(['name' => 'No Supplier']);
        } else {
            $supplier = Supplier::findOrFail($id);
            return response()->json(['name' => $supplier->sup_name]);
        }
    }

    // add_product_from_purchase_post
    public function add_product_from_purchase_post(Request $request) {

        $request->validate([
            'product_image' => 'mimes:jpeg,bmp,png,jpg|max:500',
            'status' => 'required',
            'product_type' => 'required',
            'product_name' => 'required',
            'product_code' => 'required',
            'product_cost' => 'required',
            'product_price' => 'required',
            'product_alert' => 'required',
            'product_variations' => 'required',
        ]);

        $model = new Product;
        $model->status = $request->status;
        $model->product_type = $request->product_type;
        $model->product_name = $request->product_name;
        $model->product_code = $request->product_code;
        if(intval($request->product_category_id) != 0) {
            $model->category_id = intval($request->product_category_id);
        }

        if(intval($request->supplier_id) != 0) {
            $model->supplier_id = $request->supplier_id;
        }

        if(intval($request->brand_id) != 0) {
            $model->brand_id = $request->brand_id;
        }

        $model->barcode_symbiology = $request->barcode_symbiology;

        if(intval($request->box_id) != 0) {
            $model->box_id = $request->box_id;
        }

        if(intval($request->unit_id) != 0) {
            $model->unit_id = $request->unit_id;
        }

        // check product_variations
        if($request->product_variations == 0) {
            $model->product_cost = $request->product_cost;
            $model->product_price = $request->product_price;

            $product_main_price = $request->product_price;
            if($request->tax_id != '0') {
                $tax = TaxRate::where('id', $request->tax_id)->first();
                $tax_rules = $tax->tax_rules;
                $tax_price = $tax->tax_rate;

                if($tax_rules == 'plus') {
                    $product_sell_price = $product_main_price + $tax_price;
                } else {
                    $product_vat = ($product_main_price * $tax_price) / 100;
                    $product_sell_price = $product_main_price + $product_vat;
                }
            } else {
                $product_sell_price = $product_main_price;
            }

            $model->product_price_inc_tax = $product_sell_price;

        } else {
            $color_array = $request->color;
            $size_array = $request->size;
            $product_cost_array = $request->product_cost;
            $product_price_array = $request->product_price;
        }

        $model->product_variations = $request->product_variations;
        
        if(intval($request->tax_id) != 0) {
            $model->tax_id = $request->tax_id;
        }

        $model->tax_method = $request->tax_method;
        $model->product_alert = $request->product_alert;
        $model->hsn_code = $request->hsn_code;
        $model->product_details = $request->product_details;

        if($request->hasFile('product_image')) {

            $data = getimagesize($request->file('product_image'));
            $width = $data[0];
            $height = $data[0];

            if($width > 1900 && $height > 1900) {
                return response()->json(['success' => true, 'status' => 'danger', 'message' => 'Category Image Width and height is wrong']);
            }

            $storagepath = $request->file('product_image')->store('public/images/product/product');
            $fileName = basename($storagepath);

            $model->product_image = $fileName;
        }

        $model->save();

        if($request->product_variations == 1) {
            for($i = 0; $i < count($color_array); $i++) {

                $color = $color_array[$i];
                $size = $size_array[$i];
                $product_cost = $product_cost_array[$i];
                $product_price = $product_price_array[$i];
    
                $item = new ProductVariation;
                $item->product_id = $model->id;
                if($color != 0) {
                    $item->color_id = $color;
                }
                if($size != 0) {
                    $item->size_id = $size;
                }
                $item->product_cost = $product_cost;
                $item->product_price = $product_price;

                $product_main_price = $product_price;
                if($request->tax_id != '0') {
                    $tax = TaxRate::where('id', $request->tax_id)->first();
                    $tax_rules = $tax->tax_rules;
                    $tax_price = $tax->tax_rate;

                    if($tax_rules == 'plus') {
                        $product_sell_price = $product_main_price + $tax_price;
                    } else {
                        $product_vat = ($product_main_price * $tax_price) / 100;
                        $product_sell_price = $product_main_price + $product_vat;
                    }
                } else {
                    $product_sell_price = $product_main_price;
                }

                $item->product_price_inc_tax = $product_sell_price;

                $item->save();
    
            }
        }

        \SadikLog::addToLog('Created a Product - ' . $request->product_name .'.');

        return response()->json(['status' => 'success', 'item' => true , 'id' => $request->supplier_id ,'message' => 'New Product is stored successfully']);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function datatable() {
        if (request()->ajax()) {
            $models = Purchase::all();

            return DataTables::of($models)
                ->addIndexColumn()
                ->editColumn('date', function($model){
                    return formatDate($model->created_at);
                })
                ->editColumn('supplier', function($model){
                    if($model->supplier_id != null) {
                        $supplier = Supplier::where('id', $model->supplier_id)->first();
                        return '<a href="'. route('admin.supplier.show', $model->supplier_id) .'">'.$supplier->sup_name.'</a>';
                    } else {
                       return 'No Supplier';
                    }
                })
                ->editColumn('user_id', function($model){
                    return $model->creator->name ;
                })
                ->editColumn('amount', function($model){
                    return '<span class="text-primary">'. get_option('currency_symbol') . '' . $model->purchase_payable_amount .'</span>';
                })
                ->editColumn('paid', function($model){
                    return '<span class="text-success">'. get_option('currency_symbol') . '' . $model->purchase_paid_amount .'</span>';
                })
                ->editColumn('due', function($model){
                    return '<span class="text-danger">'. get_option('currency_symbol') . '' . $model->purchase_due_amount .'</span>';
                })
                ->editColumn('status', function($model){
                    if($model->status == 'Paid') {
                        return '<span class="badge badge-success">Paid</span>';
                    } else {
                        return '<span class="badge badge-danger">Unpaid</span>';
                    }
                })
                ->addColumn('action', function ($model) {
					return view('admin.purchase.purchase.action', compact('model'));
                })
				->rawColumns(['supplier', 'user_id', 'amount', 'paid', 'due', 'date', 'status', 'sction'])->make(true);
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
        // dd($request->all());
        // validate Data 
        $request->validate([
            'purchase_number_of_product' => 'required',
            'purchase_date' => 'required',
            'purchase_ref_no' => 'required',
            // 'supplier_id' => 'required',
            'purchase_payment_method_id' => 'required',
        ]);

        $model = new Purchase;
        $model->purchase_number_of_product = count($request->product_id);
        $model->invoice = str_random(15);
        $model->user_id = Auth()->user()->id;
        $model->purchase_date = $request->purchase_date;
        $model->purchase_ref_no = $request->purchase_ref_no;
        $model->purchase_note = $request->purchase_note;

        if($request->supplier_id != 0) {
            $model->supplier_id = $request->supplier_id;
        }
        $model->purchase_subtotal = $request->purchase_subtotal;
        $model->purchase_order_tax = $request->purchase_order_tax;
        $model->purchase_shiping_charge = $request->purchase_shiping_charge;
        $model->purchase_other_charge = $request->purchase_other_charge;
        $model->purchase_discount = $request->purchase_discount;
        $model->purchase_payable_amount = $request->purchase_payable_amount;
        $model->purchase_payment_method_id = $request->purchase_payment_method_id;
        $model->purchase_paid_amount = $request->purchase_paid_amount;
        $model->purchase_due_amount = $request->purchase_due_amount;
        if($request->purchase_due_amount == 0) {
            $status = 'Paid';
        } else {
            $status = 'Due';
        }
        $model->status = $status;
        $model->save();
        
        for($i = 0; $i < count($request->product_id); $i++) {
            $p_id = $request->product_id[$i];
            $qty = $request->qty[$i];
            $cost = $request->cost[$i];
            $sell_price = $request->sell_price[$i];
            $net_total = $request->net_total[$i];

            $item = new PurchaseDetails;
            $item->purchase_id = $model->id;
            $item->product_id = $p_id;

            // find the prooduct and update the stock
            $product = Product::where('id', $p_id)->first();
            $product_variations = $product->product_variations;
            if($product_variations == 1) {
                $p_variation = ProductVariation::where('id', $product->id)->first();
                $p_id = $p_variation->id;

                $item->product_variation_id = $p_id;

                $old_stock = $p_variation->stock;
                $new_stock = $old_stock + $qty;
                $p_variation->stock = $new_stock;
                $p_variation->product_cost = $cost;
                $p_variation->product_price = $sell_price;

                if($product->tax_id == null) {
                    $product->product_price_inc_tax = $sell_price;
                } else {
                    $tax_id = $product->tax_id;
                    $tax = TaxRate::where('id', $tax_id)->first();
                    $tax_rate = $tax->tax_rate;
                    $tax_rules = $tax->tax_rules;
                    if($tax_rules == 'mod') {
                        $interest = $sell_price * $tax_rate / 100;
                        $product_price_inc_tax = $sell_price + $interest;
                        $p_variation->product_price_inc_tax = $product_price_inc_tax;
                    } else {
                        $p_variation->product_price_inc_tax = $sell_price + $tax_rate;
                    }
                }
                $p_variation->save();
            } else {
                $old_stock = $product->stock;
                $new_stock = $old_stock + $qty;
                $product->stock = $new_stock;
                $product->product_cost = $cost;
                $product->product_price = $sell_price;

                if($product->tax_id == null) {
                    $product->product_price_inc_tax = $sell_price;
                } else {
                    $tax_id = $product->tax_id;
                    $tax = TaxRate::where('id', $tax_id)->first();
                    $tax_rate = $tax->tax_rate;
                    $tax_rules = $tax->tax_rules;
                    if($tax_rules == 'mod') {
                        $interest = $sell_price * $tax_rate / 100;
                        $product_price_inc_tax = $sell_price + $interest;
                        $product->product_price_inc_tax = $product_price_inc_tax;
                    } else {
                        $product->product_price_inc_tax = $sell_price + $tax_rate;
                    }
                }
            }
            $product->save();

            
            $item->quantity = $qty;
            $item->purchase_cost = $cost;
            $item->sell_price = $sell_price;
            $item->net_total = $net_total;
            $item->save();
        }

        $price = new PurchasePayment;
        $price->purchase_id = $model->id;
        $price->purchase_payment_method_id = $request->purchase_payment_method_id;
        $price->payment_amount = $request->purchase_paid_amount;
        $price->txr_id = $request->method_has_txr_id;
        $price->mobile_number = $request->method_has_mob_no;
        $price->save();

        \SadikLog::addToLog('Created a Purchase - ' . $model->invoice .'.');

        return response()->json(['status' => 'success', 'message' => 'New Purchase is stored successfully']);

    }

    // show_pay_form
    public function show_pay_form($id) {
        // find the purchase Invoice
        $model = Purchase::findOrFail($id);
        return view('admin.purchase.purchase.pay', compact('model'));
    }

    // pay_due
    public function pay_due(Request $request) {
        // dd($request->all());
        $request->validate([
            'purchase_id'   =>  'required',
            'purchase_payment_method_id'   =>  'required',
            'payment_amount'   =>  'required',
        ]);

        $purchae_id = $request->purchase_id;
        $purchase = Purchase::findOrFail($purchae_id);


        $total_payable_amount = $purchase->purchase_payable_amount;
        $total_paid_amount = $purchase->purchase_paid_amount;
        $total_due_amount = $purchase->purchase_due_amount;

        $paid = $request->payment_amount;

        $paid_amount = $total_paid_amount + $paid;

        $due = $total_payable_amount - $paid_amount;
        $purchase->purchase_paid_amount = $paid_amount;
        $purchase->purchase_due_amount = $due;

        $purchase->save();

        $model = new PurchasePayment;
        $model->purchase_id = $purchae_id;
        $model->purchase_payment_method_id = $request->purchase_payment_method_id;
        $model->payment_amount = $request->payment_amount;
        $model->note = $request->note;
        $model->txr_id = $request->method_has_txr_id;
        $model->mobile_number = $request->method_has_mob_no;
        $model->save();
        \SadikLog::addToLog('Created a Purchase Payment of - ' . $model->payment_amount .'.');

        return response()->json(['status' => 'success', 'message' => 'New Purchase Payment is stored successfully']);

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
        $model = Purchase::findOrFail($id);
        $model->delete();

        $items = PurchaseDetails::where('purchase_id', $id)->get();
        if($items) {
            foreach($items as $item) {
                $item->delete();
            }
        }

        $items = PurchasePayment::where('purchase_id', $id)->get();
        if($items) {
            foreach($items as $item) {
                $item->delete();
            }
        }
    }

    // due_invoice 
    public function due_invoice () {
        return view('admin.purchase.due');
    }

    // due_invoice_datatable
    public function due_invoice_datatable() {
        if (request()->ajax()) {
            $models = Purchase::where('purchase_due_amount', '!=', 0)->get();

            return DataTables::of($models)
                ->addIndexColumn()
                ->editColumn('date', function($model){
                    return formatDate($model->created_at);
                })
                ->editColumn('supplier', function($model){
                    if($model->supplier_id != null) {
                        $supplier = Supplier::where('id', $model->supplier_id)->first();
                        return '<a href="'. route('admin.supplier.show', $model->supplier_id) .'">'.$supplier->sup_name.'</a>';
                    } else {
                       return 'No Supplier';
                    }
                })
                ->editColumn('user_id', function($model){
                    return $model->creator->name ;
                })
                ->editColumn('amount', function($model){
                    return '<span class="text-primary">'. get_option('currency_symbol') . '' . $model->purchase_payable_amount .'</span>';
                })
                ->editColumn('paid', function($model){
                    return '<span class="text-success">'. get_option('currency_symbol') . '' . $model->purchase_paid_amount .'</span>';
                })
                ->editColumn('due', function($model){
                    return '<span class="text-danger">'. get_option('currency_symbol') . '' . $model->purchase_due_amount .'</span>';
                })
                ->editColumn('status', function($model){
                    if($model->status == 'Paid') {
                        return '<span class="badge badge-success">Paid</span>';
                    } else {
                        return '<span class="badge badge-danger">Unpaid</span>';
                    }
                })
                ->editColumn('action', function ($model) {
                    return '<button title="Pay '. $model->invoice .'" id="content_managment" data-url="'. route('admin.purchase.pay',$model->id) .'" class="btn btn-success btn-sm"><i class="fa fa-money"></i></button>';
                })
				->rawColumns(['supplier', 'user_id', 'amount', 'paid', 'due', 'date', 'status', 'action'])->make(true);
		}
    }
}
